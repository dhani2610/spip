<!DOCTYPE html>
<html lang="en">

<head>
  {{-- head  --}}
  @include('frontend.layouts.partials.head')
</head>

<body class="index-page">

  {{-- navbar --}}
  @include('frontend.layouts.partials.navbar')

  <main class="main">
    @yield('content-frontend')
  </main>

  {{-- footer     --}}
  @include('frontend.layouts.partials.footer')
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  {{-- foot --}}
  @include('frontend.layouts.partials.foot')
</body>

</html>