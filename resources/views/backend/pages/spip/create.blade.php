@extends('backend.layouts-new.app')

@section('content')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        .select2 {
            width: 100% !important;
        }

        label {
            float: left;
            color: black;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
    </style>

    <div class="main-content-inner">
        <div class="row">
            <form action="{{ route('spip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title text-center">Tambah {{ Request::get('type') }}</h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="jenis">Jenis</label>
                                        <input type="text" class="form-control" id="jenis" name="jenis" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="merek">Merek</label>
                                        <input type="text" class="form-control" id="merek" name="merek" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="jenis_unit">Jenis Unit</label>
                                        <input type="text" class="form-control" id="jenis_unit" name="jenis_unit"
                                            required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="perusahaan">Perusahaan</label>
                                        <input type="text" class="form-control" id="perusahaan" name="perusahaan"
                                            required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="nomor_unit">Nomor Unit</label>
                                        <input type="text" class="form-control" id="nomor_unit" name="nomor_unit"
                                            required>
                                    </div>
                                    @php
                                        $usr = Auth::guard('admin')->user();
                                        if ($usr != null) {
                                            $userRole = Auth::guard('admin')->user()->getRoleNames()->first(); // Get the first role name
                                        }

                                    @endphp
                                    @if ($userRole == 'superadmin')
                                        <div class="form-group col-md-12">
                                            <label for="user">User</label>
                                            <select class="form-control" name="user" id="user">
                                                @foreach ($admins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <input type="hidden" value="{{ Auth::guard('admin')->user()->id }}" name="user">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="commisioner">Commissioner</label>
                                        <input type="text" class="form-control" id="commisioner" name="commisioner"
                                            required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="tanggal_commisioning">Tanggal Commisioning</label>
                                        <input type="date" class="form-control" id="tanggal_commisioning"
                                            name="tanggal_commisioning">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="deviasi">Deviasi</label>
                                        <textarea class="form-control" id="deviasi" name="deviasi"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="sticker">Sticker</label>
                                        <select name="sticker" class="form-control" id="">
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="status">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="tanggal_expired">Tanggal Expired</label>
                                        <input type="date" class="form-control" id="tanggal_expired"
                                            name="tanggal_expired">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="upload_foto">Upload Foto</label>
                                        <input type="file" class="form-control dropify" id="upload_foto"
                                            name="upload_foto">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">


                                <input type="hidden" class="form-control" value="{{ Request::get('type') }}"
                                    id="type" name="type" required>
                            </div>
                            <button class="btn btn-primary mt-4" type="submit">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
