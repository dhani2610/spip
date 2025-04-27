<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Paket;
use App\Models\Group;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BerandaController extends Controller
{


    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function home()
    {
        $data['page_title'] = 'Homepage';
        $data['data'] = Paket::orderBy('created_at', 'desc')->whereNull('deleted_at')->get();

        return view('frontend.home', $data);
    }

    public function generateSnapToken(Request $request, $id)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $paket = Paket::findOrFail($id);
        $durasi = $request->durasi; // Ambil durasi dari request (1-12)
        $totalHarga = $paket->harga * $durasi; // Kalkulasi total harga

        // Hitung tanggal mulai dan tanggal selesai
        $startDate = now(); // Hari ini
        $daysToAdd = ($paket->type === 'week') ? ($durasi * 7) : ($durasi * 30); // Week * 7 atau Month * 30
        $endDate = $startDate->copy()->addDays($daysToAdd); // Tambahkan hari ke startDate

        $order_Id = uniqid();
        $params = [
            'transaction_details' => [
                'order_id' => $order_Id, // Order ID unik
                'gross_amount' => $totalHarga, // Harga berdasarkan durasi
            ],
            'customer_details' => [
                'first_name' => Auth::guard('admin')->user()->name ?? 'Guest',
                'email' => Auth::guard('admin')->user()->email ?? 'guest@example.com',
                'phone' => Auth::guard('admin')->user()->no_wa ?? '08111222333',
            ],
            'item_details' => [
                [
                    'id' => $paket->id,
                    'price' => $paket->harga,
                    'quantity' => $durasi,
                    'name' => $paket->nama . " ({$startDate->format('d M Y')} - {$endDate->format('d M Y')})",
                ]
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'snapToken' => $snapToken,
            'paket' => $paket,
            'total_harga' => $totalHarga,
            'order_id' => $order_Id,
            'dari_tanggal' => $startDate->format('Y-m-d'),
            'sampai_tanggal' => $endDate->format('Y-m-d')
        ]);
    }

    public function storeTransaction(Request $request)
    {
        \Log::info('Request body:', $request->all());

        try {

            $paket = Paket::where('id',$request->paket_id)->first();

            $benefit = json_decode($paket->benefit, true); // decode menjadi array
            $group = json_decode($paket->group, true); // decode menjadi array
            $asset = json_decode($paket->asset, true); // decode menjadi array
    
            // // Encode kembali menjadi string JSON untuk disimpan ke database
            $benefitJson = json_encode($benefit);
            $groupJson = json_encode($group);
            $assetJson = json_encode($asset);
            if (Auth::guard('admin')->check() != null) {
                $id_user = Auth::guard('admin')->user()->id;
                $admin = Auth::guard('admin')->user();

                $plainPassword = null;
            }else{
                // $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
                // $plainPassword = substr(str_shuffle($characters), 0, 8);
                $plainPassword = $request->nameUser . '77';

                // Create New Admin
                $admin = new Admin();
                $admin->name = $request->nameUser;
                $admin->username = $request->nameUser;
                $admin->email = $request->emailUser;
                $admin->no_wa = $request->waUser;
                $admin->password = Hash::make($plainPassword);
                $admin->save();
                $admin->assignRole('user');

                $id_user = $admin->id;
            }
            // Simpan ke database
            $transaksi = Transaksi::create([
                'id_user' => $id_user,
                'tanggal' => date('Y-m-d'),
                'order_id_midtrans' => $request->order_id_midtrans,
                'paket_id' => $request->paket_id,
                'durasi' => $request->durasi,
                'dari_tanggal' => $request->dari_tanggal,
                'sampai_tanggal' => $request->sampai_tanggal,
                'total_harga' => $request->total_harga,
                'nama' => $request->nama,
                'type' => $request->type,
                'harga' => $request->harga,
                'benefit' => $benefitJson, // Simpan dalam format JSON
                'group' => $groupJson,
                'include_asset' => $request->include_asset,
                'asset' => $assetJson
            ]);

            if ($admin) {
                $this->sendWhatsAppNotification($admin, $transaksi,$plainPassword);
            }

            $user = Admin::find($admin->id);
            $user->expired_date = $request->sampai_tanggal;
            $user->id_paket = $request->paket_id;
            $user->save();

            return response()->json([
                'message' => 'Transaksi berhasil disimpan dan notifikasi WA dikirim!',
                'data' => $transaksi
            ]);
        } catch (\Throwable $th) {
            \Log::error('Error saving transaction: ' . $th->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan transaksi.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    
    public function sendWhatsAppNotification($admin, $trans,$plainPassword = null)
    {
        $message = "🎉 Selamat! Paket *{$trans->nama}* Anda telah aktif! 🎉\n\n"
            . "📅 Periode: *" . Carbon::parse($trans->dari_tanggal)->translatedFormat('d F Y') . "* - *" 
            . Carbon::parse($trans->sampai_tanggal)->translatedFormat('d F Y') . "*\n"
            . "💰 Total Harga: *Rp " . number_format($trans->total_harga, 0, ',', '.') . "*\n\n"
            . "Silakan bergabung dengan grup kami:\n";
            
        $groups = json_decode($trans->group, true);
        foreach ($groups as $group) {
            $gp = Group::find($group);
            if(!empty($gp)){
                $message .= "🔹 *{$gp->nama}*: {$gp->link}\n";
            }
        }
        $message .= "\n";

        if (Auth::guard('admin')->check() == null) {
            $loginUrl = rtrim(config('app.url'), '/') . '/admin/login';
            $message .=
            "Berikut adalah akun website Anda:\n"
            . "👤 Username: *{$admin->username}*\n"
            . "🔑 Password: *{$plainPassword}*\n\n"
            . "🔗 Login: {$loginUrl}\n\n"
            . "Silakan login di website kami untuk menikmati paket anda dan tetap semangat move on! 💪\n";
        }

        $message .= "\nTerima kasih!\nSalam, Tim Teman Move On ❤️";

        $this->sendWhatsAppMessage($admin->no_wa, $message);
    }


    public function checkout($paket_id){
        $data['page_title'] = 'Homepage';
        $data['data'] = Paket::find($paket_id);

        return view('frontend.checkout', $data);
    }
    public function successPayment(){
        $data['page_title'] = 'Payment Success';

        return view('frontend.successpage', $data);
    }




    public function register()
    {
        $data['page_title'] = 'Register';
        return view('backend.auth.register', $data);
    }

    public function registerStore(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|max:100|email|unique:admins',
                'no_wa' => 'required|max:100|unique:admins',
                'username' => 'required|max:100|unique:admins',
            ]);

            // Ambil password sebelum di-hash
            $plainPassword = $request->password;

            // Create New Admin
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->no_wa = $request->no_wa;
            $admin->password = Hash::make($plainPassword);
            $admin->save();

            $admin->assignRole('user');

            // Format pesan
            $message = "Halo {$admin->name},\n\n"
                . "Terima kasih telah bergabung dengan *Teman MoveOn* 🎉.\n\n"
                . "Berikut adalah akun Anda:\n"
                . "👤 Username: *{$admin->username}*\n"
                . "🔑 Password: *{$plainPassword}*\n\n"
                . "Silakan login di website kami dan tetap semangat move on! 💪\n\n"
                . "Salam,\nTim Teman MoveOn ❤️";

            // Kirim Pesan WhatsApp via Fonte API
            $this->sendWhatsAppMessage($admin->no_wa, $message);

            session()->flash('success', 'Register berhasil. Silakan cek WhatsApp Anda untuk detail akun.');
            return redirect('admin/login');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect('admin/register');
        }
    }
    // public function registerStore(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'name' => 'required|max:50',
    //             'email' => 'required|max:100|email|unique:admins',
    //             'no_wa' => 'required|max:100|unique:admins',
    //             'username' => 'required|max:100|unique:admins',
    //         ]);

    //         // Ambil password sebelum di-hash
    //         $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    //         $plainPassword = substr(str_shuffle($characters), 0, 8);

    //         // Create New Admin
    //         $admin = new Admin();
    //         $admin->name = $request->name;
    //         $admin->username = $request->username;
    //         $admin->email = $request->email;
    //         $admin->no_wa = $request->no_wa;
    //         $admin->password = Hash::make($plainPassword);
    //         $admin->save();

    //         $admin->assignRole('user');

    //         // Format pesan
    //         $message = "Halo {$admin->name},\n\n"
    //             . "Terima kasih telah bergabung dengan *Teman MoveOn* 🎉.\n\n"
    //             . "Berikut adalah akun Anda:\n"
    //             . "👤 Username: *{$admin->username}*\n"
    //             . "🔑 Password: *{$plainPassword}*\n\n"
    //             . "Silakan login di website kami dan tetap semangat move on! 💪\n\n"
    //             . "Salam,\nTim Teman MoveOn ❤️";

    //         // Kirim Pesan WhatsApp via Fonte API
    //         $this->sendWhatsAppMessage($admin->no_wa, $message);

    //         session()->flash('success', 'Register berhasil. Silakan cek WhatsApp Anda untuk detail akun.');
    //         return redirect('admin/login');
    //     } catch (\Throwable $th) {
    //         session()->flash('failed', $th->getMessage());
    //         return redirect('admin/register');
    //     }
    // }

    /**
     * Kirim Pesan WhatsApp via Fonte API
     */
    private function sendWhatsAppMessage($phone, $message)
    {
        $token = env('TOKEN_FONNTE'); // Token API Fonte
        $url = "https://api.fonnte.com/send"; // Endpoint API Fonte (pastikan ini benar)

        try {
            $response = Http::withHeaders([
                'Authorization' => "$token",
                'Content-Type' => 'application/json',
            ])->post($url, [
                'target' => $phone, // Format nomor tanpa "+"
                'message' => $message,
            ]);

            $result = $response->json();
            if ($response->successful()) {
                \Log::info("Pesan WA berhasil dikirim ke $phone");
            } else {
                \Log::error("Gagal mengirim WA: " . json_encode($result));
            }
        } catch (\Exception $e) {
            \Log::error("Error mengirim WA: " . $e->getMessage());
        }
    }


}
