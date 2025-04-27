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
            <form action="{{ route('group.update',$group->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title text-center">Update Data</h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="jenis">Group</label>
                                        <input type="text" class="form-control" id="nama" value="{{ $group->nama }}" name="nama" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="merek">Link Group</label>
                                        <input type="text" class="form-control" id="link" value="{{ $group->link }}" name="link" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-2" for="jenis_unit">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" required id="">{{ $group->deskripsi }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary mt-4" type="submit" style="float: right">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  
@endsection
