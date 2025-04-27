<?php

namespace App\Http\Controllers\Backend;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
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
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }

        $data['page_title'] = 'Group';
        $data['data'] = Group::orderBy('created_at', 'desc')->get();
        
        return view('backend.pages.group.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user)) {
            abort(403, 'Halaman ini tidak dapat diakses.');
        }
        $data['page_title'] = 'Tambah Data Materi';
        return view('backend.pages.group.create', $data);
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
            $data = new Group();
            $data->nama = $request->nama;
            $data->link = $request->link;
            $data->deskripsi = $request->deskripsi;
            $data->save();

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('group');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('group');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
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

        $data['page_title'] = 'Edit Data Group';
        $data['group'] = Group::find($id);

        return view('backend.pages.group.edit', $data);
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
            $data = Group::find($id);
            $data->nama = $request->nama;
            $data->link = $request->link;
            $data->deskripsi = $request->deskripsi;
            $data->save();

            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('group');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('group');
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
            $data = Group::find($id);
            $data->delete();

            session()->flash('success', 'Data Berhasil dihapus!');
            return redirect()->route('group');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('group');
        }
    }
}
