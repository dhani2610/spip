<?php

namespace App\Http\Controllers\Backend;

use App\Models\Paket;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketController extends Controller
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
    public function index()
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        $data['page_title'] = 'Paket';
        $data['data'] = Paket::orderBy('created_at', 'desc')->whereNull('deleted_at')->get();
        
        return view('backend.pages.paket.index', $data);
    }

    public function history()
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        $data['page_title'] = 'Paket';

        $user = Auth::guard('admin')->user();

        if ($user->can('history.view.all')) {
            $data['data'] = Transaksi::orderBy('created_at', 'desc')->get();
        } elseif ($user->can('history.view.by.account')) {
            $data['data'] = Transaksi::where('id_user', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $data['data'] = collect();
        }

        return view('backend.pages.paket.history', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        $data['page_title'] = 'Tambah Paket';
        $data['groups'] = Group::orderBy('created_at', 'desc')->get();
        
        return view('backend.pages.paket.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'type' => 'required|string',
                'harga' => 'required|numeric',
                'harga_coret' => 'nullable|numeric',
                'benefit' => 'required|array',
                'group' => 'required|array',
                'include_asset' => 'nullable|boolean',
                'asset' => 'nullable|array',
                'status' => 'required|in:0,1',
            ]);
        
            $paket = new Paket();
            $paket->nama = $request->nama;
            $paket->type = $request->type;
            $paket->harga = $request->harga;
            $paket->harga_coret = $request->harga_coret;
            $paket->benefit = json_encode($request->benefit);
            $paket->group = json_encode($request->group);
            $paket->include_asset = $request->include_asset ?? 0;
            $paket->asset = json_encode($request->asset ?? []);
            $paket->status = $request->status;
            $paket->save();

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('paket');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('paket');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        $data['page_title'] = 'Tambah Paket';
        $data['paket'] = Paket::find($id);
        $data['groups'] = Group::orderBy('created_at', 'desc')->get();
        return view('backend.pages.paket.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'type' => 'required|string',
                'harga' => 'required|numeric',
                'harga_coret' => 'nullable|numeric',
                'benefit' => 'required|array',
                'group' => 'required|array',
                'include_asset' => 'nullable|boolean',
                'asset' => 'nullable|array',
                'status' => 'required|in:0,1',
            ]);
        
            $paket = Paket::find($id);
            $paket->nama = $request->nama;
            $paket->type = $request->type;
            $paket->harga = $request->harga;
            $paket->harga_coret = $request->harga_coret;
            $paket->benefit = json_encode($request->benefit);
            $paket->group = json_encode($request->group);
            $paket->include_asset = $request->include_asset ?? 0;
            $paket->asset = json_encode($request->asset ?? []);
            $paket->status = $request->status;
            $paket->save();

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('paket');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('paket');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        try {
            $data = Paket::find($id);
            $data->deleted_at = date('Y-m-d H:i:s');
            $data->save();

            session()->flash('success', 'Data Berhasil dihapus!');
            return redirect()->route('paket');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('paket');
        }
    }

    public function checkout($paket_id){
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        $data['page_title'] = 'Checkout Panel';
        $data['data'] = Paket::find($paket_id);

        return view('backend.pages.paket.checkout', $data);
    }
    public function successPage(){
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }
        
        $data['page_title'] = 'Success Payment';

        return view('backend.pages.paket.success', $data);
    }
}
