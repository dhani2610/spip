@extends('backend.layouts-new.app')

@section('content')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        .select2 {
            width: 100% !important
        }

        label {
            float: left;
        }

        .course {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            max-width: 100%;
            margin: 20px;
            overflow: hidden;
            width: auto;
        }

        .course h6 {
            opacity: 0.6;
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .course h2 {
            letter-spacing: 1px;
            margin: 10px 0;
        }

        .course-preview {
            background-color: #2A265F;
            color: #fff;
            padding: 30px;
            max-width: 250px;
            width: 324px;
        }

        .course-preview a {
            color: #fff;
            display: inline-block;
            font-size: 12px;
            opacity: 0.6;
            margin-top: 30px;
            text-decoration: none;
        }

        .course-info {
            padding: 30px;
            position: relative;
            width: 100%;
            height: 230px;
        }

        .progress-container {
            position: absolute;
            top: 30px;
            right: 30px;
            text-align: right;
            width: 150px;
        }

        .progress {
            background-color: #ddd;
            border-radius: 3px;
            height: 5px;
            width: 100%;
        }

        .progress::after {
            border-radius: 3px;
            background-color: #2A265F;
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 5px;
            width: 66%;
        }

        .progress-text {
            font-size: 10px;
            opacity: 0.6;
            letter-spacing: 1px;
        }

        .btn-course {
            background-color: #2A265F;
            border: 0;
            border-radius: 50px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
            color: #fff;
            font-size: 16px;
            padding: 12px 25px;
            position: absolute;
            bottom: 30px;
            right: 30px;
            letter-spacing: 1px;
        }

        /* SOCIAL PANEL CSS */
        .social-panel-container {
            position: fixed;
            right: 0;
            bottom: 80px;
            transform: translateX(100%);
            transition: transform 0.4s ease-in-out;
        }

        .social-panel-container.visible {
            transform: translateX(-10px);
        }

        .social-panel {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 16px 31px -17px rgba(0, 31, 97, 0.6);
            border: 5px solid #001F61;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Muli';
            position: relative;
            height: 169px;
            width: 370px;
            max-width: calc(100% - 10px);
        }

        .social-panel button.close-btn {
            border: 0;
            color: #97A5CE;
            cursor: pointer;
            font-size: 20px;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .social-panel button.close-btn:focus {
            outline: none;
        }

        .social-panel p {
            background-color: #001F61;
            border-radius: 0 0 10px 10px;
            color: #fff;
            font-size: 14px;
            line-height: 18px;
            padding: 2px 17px 6px;
            position: absolute;
            top: 0;
            left: 50%;
            margin: 0;
            transform: translateX(-50%);
            text-align: center;
            width: 235px;
        }

        .social-panel p i {
            margin: 0 5px;
        }

        .social-panel p a {
            color: #FF7500;
            text-decoration: none;
        }

        .social-panel h4 {
            margin: 20px 0;
            color: #97A5CE;
            font-family: 'Muli';
            font-size: 14px;
            line-height: 18px;
            text-transform: uppercase;
        }

        .social-panel ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .social-panel ul li {
            margin: 0 10px;
        }

        .social-panel ul li a {
            border: 1px solid #DCE1F2;
            border-radius: 50%;
            color: #001F61;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            width: 50px;
            text-decoration: none;
        }

        .social-panel ul li a:hover {
            border-color: #FF6A00;
            box-shadow: 0 9px 12px -9px #FF6A00;
        }

        .floating-btn {
            border-radius: 26.5px;
            background-color: #001F61;
            border: 1px solid #001F61;
            box-shadow: 0 16px 22px -17px #03153B;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            line-height: 20px;
            padding: 12px 20px;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }

        .floating-btn:hover {
            background-color: #ffffff;
            color: #001F61;
        }

        .floating-btn:focus {
            outline: none;
        }

        .floating-text {
            background-color: #001F61;
            border-radius: 10px 10px 0 0;
            color: #fff;
            font-family: 'Muli';
            padding: 7px 15px;
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 998;
        }

        .floating-text a {
            color: #FF7500;
            text-decoration: none;
        }

        @media screen and (max-width: 480px) {

            .social-panel-container.visible {
                transform: translateX(0px);
            }

            .floating-btn {
                right: 10px;
            }
        }

        .two-line-limit {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .one-line-limit {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .avatar-initial {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            /* Adjust size as needed */
            height: 60px;
            /* Adjust size as needed */
            font-size: 43px;
            font-weight: bold;
            color: #fff;
            /* Text color */
            background-color: #007bff;
            /* Primary background color */
            border-radius: 50%;
            /* Rounded circle */
            padding: 70px !important
        }

        .course-item {
            transition: opacity 0.3s ease-in-out;
        }

        #noResultsMessage {
            margin-top: 20px;
            font-weight: bold;
            color: #ff0000;
        }

        .card-mobile {
            display: none;
        }

        @media (max-width: 779px) {
            .card-mobile {
                display: block;
            }

            .card-pc {
                display: none
            }

            .progress-text {
                font-size: 16px;
                opacity: 0.6;
                letter-spacing: 1px;
            }

            .btn-course {
                position: revert !important;
                float: right
            }
            .img-sidebar{
                height: 200px;
            }
        }
    </style>

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-lg-9">
                @foreach ($materi as $item)
                    <div class="row card-pc">
                        <div class="col-lg-12 course-item">
                            <div class="courses-container">
                                <div class="course">
                                    <div class="course-preview"
                                        style="background-image: url('{{ asset('assets/img/cover/' . $item->image_cover) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                    </div>
                                    <div class="course-info">
                                        <div class="progress-container">
                                            <span class="progress-text">
                                                @php
                                                    $dataquest = \App\Models\Pertanyaan::where('id_materi', $item->id)
                                                        ->get()
                                                        ->count();
                                                @endphp
                                                {{ $dataquest }} Pertanyaan
                                            </span>
                                        </div>
                                        <h2 class="one-line-limit mt-4 course-title">{{ $item->judul }}</h2>
                                        <p class="two-line-limit">{{ $item->description }}</p>
                                        <p class="two-line-limit">{{ $item->created_at }}</p>

                                        <a href="{{ route('detail.materi', $item->slug) }}" class="btn-course">Continue</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row card-mobile">
                        <div class="col-lg-12">
                            <div class="card mb-3 " style="width: auto;">
                                <img src="{{ asset('assets/img/cover/' . $item->image_cover) }}" class="card-img-top"
                                        alt="..." style="height: 200px; object-fit: cover; width: 100%;">
                                <div class="card-body">
                                    <span class="progress-text">
                                        @php
                                            $dataquest = \App\Models\Pertanyaan::where('id_materi', $item->id)
                                                ->get()
                                                ->count();
                                        @endphp
                                        {{ $dataquest }} Pertanyaan | {{ $item->created_at }}
                                    </span>
                                    <h2 class="one-line-limit mt-4 course-title">{{ $item->judul }}</h2>
                                    <p class="two-line-limit">{{ $item->description }}</p>

                                    <a href="{{ route('detail.materi', $item->slug) }}" class="btn-course"
                                        style="margin-top: 10px!important">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="noResultsMessage" style="display: none; color: red; text-align: center; font-size: 18px;">
                    Tidak ada judul materi untuk keyword: <span id="searchQueryText"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mb-4" style="background:transparent;border:2px solid white">
                    <div class="card-body">
                        <div class="customer-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                @php
                                    $usr = Auth::guard('admin')->user();
                                @endphp
                                @if ($usr != null)
                                    @php
                                        $words = explode(' ', $usr->name);
                                        $initials = '';
                                        foreach ($words as $word) {
                                            $initials .= strtoupper($word[0]);
                                        }
                                        // return $initials;
                                    @endphp
                                    <span class="avatar-initial rounded-circle bg-label-primary"
                                        style="font-size: 43px;">{{ $initials }}</span>
                                    <div class="customer-info text-center">
                                        <h4 class="mb-1 mt-2" style="color: white!important">{{ $usr->name }}</h4>
                                    </div>
                                @else
                                    <span class="avatar-initial rounded-circle bg-label-primary"
                                        style="    font-size: 43px;">GS</span>
                                    <h4 class="mb-1 mt-2" style="color: white!important">Guest</h4>
                                    <a href="{{ url('admin/login') }}" class="btn btn-info mt-3">Login</a>
                                @endif

                                <h4 class="mb-1 mt-3 mb-2" style="color: white!important">Pertanyaan Terkini</h4>

                                @foreach ($materi_more as $mm)
                                    <a href="{{ route('detail.materi', $mm->slug) }}">
                                        <div class="card mb-3"
                                            style="width: auto;background:transparent;border:2px solid white;">
                                            <div class="card-body" style="padding: 10px ">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <img src="{{ asset('assets/img/cover/' . $mm->image_cover) }}"
                                                            class="img-fluid img-sidebar" alt="..." style="object-fit: cover; width: 100%;border-radius:10px;margin-bottom : 5px">
                                                    </div>
                                                    <div class="col-lg-8" style="padding-left: 10px !important;">
                                                        <p class="card-text one-line-limit"
                                                            style="margin-bottom: 0px!important;color:white!important;">
                                                            {{ $mm->judul }}
                                                        </p>
                                                        <p class="card-text one-line-limit" style="color:white!important">
                                                            @php
                                                                $dataquest = \App\Models\Pertanyaan::where(
                                                                    'id_materi',
                                                                    $mm->id,
                                                                )
                                                                    ->get()
                                                                    ->count();
                                                            @endphp
                                                            {{ $dataquest }} Pertanyaan
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
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
                title: "Are you sure delete this data?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete URL if confirmed
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>
@endsection
