@extends('frontend.layouts.app')

@section('content-frontend')
    <!-- Pricing Section -->
    <section id="pricing" class="pricing section light-background">
        <div class="container section-title" data-aos="fade-up" style="margin-top: 5%">
            <h2>Checkout</h2>
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
                                            window.location.href = "{{ route('payment-success') }}";
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
