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

        .asset-table tbody tr td {
            padding: 10px;
        }

        .asset-table .remove-row {
            cursor: pointer;
            color: red;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            border: none !important;
            background: none !important;
        }

        /* Style for the switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide the default checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Style for the slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        /* The circle inside the slider */
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
        }

        /* When the checkbox is checked, change the slider color and move the circle */
        input:checked+.slider {
            background-color: #4CAF50;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }
    </style>

    <div class="main-content-inner">
        <div class="row">
            <form action="{{ route('paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title text-center">Edit Data Paket</h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Status -->
                                    <div class="form-group col-md-12">
                                        <label class="mt-3" for="">Status</label>
                                        <select name="status" id="" class="form-control" required>
                                            <option value="1" {{ $paket->status == 1 ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0" {{ $paket->status == 0 ? 'selected' : '' }}>Tidak Aktif
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Nama Paket -->
                                    <div class="form-group col-md-12">
                                        <label class="mt-3" for="nama">Nama Paket</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ old('nama', $paket->nama) }}" required>
                                    </div>

                                    <!-- Tipe Paket -->
                                    <div class="form-group col-md-12">
                                        <label class="mt-3" for="type">Tipe</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="month" {{ $paket->type == 'month' ? 'selected' : '' }}>Bulan
                                            </option>
                                            <option value="week" {{ $paket->type == 'week' ? 'selected' : '' }}>Minggu
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Harga Paket -->
                                    <div class="form-group col-md-12">
                                        <label class="mt-3" for="harga">Harga Coret (IDR)</label>
                                        <input type="number" class="form-control" id="harga_coret" name="harga_coret" value="{{ old('harga_coret', $paket->harga_coret) }}" required>
                                        <small style="color: red">0 jika tidak ingin ditampilkan</small>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mt-3" for="harga">Harga (IDR)</label>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            value="{{ old('harga', $paket->harga) }}" required>
                                    </div>

                                    <!-- Benefit -->
                                    <div class="form-group col-md-12">
                                        <label class="mt-3" for="benefit">Benefit</label>
                                        <div id="benefit-fields">
                                            @foreach (json_decode($paket->benefit) as $benefit)
                                                <div class="input-group mb-3">
                                                    <input type="text" name="benefit[]" class="form-control"
                                                        value="{{ $benefit }}" placeholder="Tambah Benefit" required>
                                                    <button type="button" class="btn btn-danger remove-benefit">-</button>
                                                </div>
                                            @endforeach
                                            <button type="button" class="btn btn-success add-benefit">+</button>
                                        </div>
                                    </div>

                                    <!-- Group (Select2 Multiple) -->
                                    <div class="form-group col-md-12">
                                        <label class="mt-3" for="group">Group</label>
                                        <select class="form-control select2" name="group[]" id="group"
                                            multiple="multiple">
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ in_array($group->id, json_decode($paket->group)) ? 'selected' : '' }}>
                                                    {{ $group->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Include Asset -->
                                    <div class="form-group col-md-12 mt-3">
                                        <label for="include_asset" style="margin-top: 4px;margin-right: 10px;">Include
                                            Asset</label>
                                        <label class="switch">
                                            <input type="checkbox" id="include_asset" name="include_asset" value="1"
                                                {{ $paket->include_asset ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                    </div>

                                    <br><br>

                                    <div class="form-group col-md-12">
                                        <div id="asset-section"
                                            style="{{ $paket->include_asset ? '' : 'display: none;' }}">
                                            <table class="table asset-table">
                                                <thead>
                                                    <tr>
                                                        <th>Link Drive</th>
                                                        <th>Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (json_decode($paket->asset) as $index => $asset)
                                                        <tr>
                                                            <td><input type="text"
                                                                    name="asset[{{ $index }}][link]"
                                                                    class="form-control" value="{{ $asset->link }}"></td>
                                                            <td>
                                                                <select name="asset[{{ $index }}][type]"
                                                                    class="form-control">
                                                                    <option value="pdf"
                                                                        {{ $asset->type == 'pdf' ? 'selected' : '' }}>PDF
                                                                    </option>
                                                                    <option value="excel"
                                                                        {{ $asset->type == 'excel' ? 'selected' : '' }}>
                                                                        Excel</option>
                                                                    <option value="video"
                                                                        {{ $asset->type == 'video' ? 'selected' : '' }}>
                                                                        Video</option>
                                                                    <option value="mp3"
                                                                        {{ $asset->type == 'mp3' ? 'selected' : '' }}>MP3
                                                                    </option>
                                                                    <option value="word"
                                                                        {{ $asset->type == 'word' ? 'selected' : '' }}>Word
                                                                    </option>
                                                                    <option value="ppt"
                                                                        {{ $asset->type == 'ppt' ? 'selected' : '' }}>PPT
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td><button type="button"
                                                                    class="btn btn-danger remove-row">Remove</button></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn btn-primary" id="add-asset-row">Tambah
                                                Asset</button>
                                        </div>
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

<!-- Add Select2 CSS in the <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
    <!-- Add this in the <head> section or just before </body> tag -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>
    $(document).ready(function() {
        $('#include_asset').change(function() {
            if ($(this).prop('checked')) {
                $('#asset-section').show();
            } else {
                $('#asset-section').hide();
            }
        });

        $('.add-benefit').click(function() {
            $('#benefit-fields').append(
                '<div class="input-group mb-3"><input type="text" name="benefit[]" class="form-control" placeholder="Tambah Benefit" required><button type="button" class="btn btn-danger remove-benefit">-</button></div>'
                );
        });

        $(document).on('click', '.remove-benefit', function() {
            $(this).parent().remove();
        });

        $('#add-asset-row').click(function() {
            let rowCount = $('.asset-table tbody tr').length;
            $('.asset-table tbody').append('<tr><td><input type="text" name="asset[' + rowCount +
                '][link]" class="form-control"></td><td><select name="asset[' + rowCount +
                '][type]" class="form-control"><option value="pdf">PDF</option><option value="excel">Excel</option><option value="video">Video</option><option value="mp3">MP3</option><option value="word">Word</option><option value="ppt">PPT</option></select></td><td><button type="button" class="btn btn-danger remove-row">Remove</button></td></tr>'
                );
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
