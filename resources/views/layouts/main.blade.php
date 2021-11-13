<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ asset('assets/logo_gambar.svg') }}">
    <title>@yield('title')</title>

    <style>

      html,body{


      }
      .cc{
        margin-top: 300px !important;
      }

      .x{
        color: var(--bs-blue);
      }

       .x:hover {
        box-shadow: 0 40px 60px -20px rgba(12, 5, 62, 0.15);
        background-color: #fff;
        z-index: 100;
      }
    .x:hover .card-subtitle{
     color: #4e22d0;
     }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark p-6 ">
      <div class="container">

        <a class="navbar-brand" href="/">
          <h6 class="text-white"> Admin Simpel Desa</h1>
         </a>
        @auth


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto text-center">
            {{-- <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href=""> {{ Auth::user()->name }}</a>
            </li> --}}
            <li class="nav-item">
              <span class="nav-link active text-white" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
            </span>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
            </li>

        @endauth
      </nav>

      @yield('container');
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
