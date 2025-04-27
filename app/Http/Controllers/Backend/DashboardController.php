<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
        }

        $data['page_title'] = 'Dashboard';
        $userRole = Auth::guard('admin')->user()->getRoleNames()->first(); // Get the first role name
        if ($userRole != 'user') {
            $tahunReq = $request->tahun;

            if ($tahunReq != null) {
               $tahun = $tahunReq;
            }else{
                $tahun = date('Y');
            }
    
            $data['total_transaksi'] = Transaksi::whereYear('tanggal',$tahun)->get()->count();
            $data['total_saldo'] = Transaksi::whereYear('tanggal',$tahun)->get()->sum('total_harga');

            $data['saldo_masuk'] = [];
            $bulan = range(1,12);
            foreach ($bulan as $key => $value) {
                $cekSaldoMasuk = Transaksi::whereYear('tanggal',$tahun)->whereMonth('tanggal',$value)->get()->sum('total_harga');
                array_push($data['saldo_masuk'], $cekSaldoMasuk);
            }
    
            $data['tahun'] = $tahun;
        } else {
            $data['transaksi'] = Transaksi::where('paket_id',Auth::guard('admin')->user()->id_paket)->orderBy('created_at', 'desc')->first();
            $data['data'] = Paket::orderBy('created_at', 'desc')->whereNull('deleted_at')->get();
        }

        return view('backend.pages.dashboard.index', $data);
    }
}
