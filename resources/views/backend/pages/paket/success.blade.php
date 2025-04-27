@extends('backend.layouts-new.app')

@section('content')
<div class="mt-3" style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 2rem; background-color: #F5EBDD;">

    <h1 style="font-size: 2rem; font-weight: bold; color: #6B5252;">
        ✨ Terima kasih, Bunda!
    </h1>
    
    <p style="font-size: 1.1rem; color: #555;">
        Kamu sudah ambil langkah besar untuk pulih dan bangkit ✨
    </p>

    <p style=" font-size: 1rem; color: #555;">
        Kami sudah menerima pendaftaranmu. Selanjutnya:
    </p>

    <ul style="text-align: left; list-style: none; padding: 0; color: #555;">
        <li style="margin-bottom: 0.5rem;">✅ Cek WhatsApp kamu untuk info lengkap program</li>
        <li style="margin-bottom: 0.5rem;">✅ Simpan nomor admin agar tidak ketinggalan info penting</li>
        <li style="margin-bottom: 0.5rem;">✅ Gabung ke Grup WhatsApp Support (link dikirim lewat WA)</li>
        <li style="margin-bottom: 0.5rem;">✅ Siapkan ruang nyaman untuk sesi live terapi pertamamu</li>
    </ul>

    <blockquote style="font-style: italic; color: #7a7a7a; max-width: 500px;">
        "Kami tahu ini bukan perjalanan yang mudah. Tapi kamu tidak sendiri.<br>
        Kamu sekarang bagian dari keluarga besar Teman Move On."
    </blockquote>

    <div style="display: flex; gap: 1rem;">
        <a href="{{ url('/') }}" style="background-color: #6B5252; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none;">
            Kembali ke Beranda
        </a>
        <a href="https://wa.me/6287723142730" target="_blank" style="background-color: #6B5252; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none;">
            Cek WhatsApp Sekarang
        </a>
    </div>
</div>
@endsection

@section('script')
    
@endsection
