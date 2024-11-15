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
        }
    </style>
    @php
        $usr = Auth::guard('admin')->user();
        if ($usr != null) {
            $userRole = Auth::guard('admin')->user()->getRoleNames()->first(); // Get the first role name
        }

    @endphp

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Data {{ Request::get('type') }}</h4>
                        <p class="float-right mb-2">
                            <a href="{{ route('spip.create') }}?type={{ Request::get('type') }}"
                                class="btn btn-primary text-white mb-3">
                                Tambah Data {{ Request::get('type') }}
                            </a>
                        </p>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            @include('backend.layouts.partials.messages')
                            <table id="dataTable" class="table text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>NO</th>
                                        <th>Jenis</th>
                                        <th>Merek</th>
                                        <th>Jenis Unit</th>
                                        <th>Perusahaan</th>
                                        <th>Nomor Unit</th>
                                        <th>Commisioner</th>
                                        <th>Tanggal Commisioning</th>
                                        <th>Admin Name</th>
                                        <th>Tanggal Expired</th>
                                        <th>Sisa Hari</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($spips as $index => $spip)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $spip->jenis }}</td>
                                            <td>{{ $spip->merek }}</td>
                                            <td>{{ $spip->jenis_unit }}</td>
                                            <td>{{ $spip->perusahaan }}</td>
                                            <td>{{ $spip->nomor_unit }}</td>
                                            <td>{{ $spip->commisioner }}</td>
                                            <td>{{ $spip->tanggal_commisioning }}</td>
                                            @php
                                                $userct = App\Models\Admin::where('id', $spip->user)->first();
                                            @endphp
                                            @if ($userct)
                                                <td>{{ $userct->name ?? '-' }}</td>
                                            @else
                                                <td>{{ '-' }}</td>
                                            @endif
                                            <td>{{ $spip->tanggal_expired }}</td>

                                            <td>
                                                @php
                                                    $now = \Carbon\Carbon::now();
                                                    $expiredDate = $spip->tanggal_expired
                                                        ? \Carbon\Carbon::parse($spip->tanggal_expired)
                                                        : null;
                                                    $status =
                                                        $expiredDate && $expiredDate->isFuture() ? 'Active' : 'Expired';

                                                    if ($expiredDate) {
                                                        // Get absolute months and days difference
                                                        $months = $now->diffInMonths($expiredDate, false); // false for negative differences
                                                        $days = $now->diffInDays(
                                                            $expiredDate->copy()->subMonths(abs($months)),
                                                            false,
                                                        ); // remaining days after months difference

                                                        // Ensure both are integers and format them as needed
                                                        $months = (int) $months;
                                                        $days = (int) $days;

                                                        // Format the remaining time
                                                        $remaining =
                                                            ($months < 0 ? $months : "+$months") .
                                                            ' BULAN; ' .
                                                            ($days < 0 ? $days : "+$days") .
                                                            ' HARI';
                                                    } else {
                                                        $remaining = '-';
                                                    }
                                                @endphp

                                                {{ $remaining }}
                                            </td>
                                            <td>{{ $status }}</td>

                                            <td>
                                                @if ($spip->upload_foto)
                                                    <img src="{{ asset('assets/img/spip/' . $spip->upload_foto) }}"
                                                        alt="Foto SPIP" style="max-width: 100px;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($userRole == 'superadmin')
                                                    <a href="{{ route('spip.mail.reminder', $spip->id) }}"
                                                        class="btn btn-info text-white">
                                                        <i class="far fa-bell	"></i>
                                                    </a>
                                                    <a href="{{ route('spip.edit', $spip->id) }}?type={{ Request::get('type') }}"
                                                        class="btn btn-success text-white">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a onclick="confirmDelete('{{ route('spip.destroy', $spip->id) }}?type={{ Request::get('type') }}')"
                                                        class="btn btn-danger text-white">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(deleteUrl) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure you want to delete this data?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>
@endsection