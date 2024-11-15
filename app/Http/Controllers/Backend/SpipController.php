<?php

namespace App\Http\Controllers\Backend;

use App\Models\Spip;
use App\Http\Controllers\Controller;
use App\Mail\ReminderMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SpipController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'SPIP';
        $data['spips'] = Spip::where('type', $request->type)->orderBy('created_at', 'desc')->get();

        return view('backend.pages.spip.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Data SPIP';
        $data['admins'] = Admin::orderBy('created_at', 'desc')->get();
        return view('backend.pages.spip.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new Spip();
            $data->jenis = $request->jenis;
            $data->merek = $request->merek;
            $data->jenis_unit = $request->jenis_unit;
            $data->perusahaan = $request->perusahaan;
            $data->nomor_unit = $request->nomor_unit;
            $data->commisioner = $request->commisioner;
            $data->tanggal_commisioning = $request->tanggal_commisioning;
            $data->deviasi = $request->deviasi;
            $data->user = $request->user;
            $data->sticker = $request->sticker;
            $data->status = $request->status;
            $data->tanggal_expired = $request->tanggal_expired;
            $data->type = $request->type;
            if ($request->hasFile('upload_foto')) {
                $file = $request->file('upload_foto');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/spip/');
                $file->move($destinationPath, $name);
                $data->upload_foto = $name;
            }
            $data->save();

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('spip', ['type' => $request->type]);
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('spip', ['type' => $request->type]);
        }
    }

    public function sendEmail($id)
    {
        try {

            $data = Spip::where('id', $id)->first();

            if (empty($data)) {
                return response()->json(['failed' => true, 'msg' => 'data tidak tersedia!']);
            }

            $admin = Admin::find($data->user);
            $email = $admin->email;

            // Ensure tanggal_expired is a Carbon instance
            if ($data->tanggal_expired) {
                $data->tanggal_expired = \Carbon\Carbon::parse($data->tanggal_expired);
            }

            // Kirim email
            Mail::to($email)->send(new ReminderMail([
                'email' => $email,
                'spip' => $data,
            ]));

            session()->flash('success', 'Reminder Email berhasil dikirim!');
            return redirect()->route('spip', ['type' => $data->type]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $data = Spip::where('id', $id)->first();
            session()->flash('success', 'Reminder Email gagal dikirim!');
            return redirect()->route('spip', ['type' => $data->type]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Spip $spip)
    {
        $data['page_title'] = 'Detail SPIP';
        $data['spip'] = $spip;

        return view('backend.pages.spip.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Data SPIP';
        $data['spip'] = Spip::find($id);
        $data['admins'] = Admin::orderBy('created_at', 'desc')->get();
        return view('backend.pages.spip.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Spip::find($id);
            $data->jenis = $request->jenis;
            $data->merek = $request->merek;
            $data->jenis_unit = $request->jenis_unit;
            $data->perusahaan = $request->perusahaan;
            $data->nomor_unit = $request->nomor_unit;
            $data->commisioner = $request->commisioner;
            $data->tanggal_commisioning = $request->tanggal_commisioning;
            $data->deviasi = $request->deviasi;
            $data->user = $request->user;
            $data->sticker = $request->sticker;
            $data->status = $request->status;
            $data->tanggal_expired = $request->tanggal_expired;
            $data->type = $request->type;
            if ($request->hasFile('upload_foto')) {
                $file = $request->file('upload_foto');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/spip/');
                $file->move($destinationPath, $name);
                $data->upload_foto = $name;
            }
            $data->save();

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('spip', ['type' => $request->type]);
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('spip', ['type' => $request->type]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $data = Spip::find($id);
            $data->delete();

            session()->flash('success', 'Data Berhasil dihapus!');
            return redirect()->route('spip', ['type' => $request->type]);
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('spip', ['type' => $request->type]);
        }
    }
}