@extends('frontend.layouts.app')

@section('content-frontend')
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                        <div class="company-badge mb-4">
                            <i class="bi bi-gear-fill me-2"></i>
                            Bekerja untuk kesuksesan Anda
                        </div>

                        <h1 class="mb-4">
                            Bangkit dari Luka Akibat Perselingkuhan. <br>
                            Disinilah Bunda Bisa Menyembuhkan Hati <br> dan Menyusun Kepercayaan Kembali<br>
                            <span class="accent-text">Konsultasi Untuk Awal Baru</span>
                        </h1>

                        <p class="mb-4 mb-md-5">
                            <b>Diselingkuhi bukan akhir segalanya.</b> <br>
                            Di platform Teman Move On, Bunda tidak sendiri. Kami mendampingi proses penyembuhan luka batin, membangun kembali harga diri, dan melangkah menuju hidup yang lebih tenang, kuat, dan penuh cinta.
                        </p>

                        <div class="hero-buttons">
                            <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Mulai Sembuh & Bangkit</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                        <img src="{{ asset('frontend/assets/img/hero-image.png') }}" alt="Hero Image"
                            class="img-fluid">

                        <div class="customers-badge">
                            <div class="customer-avatars">
                                <img src="{{ asset('frontend/assets/img/avatar-1.webp') }}" alt="Customer 1" class="avatar">
                                <img src="{{ asset('frontend/assets/img/avatar-2.webp') }}" alt="Customer 2" class="avatar">
                                <img src="{{ asset('frontend/assets/img/avatar-3.webp') }}" alt="Customer 3" class="avatar">
                                <img src="{{ asset('frontend/assets/img/avatar-4.webp') }}" alt="Customer 4" class="avatar">
                                <img src="{{ asset('frontend/assets/img/avatar-5.webp') }}" alt="Customer 5" class="avatar">
                                <span class="avatar more">12+</span>
                            </div>
                            <p class="mb-0 mt-2">12.000+ orang telah dibantu untuk move on dan memulai babak baru dalam
                                hidup</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            {{-- <i class="bi bi-trophy"></i> --}}
                            🏆
                        </div>
                        <div class="stat-content">
                            <h4>Lebih dari 6 Tahun Memandu Proses Penyembuhan</h4>
                            <p class="mb-0">Memberdayakan perempuan untuk bangkit dari pengkhianatan dan trauma emosional</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            {{-- <i class="bi bi-chat-dots"></i> --}}
                            💬
                        </div>
                        <div class="stat-content">
                            <h4>10.000+ Klien Terbantu</h4>
                            <p class="mb-0">Setiap kisah diselingkuhi berakhir dengan pemulihan dan kepercayaan diri yang baru</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            {{-- <i class="bi bi-heart-fill"></i> --}}
                            ❤️
                        </div>
                        <div class="stat-content">
                            <h4>80.000+ Proses Transformatif</h4>
                            <p class="mb-0">Melalui sesi hipnoterapi, journaling, dan dukungan komunitas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            {{-- <i class="bi bi-flower1"></i> <!-- tidak ada ikon "flower1" di Bootstrap, mau diganti ikon lain? --> --}}
                            🌱
                        </div>
                        <div class="stat-content">
                            <h4>Komunitas yang Menguatkan</h4>
                            <p class="mb-0">Bersama perempuan lain yang memahami rasa sakit dan harapanmu</p>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 align-items-center justify-content-between">
                <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                    <span class="about-meta">MORE ABOUT US</span>
                    <h2 class="about-title">Bangkit dari Luka, Tenangkan Pikiran, Pulihkan Hati</h2>
                    <p class="about-description">
                        Teman Move On Community adalah komunitas pemulihan berbasis hypnotherapy healing untuk perempuan yang mengalami luka batin akibat perselingkuhan. Kami hadir untuk memberikan ruang aman, dukungan emosional, dan panduan pemulihan yang terstruktur agar setiap perempuan bisa bangkit, percaya diri, dan kembali menjalani hidup yang lebih bermakna.
                        
                        <br>
                        <br>
                        Kami telah membantu lebih dari 12.000 perempuan melalui sesi live, konsultasi grup, audio healing, dan program harian berbasis metode yang sudah terbukti.

                    </p>

                    <div class="row feature-list-wrapper">
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Hipnoterapi online aman & nyaman</li>
                                <li><i class="bi bi-check-circle-fill"></i> Mulai dari Rp 49.000/minggu</li>
                                <li><i class="bi bi-check-circle-fill"></i> Komunitas "Teman Move On"</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Terapi berbasis solusi</li>
                                <li><i class="bi bi-check-circle-fill"></i> Akses mudah & terjangkau</li>
                                <li><i class="bi bi-check-circle-fill"></i> Telah membantu 1000+ perempuan</li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-wrapper">
                        <div class="row gy-4">
                            <div class="col-lg-5">
                                <div class="profile d-flex align-items-center gap-3">
                                    <img src="{{ asset('frontend/assets/img/avatar-1.webp') }}" alt="Aldi Wonk Aksan"
                                        class="profile-image">
                                    <div>
                                        <h4 class="profile-name">Aldi Wonk Aksan</h4>
                                        <p class="profile-position">Life Coach & Founder</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="contact-info d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill"></i>
                                    <div>
                                        <p class="contact-label">Hubungi kami</p>
                                        <p class="contact-number">+62 838-2438-1172</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="image-wrapper">
                        <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                            <img src="{{ asset('frontend/assets/img/about-5.webp') }}" alt="Sesi Hipnoterapi"
                                class="img-fluid main-image rounded-4">
                            <img src="{{ asset('frontend/assets/img/about-2.webp') }}" alt="Komunitas Teman Move On"
                                class="img-fluid small-image rounded-4">
                        </div>
                        <div class="experience-badge floating">
                            <h3>1000+ <span>Perempuan</span></h3>
                            <p>Telah dibantu bangkit dari luka batin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About Section -->


    <!-- Services Section -->
    <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kenapa Harus Bergabung Dengan Kami?</h2>
            <p>Kami hadir untuk memberikan dukungan terbaik bagi perjalanan hidup Anda</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-4">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card d-flex">
                        <div class="icon flex-shrink-0">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div>
                            <h3>Mendapatkan Dukungan Secara Profesional</h3>
                            <p>Kami menyediakan dukungan dari tenaga profesional yang berpengalaman untuk membantu Anda
                                menghadapi berbagai persoalan hidup.</p>
                        </div>
                    </div>
                </div><!-- End Service Card -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card d-flex">
                        <div class="icon flex-shrink-0">
                            <i class="bi bi-journal-richtext"></i>
                        </div>
                        <div>
                            <h3>Bimbingan Intensif Selama 30 Hari</h3>
                            <p>Ikuti program bimbingan yang dirancang khusus selama 30 hari untuk memastikan Anda
                                mendapatkan hasil yang maksimal.</p>
                        </div>
                    </div>
                </div><!-- End Service Card -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card d-flex">
                        <div class="icon flex-shrink-0">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h3>Sesi Terapi Grup</h3>
                            <p>Bergabunglah dalam sesi terapi grup untuk berbagi, belajar, dan saling menguatkan dalam
                                suasana yang penuh empati.</p>
                        </div>
                    </div>
                </div><!-- End Service Card -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card d-flex">
                        <div class="icon flex-shrink-0">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <div>
                            <h3>Solusi Terbaik Untuk Rumah Tangga</h3>
                            <p>Dapatkan berbagai solusi dan pendekatan terbaik dalam menyelesaikan konflik dan membangun
                                keharmonisan rumah tangga Anda.</p>
                        </div>
                    </div>
                </div><!-- End Service Card -->

            </div>
        </div>

    </section><!-- /Services Section -->



    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row content justify-content-center align-items-center position-relative">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-4 mb-4">Mulai Perjalanan Penyembuhanmu Sekarang</h2>
                    {{-- <p class="mb-4">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                        Curae; Donec velit neque, auctor sit amet aliquam vel</p> --}}
                    <a href="#pricing" class="btn btn-cta">Subscribe</a>
                </div>

                <!-- Abstract Background Elements -->
                <div class="shape shape-1">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M47.1,-57.1C59.9,-45.6,68.5,-28.9,71.4,-10.9C74.2,7.1,71.3,26.3,61.5,41.1C51.7,55.9,35,66.2,16.9,69.2C-1.3,72.2,-21,67.8,-36.9,57.9C-52.8,48,-64.9,32.6,-69.1,15.1C-73.3,-2.4,-69.5,-22,-59.4,-37.1C-49.3,-52.2,-32.8,-62.9,-15.7,-64.9C1.5,-67,34.3,-68.5,47.1,-57.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>

                <div class="shape shape-2">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M41.3,-49.1C54.4,-39.3,66.6,-27.2,71.1,-12.1C75.6,3,72.4,20.9,63.3,34.4C54.2,47.9,39.2,56.9,23.2,62.3C7.1,67.7,-10,69.4,-24.8,64.1C-39.7,58.8,-52.3,46.5,-60.1,31.5C-67.9,16.4,-70.9,-1.4,-66.3,-16.6C-61.8,-31.8,-49.7,-44.3,-36.3,-54C-22.9,-63.7,-8.2,-70.6,3.6,-75.1C15.4,-79.6,28.2,-58.9,41.3,-49.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>

                <!-- Dot Pattern Groups -->
                <div class="dots dots-1">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <pattern id="dot-pattern" x="0" y="0" width="20" height="20"
                            patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        </pattern>
                        <rect width="100" height="100" fill="url(#dot-pattern)"></rect>
                    </svg>
                </div>

                <div class="dots dots-2">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <pattern id="dot-pattern-2" x="0" y="0" width="20" height="20"
                            patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        </pattern>
                        <rect width="100" height="100" fill="url(#dot-pattern-2)"></rect>
                    </svg>
                </div>

                <div class="shape shape-3">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M43.3,-57.1C57.4,-46.5,71.1,-32.6,75.3,-16.2C79.5,0.2,74.2,19.1,65.1,35.3C56,51.5,43.1,65,27.4,71.7C11.7,78.4,-6.8,78.3,-23.9,72.4C-41,66.5,-56.7,54.8,-65.4,39.2C-74.1,23.6,-75.8,4,-71.7,-13.2C-67.6,-30.4,-57.7,-45.2,-44.3,-56.1C-30.9,-67,-15.5,-74,0.7,-74.9C16.8,-75.8,33.7,-70.7,43.3,-57.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>
            </div>

        </div>

    </section><!-- /Call To Action Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimoni</h2>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-5">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-item">
                        <img src="{{ asset('frontend/assets/img/testimonials/img-testimoni.jpg') }}"
                            class="testimonial-img" alt="">
                        <h3>Bunda Windy</h3>
                        <h4>40 tahun, Ibu Rumah Tangga</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>Coach Aldi benar-benar membantu saya dari awal saya bener-bener bingung banget sampai
                                akhirnya ikut semua programnya dan bener-bener membuat saya sembuh.</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-item">
                        <img src="{{ asset('frontend/assets/img/testimonials/img-testimoni.jpg') }}"
                            class="testimonial-img" alt="">
                        <h3>Bunda Ani</h3>
                        <h4>35 tahun, Ibu Rumah Tangga</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>Dulu saya depresi berat setelah tahu suami selingkuh. Setelah ikut program 1 bulan, saya
                                bisa tidur nyenyak dan mulai bisa memaafkan. Yang paling berkesan adalah sesi hipnoterapi
                                yang membantu melepaskan beban di hati.</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-item">
                        <img src="{{ asset('frontend/assets/img/testimonials/img-testimoni.jpg') }}"
                            class="testimonial-img" alt="">
                        <h3>Bunda Sari</h3>
                        <h4>32 tahun, Pengusaha</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>Gak perlu keluar duit jutaan untuk mendapatkan layanan hipnoterapi karena dengan program
                                Teman Move On membantu semua para bunda yang mengalami luka batin akibat perselingkuhan.
                                Terima kasih Coach Aldi.</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="testimonial-item">
                        <img src="{{ asset('frontend/assets/img/testimonials/img-testimoni.jpg') }}"
                            class="testimonial-img" alt="">
                        <h3>Bunda Anita</h3>
                        <h4>45 tahun, Ibu Rumah Tangga</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>Ini baru membantu bunda yang mengalami kesulitan karena dengan ada program ini kita semua
                                bisa merasakan hipnoterapi dengan biaya terjangkau sekali. Terima kasih Coach Aldi.</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

            </div>

        </div>

    </section><!-- /Testimonials Section -->



    <!-- Pricing Section -->
    <section id="pricing" class="pricing section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Harga Layanan</h2>
            <p>Kami menawarkan berbagai paket hipnoterapi yang dirancang untuk mendukung proses pemulihanmu.</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-4 justify-content-center">

                @foreach ($data as $item)
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-card popular">
                            <div class="popular-badge">Most Popular</div>
                            <h3>{{ $item->nama }}</h3>
                            <div class="price">
                                @if(!empty($item->harga_coret) && $item->harga_coret != 0)
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
                            <p class="description">Bersama kami, temukan solusi untuk setiap tantangan yang menghambat
                                perjalanan move onmu. Kami siap mendampingimu menuju kehidupan yang lebih baik.</p>

                            <h4>Featured Included:</h4>
                            <ul class="features-list" style="margin-bottom: 22%">
                                @foreach (json_decode($item->benefit) as $index => $benefit)
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        {{ $benefit }}
                                    </li>
                                @endforeach
                            </ul>


                            <a href="{{ route('checkout', $item->id) }}" class="btn btn-light mt-3"
                                data-id="{{ $item->id }}">
                                Subscribe Now <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </section><!-- /Pricing Section -->

    <!-- Faq Section -->
    <section class="faq-9 faq section light-background" id="faq">
        <div class="container">
            <div class="row">

                <div class="col-lg-5" data-aos="fade-up">
                    <h2 class="faq-title">Pertanyaan yang Sering Diajukan</h2>
                    <p class="faq-description">Kami telah mengumpulkan beberapa pertanyaan umum yang sering ditanyakan oleh
                        klien kami. Temukan jawabannya di bawah ini.</p>
                    <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
                        <!-- Arrow SVG here (tidak diubah) -->
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
                    <div class="faq-container">

                        <div class="faq-item faq-active">
                            <h3>Apakah hipnoterapi ini aman?</h3>
                            <div class="faq-content">
                                <p>100% aman. Hipnoterapi adalah kondisi relaksasi pikiran yang alami, seperti ketika Anda
                                    hampir tertidur. Anda tetap sadar dan mengontrol diri sepenuhnya.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Berapa lama sampai saya melihat hasil?</h3>
                            <div class="faq-content">
                                <p>Kebanyakan klien merasakan perubahan dalam 1-2 minggu pertama. Namun hasil optimal
                                    biasanya terlihat setelah menyelesaikan program 30 hari.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Bagaimana jika suami saya tetap tidak berubah?</h3>
                            <div class="faq-content">
                                <p>Fokus program ini adalah menyembuhkan luka Anda terlebih dahulu. Ketika Anda sudah pulih,
                                    Anda akan lebih bijak mengambil keputusan tentang hubungan.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Bagaimana cara pembayarannya?</h3>
                            <div class="faq-content">
                                <p>Pembayaran via transfer bank (BCA/Mandiri/BRI), DANA, OVO, atau ShopeePay. Setelah
                                    pembayaran, Anda akan mendapat akses langsung ke semua materi.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>
                </div>

            </div>
        </div>
    </section><!-- /Faq Section -->
    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row content justify-content-center align-items-center position-relative">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-4">Garansi 100% Uang Kembali</h2>
                    <p class="mb-4">
                        Jika dalam 7 hari Anda tidak merasakan manfaat sama sekali, kami akan mengembalikan uang Anda tanpa
                        pertanyaan. Tidak ada risiko untuk mencoba.
                    </p>
                    <a href="#pricing" class="btn btn-cta">Subscribe</a>
                </div>

                <!-- Background Elements (unchanged) -->
                <div class="shape shape-1">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M47.1,-57.1C59.9,-45.6,68.5,-28.9,71.4,-10.9C74.2,7.1,71.3,26.3,61.5,41.1C51.7,55.9,35,66.2,16.9,69.2C-1.3,72.2,-21,67.8,-36.9,57.9C-52.8,48,-64.9,32.6,-69.1,15.1C-73.3,-2.4,-69.5,-22,-59.4,-37.1C-49.3,-52.2,-32.8,-62.9,-15.7,-64.9C1.5,-67,34.3,-68.5,47.1,-57.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>

                <div class="shape shape-2">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M41.3,-49.1C54.4,-39.3,66.6,-27.2,71.1,-12.1C75.6,3,72.4,20.9,63.3,34.4C54.2,47.9,39.2,56.9,23.2,62.3C7.1,67.7,-10,69.4,-24.8,64.1C-39.7,58.8,-52.3,46.5,-60.1,31.5C-67.9,16.4,-70.9,-1.4,-66.3,-16.6C-61.8,-31.8,-49.7,-44.3,-36.3,-54C-22.9,-63.7,-8.2,-70.6,3.6,-75.1C15.4,-79.6,28.2,-58.9,41.3,-49.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>

                <div class="dots dots-1">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <pattern id="dot-pattern" x="0" y="0" width="20" height="20"
                            patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        </pattern>
                        <rect width="100" height="100" fill="url(#dot-pattern)"></rect>
                    </svg>
                </div>

                <div class="dots dots-2">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <pattern id="dot-pattern-2" x="0" y="0" width="20" height="20"
                            patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        </pattern>
                        <rect width="100" height="100" fill="url(#dot-pattern-2)"></rect>
                    </svg>
                </div>

                <div class="shape shape-3">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M43.3,-57.1C57.4,-46.5,71.1,-32.6,75.3,-16.2C79.5,0.2,74.2,19.1,65.1,35.3C56,51.5,43.1,65,27.4,71.7C11.7,78.4,-6.8,78.3,-23.9,72.4C-41,66.5,-56.7,54.8,-65.4,39.2C-74.1,23.6,-75.8,4,-71.7,-13.2C-67.6,-30.4,-57.7,-45.2,-44.3,-56.1C-30.9,-67,-15.5,-74,0.7,-74.9C16.8,-75.8,33.7,-70.7,43.3,-57.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section><!-- /Call To Action Section -->
@endsection
