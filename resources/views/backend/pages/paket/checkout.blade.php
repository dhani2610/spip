@extends('backend.layouts-new.app')

@section('content')
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
    <!-- Pricing Section -->
    <section id="pricing" class="pricing section light-background">
        <div class="container section-title" data-aos="fade-up" style="margin-top: 5%">
            <center>
                <h2>Checkout</h2>
            </center>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-card popular">
                        <div class="popular-badge">Most Popular</div>
                        <h3>{{ $data->nama }}</h3>
                        <div class="price">
                            <span class="currency">Rp</span>
                            <span class="amount">{{ number_format($data->harga, 0, ',', '.') }}</span>
                            <span class="period">/ {{ $data->type }}</span>
                        </div>
                        <h4>Durasi Langganan:</h4>
                        <select class="form-control durasi-select" data-id="{{ $data->id }}" id="durasi" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }} {{ $data->type }}</option>
                            @endfor
                        </select>

                        <div class="mt-3">
                            <label>Tanggal Aktif</label>
                            <div class="d-flex gap-2">
                                <input type="date" id="start_date" class="form-control" readonly
                                    value="{{ date('Y-m-d') }}" required>
                                <input type="date" id="end_date" class="form-control" readonly required>
                            </div>
                        </div>

                        <p class="mt-3 total-harga" id="total-{{ $data->id }}" data-harga="{{ $data->harga }}">
                            Total: Rp {{ number_format($data->harga, 0, ',', '.') }}
                        </p>

                        <h3>Detail Informasi</h3>

                        <form id="checkout-form">
                            <input type="hidden" name="paket_id" value="{{ $data->id }}">
                            <input type="hidden" name="total_harga" id="input-total-harga" value="{{ $data->harga }}">

                            <div class="form-group mt-2">
                                <label>Nama</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : '' }}" required>
                            </div>
                            
                            <div class="form-group mt-2">
                                <label>Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->email : '' }}" required>
                            </div>
                            
                            <div class="form-group mt-2">
                                <label>No. Whatsapp</label>
                                <input type="number" id="whatsapp" name="no_wa" class="form-control"
                                    value="{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->no_wa : '' }}" required>
                                <div id="whatsappError" class="text-danger mt-1" style="display: none;">No WhatsApp harus diawali dengan "62"</div>
                            </div>
                            
                            <button type="button" class="btn btn-primary mt-3 pay-button" data-id="{{ $data->id }}">
                                Continue to Pay <i class="bi bi-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadDuration();
            // Update total harga ketika user memilih durasi
            document.querySelectorAll(".durasi-select").forEach(select => {
                select.addEventListener("change", function() {
                    let paketId = this.dataset.id;
                    let hargaPerUnit = document.getElementById(`total-${paketId}`).dataset.harga;
                    let durasi = parseInt(this.value);
                    let totalHarga = hargaPerUnit * durasi;

                    document.getElementById(`total-${paketId}`).innerHTML =
                        `Total: Rp ${new Intl.NumberFormat('id-ID').format(totalHarga)}`;

                    // 👉 Hitung tanggal akhir berdasarkan durasi
                    const startDateInput = document.getElementById('start_date');
                    const endDateInput = document.getElementById('end_date');

                    const startDate = new Date();
                    const type =
                    "{{ $data->type }}"; // Ambil dari blade, misalnya 'bulan' atau 'minggu'

                    let endDate = new Date(startDate);

                    console.log(type);


                    if (type === "month") {
                        endDate.setMonth(endDate.getMonth() + durasi);
                    } else if (type === "week") {
                        endDate.setDate(endDate.getDate() + (durasi * 7));
                    } else {
                        endDate.setDate(endDate.getDate() +
                        durasi); // fallback jika type tidak dikenali
                    }

                    // Format tanggal ke YYYY-MM-DD
                    const formattedEndDate = endDate.toISOString().split('T')[0];
                    endDateInput.value = formattedEndDate;
                });
            });

            function loadDuration() {
                const startDateInput = document.getElementById('start_date');
                const endDateInput = document.getElementById('end_date');
                let durasi = $('.durasi-select').val();
                const startDate = new Date();
                const type = "{{ $data->type }}"; // Ambil dari blade, misalnya 'bulan' atau 'minggu'

                let endDate = new Date(startDate);

                if (type === "month") {
                    endDate.setMonth(endDate.getMonth() + durasi);
                } else if (type === "week") {
                    endDate.setDate(endDate.getDate() + (durasi * 7));
                } else {
                    endDate.setDate(endDate.getDate() + durasi); // fallback jika type tidak dikenali
                }

                // Format tanggal ke YYYY-MM-DD
                const formattedEndDate = endDate.toISOString().split('T')[0];
                endDateInput.value = formattedEndDate;
            }


            document.querySelectorAll(".pay-button").forEach(button => {
                button.addEventListener("click", function() {
                    let paketId = this.dataset.id;
                    let durasi = document.querySelector(`.durasi-select[data-id="${paketId}"]`)
                        .value;

                    // 2️⃣ Cek apakah user sudah memiliki paket aktif
                    fetch("/check-paket")
                        .then(response => response.json())
                        .then(paket => {
                            if (paket.is_subs === "Ya") {
                                Swal.fire({
                                    title: "Paket Aktif Ditemukan!",
                                    text: "Anda sudah memiliki paket aktif. Jika melanjutkan, paket sebelumnya akan digantikan dengan yang baru.",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: "Ya, Ganti Paket",
                                    cancelButtonText: "Tidak, Batalkan"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        lanjutkanPembayaran(paketId,
                                        durasi);
                                    }
                                });
                            } else {
                                // Jika tidak ada paket aktif, langsung lanjutkan pembayaran
                                lanjutkanPembayaran(paketId, durasi);
                            }
                        })
                        .catch(error => console.error("Error:", error));
                       
                });
            });

            // ✅ Fungsi untuk memproses pembayaran dengan Midtrans
            function lanjutkanPembayaran(paketId, durasi) {
                let nameUser = $('#name').val();
                let emailUser = $('#email').val();
                let waUser = $('#whatsapp').val();
                var is_login = '{{ Auth::guard('admin')->check() != null ? 'Ya' : 'Tidak' }}';
                fetch(`/generate-snap-token/${paketId}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            durasi: durasi
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        window.snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Pembayaran Berhasil!",
                                    text: "Terima kasih atas pembayaran Anda.",
                                    confirmButtonText: "OK"
                                });

                                fetch("{{ route('store-transaction') }}", {
                                        method: "POST",
                                        headers: {
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                            "Content-Type": "application/json"
                                        },
                                        body: JSON.stringify({
                                            is_login: is_login,
                                            nameUser: nameUser,
                                            emailUser: emailUser,
                                            waUser: waUser,
                                            order_id_midtrans: result.order_id,
                                            paket_id: paketId,
                                            durasi: durasi,
                                            dari_tanggal: data.dari_tanggal,
                                            sampai_tanggal: data.sampai_tanggal,
                                            total_harga: data.total_harga,
                                            nama: data.paket.nama,
                                            type: data.paket.type,
                                            harga: data.paket.harga,
                                            benefit: data.paket.benefit,
                                            group: data.paket.group,
                                            include_asset: data.paket.include_asset,
                                            asset: data.paket.asset
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Transaksi Berhasil!",
                                            text: data.message,
                                            confirmButtonText: "OK"
                                        }).then(() => {
                                            window.location.href = "{{ route('paket.payment-success') }}";
                                        });
                                    })
                                    .catch(error => console.error("Error:", error));
                            },
                            onPending: function(result) {
                                Swal.fire({
                                    icon: "info",
                                    title: "Menunggu Pembayaran!",
                                    text: "Silakan selesaikan pembayaran Anda.",
                                    confirmButtonText: "OK"
                                });
                            },
                            onError: function(result) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Pembayaran Gagal!",
                                    text: "Terjadi kesalahan dalam proses pembayaran.",
                                    confirmButtonText: "OK"
                                });
                            },
                            onClose: function() {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Pembayaran Ditutup!",
                                    text: "Anda menutup popup tanpa menyelesaikan transaksi.",
                                    confirmButtonText: "OK"
                                });
                            }
                        });
                    })
                    .catch(error => console.error("Error:", error));
            }


        });


        document.getElementById("whatsapp").addEventListener("input", function() {
            let whatsappInput = document.getElementById("whatsapp");
            let whatsappError = document.getElementById("whatsappError");
            
            // Hanya ambil angka
            let number = whatsappInput.value.replace(/\D/g, ''); 
            
            // Pastikan selalu diawali dengan "62"
            if (!number.startsWith("62")) {
                number = "62" + number.replace(/^62/, '');
            }

            // Update input value
            whatsappInput.value = number;

            // Validasi panjang minimal (misal minimal 10 digit termasuk "62")
            if (number.length < 10) {
                whatsappError.style.display = "block";
                whatsappInput.classList.add("is-invalid");
            } else {
                whatsappError.style.display = "none";
                whatsappInput.classList.remove("is-invalid");
            }
        });
    </script>
@endsection

@section('script')
    
@endsection
