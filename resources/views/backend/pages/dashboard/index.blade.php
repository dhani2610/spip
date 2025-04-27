@extends('backend.layouts-new.app')

@section('title')
    Dashboard Page - Admin Panel
@endsection

@php
    $userRole = Auth::guard('admin')->user()->getRoleNames()->first(); // Get the first role name
@endphp

@if ($userRole != 'user')
    @section('content')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
            rel="stylesheet" />

        <form action="" method="get">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="number" id="datepicker" placeholder="Tahun: {{ date('Y') }}"
                            value="{{ $tahun ?? date('Y') }}" name="tahun" class="date-own form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card" style="background: #f6932f">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100">
                                    <h2 class="font-weight-bolder" style="color: white">Total Transaksi</h2>
                                    <h2 class="font-weight-bolder" style="color: white">{{ $total_transaksi }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card" style="background: #6B5252">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100">
                                    <h2 class="font-weight-bolder" style="color: white">Total Pendapatan</h2>
                                    <h2 class="font-weight-bolder" style="color: white">@currency($total_saldo)</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div id="container"></div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



        <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Transaksi',
                    align: 'left'
                },
                subtitle: {
                    text: 'Periode: {{ $tahun }}',
                    align: 'left'
                },
                xAxis: {
                    categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    crosshair: true,
                    accessibility: {
                        description: 'Months'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total'
                    }
                },
                tooltip: {
                    valueSuffix: ' Rp.',
                    pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y:,.0f}</b><br/>'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:,.0f} Rp.',
                            style: {
                                color: '#333'
                            }
                        }
                    }
                },
                series: [{
                        name: 'Transaksi',
                        data: @json($saldo_masuk),
                        color: 'green' // Warna hijau
                    }

                ]
            });

            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
            // 
        </script>
    @else
    @section('content')
        <div class="p-4 mb-4 rounded" style="background-color: #fff7e6;">
            <h5 class="fw-bold mb-2" style="font-size: 35px;color: #6b5252">
                Hai, {{ Auth::guard('admin')->user()->name }}! 🌻
            </h5>
            <p class="mb-0" style="font-size: 20px;font-weight: 600;color: #6b5252;">
                Selamat datang di ruang pemulihanmu. Di sini kamu bisa pantau progres, akses materi, 
                dan terhubung dengan support kami kapan pun dibutuhkan.
            </p>
        </div>
    
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                @php
                    if (!empty($transaksi)) {
                        $expired = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($transaksi->sampai_tanggal));
                        $fresh = false;
                    }else{
                        $expired = [];
                        $fresh = true;
                    }
                @endphp

                @if (!empty($expired) || $fresh == true)
                    <style>
                        :root {
                            --default-font: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                            --heading-font: "Nunito", sans-serif;
                            --nav-font: "Inter", sans-serif;
                        }

                        /* Global Colors - The following color variables are used throughout the website. Updating them here will change the color scheme of the entire website */
                        :root {
                            --background-color: #ffffff;
                            /* Background color for the entire website, including individual sections */
                            --default-color: #212529;
                            /* Default color used for the majority of the text content across the entire website */
                            --heading-color: #2d465e;
                            /* Color for headings, subheadings and title throughout the website */
                            --accent-color: #6B5252;
                            /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
                            --surface-color: #ffffff;
                            /* The surface color is used as a background of boxed elements within sections, such as cards, icon boxes, or other elements that require a visual separation from the global background. */
                            --contrast-color: #ffffff;
                            /* Contrast color for text, ensuring readability against backgrounds of accent, heading, or default colors. */
                        }

                        /* Nav Menu Colors - The following color variables are used specifically for the navigation menu. They are separate from the global colors to allow for more customization options */
                        :root {
                            --nav-color: #212529;
                            /* The default color of the main navmenu links */
                            --nav-hover-color: #6B5252;
                            /* Applied to main navmenu links when they are hovered over or active */
                            --nav-mobile-background-color: #ffffff;
                            /* Used as the background color for mobile navigation menu */
                            --nav-dropdown-background-color: #ffffff;
                            /* Used as the background color for dropdown items that appear when hovering over primary navigation items */
                            --nav-dropdown-color: #212529;
                            /* Used for navigation links of the dropdown items in the navigation menu. */
                            --nav-dropdown-hover-color: #6B5252;
                            /* Similar to --nav-hover-color, this color is applied to dropdown navigation links when they are hovered over. */
                        }

                        .pricing .pricing-card {
                            height: 100%;
                            padding: 2rem;
                            background: var(--surface-color);
                            border-radius: 1rem;
                            transition: all 0.3s ease;
                            position: relative;
                        }

                        .pricing .pricing-card:hover {
                            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                        }

                        .pricing .pricing-card.popular {
                            background: var(--accent-color);
                            color: var(--contrast-color);
                        }

                        .pricing .pricing-card.popular h3,
                        .pricing .pricing-card.popular h4 {
                            color: var(--contrast-color);
                        }

                        .pricing .pricing-card.popular .price .currency,
                        .pricing .pricing-card.popular .price .amount,
                        .pricing .pricing-card.popular .price .period {
                            color: var(--contrast-color);
                        }

                        .pricing .pricing-card.popular .features-list li {
                            color: var(--contrast-color);
                        }

                        .pricing .pricing-card.popular .features-list li i {
                            color: var(--contrast-color);
                        }

                        .pricing .pricing-card.popular .btn-light {
                            background: var(--contrast-color);
                            color: var(--accent-color);
                        }

                        .pricing .pricing-card.popular .btn-light:hover {
                            background: color-mix(in srgb, var(--contrast-color), transparent 10%);
                        }

                        .pricing .pricing-card .popular-badge {
                            position: absolute;
                            top: -12px;
                            left: 50%;
                            transform: translateX(-50%);
                            background: var(--contrast-color);
                            color: var(--accent-color);
                            padding: 0.5rem 1rem;
                            border-radius: 2rem;
                            font-size: 0.875rem;
                            font-weight: 600;
                            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.08);
                        }

                        .pricing .pricing-card h3 {
                            font-size: 1.5rem;
                            margin-bottom: 1rem;
                        }

                        .pricing .pricing-card .price {
                            margin-bottom: 1.5rem;
                        }

                        .pricing .pricing-card .price .currency {
                            font-size: 1.5rem;
                            font-weight: 600;
                            vertical-align: top;
                            line-height: 1;
                        }

                        .pricing .pricing-card .price .amount {
                            font-size: 3.5rem;
                            font-weight: 700;
                            line-height: 1;
                        }

                        .pricing .pricing-card .price .period {
                            font-size: 1rem;
                            color: color-mix(in srgb, var(--default-color), transparent 40%);
                        }

                        .pricing .pricing-card .description {
                            margin-bottom: 2rem;
                            font-size: 0.975rem;
                        }

                        .pricing .pricing-card h4 {
                            font-size: 1.125rem;
                            margin-bottom: 1rem;
                        }

                        .pricing .pricing-card .features-list {
                            list-style: none;
                            padding: 0;
                            margin: 0 0 2rem 0;
                        }

                        .pricing .pricing-card .features-list li {
                            display: flex;
                            align-items: center;
                            margin-bottom: 1rem;
                        }

                        .pricing .pricing-card .features-list li i {
                            color: var(--accent-color);
                            margin-right: 0.75rem;
                            font-size: 1.25rem;
                        }

                        .pricing .pricing-card .btn {
                            width: 100%;
                            padding: 0.75rem 1.5rem;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 0.5rem;
                            font-weight: 500;
                            border-radius: 50px;
                        }

                        .pricing .pricing-card .btn.btn-primary {
                            background: var(--accent-color);
                            border: none;
                            color: var(--contrast-color);
                        }

                        .pricing .pricing-card .btn.btn-primary:hover {
                            background: color-mix(in srgb, var(--accent-color), transparent 15%);
                        }
                    </style>
                    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

                    @if ($fresh == false)
                        <div class="alert alert-danger" style="background-color: #ff3e1d;">
                            Paket Anda telah <strong>expired</strong> pada tanggal
                            {{ \Carbon\Carbon::parse($transaksi->sampai_tanggal)->format('d M Y') }}.
                            Silakan pilih paket baru di bawah ini untuk melanjutkan layanan Anda.
                        </div>
                    @endif

                    <!-- Pricing Section -->
                    <section id="pricing" class="pricing section light-background">

                        <!-- Section Title -->
                        <div class="container section-title mb-5" data-aos="fade-up">
                            <center>
                                <h2 style="font-weight: 800">Data Paket</h2>
                                <p>
                                    🌱 Belum ada paket aktif yang kamu ikuti saat ini.
                                </p>
                                <a href="#program" class="btn" style="background-color: #d2a48f; color: white; border-radius: 12px; padding: 10px 20px;">
                                    Pilih Program Sekarang
                                </a>
                            </center>
                        </div><!-- End Section Title -->

                        <div class="container" id="program" data-aos="fade-up" data-aos-delay="100">

                            <div class="row g-4 justify-content-center">

                                @foreach ($data as $item)
                                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                                        <div class="pricing-card popular">
                                            <div class="popular-badge">Most Popular</div>
                                            <h3>{{ $item->nama }}</h3>
                                            <div class="price">
                                                @if (!empty($item->harga_coret) && $item->harga_coret != 0)
                                                    <div class="old-price mb-1">
                                                        <i>
                                                            <span class="text-white" style="text-decoration: line-through;">
                                                                Rp{{ number_format($item->harga_coret, 0, ',', '.') }}
                                                            </span>
                                                        </i>
                                                    </div>
                                                @endif
                                                <span class="currency">Rp</span>
                                                <span class="amount">{{ number_format($item->harga, 0, ',', '.') }}</span>
                                                <span class="period">/ {{ $item->type }}</span>
                                            </div>
                                            <p class="description">Bersama kami, temukan solusi untuk setiap tantangan yang
                                                menghambat
                                                perjalanan move onmu. Kami siap mendampingimu menuju kehidupan yang lebih
                                                baik.</p>

                                            <h4>Featured Included:</h4>
                                            <ul class="features-list" style="margin-bottom: 22%">
                                                @foreach (json_decode($item->benefit) as $index => $benefit)
                                                    <li>
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        {{ $benefit }}
                                                    </li>
                                                @endforeach
                                            </ul>


                                            <a href="{{ route('paket.checkout', $item->id) }}" class="btn btn-light mt-3"
                                                data-id="{{ $item->id }}">
                                                Subscribe Now <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </section><!-- /Pricing Section -->
                @else
                    <h5 class="card-title">
                        Paket Aktif:
                        <span class="badge bg-primary">{{ $transaksi->nama }}</span>
                    </h5>
                    <p class="mb-1">
                        <strong>Masa Aktif:</strong>
                        <span class="badge bg-success">
                            {{ \Carbon\Carbon::parse($transaksi->dari_tanggal)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($transaksi->sampai_tanggal)->format('d M Y') }}
                        </span>
                    </p>

                    <hr>

                    <p><strong>Durasi:</strong> {{ $transaksi->durasi }} {{ $transaksi->type }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>

                    <p><strong>Benefit:</strong></p>
                    <ul>
                        @foreach (json_decode($transaksi->benefit, true) as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>

                    @if ($transaksi->include_asset)
                        <hr>
                        <p><strong>Akses Materi:</strong></p>

                        <ul class="nav nav-tabs" id="assetTab" role="tablist">
                            @foreach (json_decode($transaksi->asset, true) as $index => $asset)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                        id="tab-{{ $index }}" data-bs-toggle="tab"
                                        data-bs-target="#asset-{{ $index }}" type="button" role="tab">
                                        {{ strtoupper($asset['type']) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content mt-3" id="assetTabContent">
                            @foreach (json_decode($transaksi->asset, true) as $index => $asset)
                                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                    id="asset-{{ $index }}" role="tabpanel">
                                    @if ($asset['type'] === 'mp3')
                                        {{-- <audio controls style="width: 100%;">
                                            <source src="https://drive.google.com/uc?export=download&id={{ $asset['link'] }}"
                                                type="audio/mpeg">
                                            Browser Anda tidak mendukung audio.
                                        </audio> --}}
                                        <iframe src="https://drive.google.com/file/d/{{ $asset['link'] }}/preview"
                                            width="100%" height="80" allow="autoplay"></iframe>
                                    @elseif($asset['type'] === 'word')
                                        <iframe src="https://drive.google.com/file/d/{{ $asset['link'] }}/preview"
                                            width="100%" height="400" allow="autoplay"></iframe>
                                    @elseif($asset['type'] === 'pdf')
                                        <iframe src="https://drive.google.com/file/d/{{ $asset['link'] }}/preview"
                                            width="100%" height="600" allow="autoplay"></iframe>
                                    @elseif($asset['type'] === 'video' || $asset['type'] === 'mp4')
                                        <iframe src="https://drive.google.com/file/d/{{ $asset['link'] }}/preview"
                                            width="100%" height="400" allow="autoplay"></iframe>
                                    @else
                                        <a href="https://drive.google.com/uc?export=download&id={{ $asset['link'] }}"
                                            target="_blank" class="btn btn-sm btn-outline-secondary">
                                            Download File
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </div>
    @endif
@endsection
