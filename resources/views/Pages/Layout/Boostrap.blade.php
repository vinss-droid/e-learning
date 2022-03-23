<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tels-Learning | @yield('title')</title>
  {{-- Logo --}}
  <link rel="shortcut icon" href="{{ asset('img/telkom.ico') }}" type="image/x-icon">

  {{-- My CSS --}}
  <link rel="stylesheet" href="{{ asset('css/Main.css') }}">

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  {{-- Font Inter | Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400&display=swap" rel="stylesheet">

  {{-- Animate.CSS --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  {{-- AOS --}}
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  
  {{-- Owl-Carousel --}}
  {{-- <link rel="stylesheet" href="{{ asset('asset/owl-carousel/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/owl-carousel/dist/assets/owl.theme.default.min.css') }}"> --}}

  {{-- Slick --}}
  <link rel="stylesheet" href="{{ asset('asset/slick/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/slick/slick/slick-theme.css') }}">

  <!-- Custom styles for this page -->
  <link href="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  

</head>
<body>
  
  @include('Pages.Layout.Navbar')

  <div class="container-fluid">
      <section class="content">
        @yield('content')
      </section>
  </div>

  @include('Pages.Layout.Footer')

{{-- MY JS --}}
{{-- <script>
  const element = document.querySelector('.about-aos-deskripsi');
  element.classList.remove('animate__animated', 'animate__bounceOutLeft');
</script> --}}

{{-- My Js --}}
<script>
    const headerNavbar = () => {
    var header = document.getElementById("mynavbar");
    var sticky = header.offsetTop;

    if (window.pageYOffset > sticky) {
      header.classList.add("navbar-dark");
      header.classList.add("bg-primary")
    } else {
      header.classList.remove("navbar-dark");
      header.classList.remove("bg-primary");
    }
  };

  window.addEventListener("scroll", headerNavbar);

</script>

{{-- JQUERY --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- Slick --}}
<script src="{{ asset('asset/slick/slick/slick.min.js') }}"></script>

{{-- Owl-JS --}}
{{-- <script src="{{ asset('') }}"></script>
<script src="{{ asset('asset/owl-carousel/dist/owl.carousel.min.js') }}"></script> --}}

{{-- Fonts Awesome --}}
<script src="https://kit.fontawesome.com/768e0ea7cb.js" crossorigin="anonymous"></script>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<script src="{{ asset('dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('dashboard/js/demo/datatables-demo.js') }}"></script>

{{-- Slick-Js --}}
<script>
  $(document).ready(function(){
      $('.mapel-item').slick({
        dots: true,
        infinite: false,
        speed: 200,
        slidesToShow: 2,
        slidesToScroll: 2
      });
    });
</script>


{{-- AOS JS --}}
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({
    disable: 'mobile'
  });
</script>

@yield('js')

</body>
</html>