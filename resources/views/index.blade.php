<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">



    <title>Admin Warga Digital</title>
  </head>
  <body  class="bg-dark text-white" >


 <div class="container d-flex  justify-content-center">
  <div class="card mt-5 " style="width: 25rem;">
    <div class="align-items-center text-center">
      <img src="/assets/logo_simdes_web.svg" class="rounded mt-3" alt=" "width="150">

    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-2">
          <label for="exampleFormControlInput1" class="form-label"></label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"  required autocomplete="email" autofocus >
          @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>


        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label"></label>
          <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror


        </div>
        <div class=" ms-auto">

          @if (Route::has('password.request'))
          <a class="btn text-danger text-left" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
          </a >
         @endif
        </div>

        <div class="mb-2 offset-md-10 ">

          <button type="submit" class="btn btn-primary ">
            {{ __('Login') }}
         </button>
        </div>

    </form>
    </div>
  </div>
 </div>



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
