<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">
    @yield('css')

    <title>@yield('title')</title>


    <style>

        body{
            overflow: hidden;
        }
        .side-bar{
            height: 100vh;
            min-width: 0px;
        }
        .side-background{
            border-radius: 0px 50px 0px 0px;
        }


        .logo{
            width: 100px;
            height: 100px;
        }

        .content{
            overflow: hidden;
            }

        .link{
            margin-top: 3rem;
            margin-left: 1rem;
        }

        .links-item{
            margin-bottom: 40px;
            align-items: center;
        }

        .links-item a{
            color: white;
        }

        .col{
            max-width: 250px;
        }




        /* TOGGLE */

        .menu-toggle{
            display: none;
            flex-direction: column;
            height: 20px;
            justify-content: space-between;
            position: relative;
        }

        .menu-toggle input{
            position: absolute;
            width: 44px;
            height: 32px;
            left: -7px;
            top: -1px;
            opacity: 0;
            z-index: 2;
        }

        .menu-toggle span{
            display: block;
            width: 28px;
            height: 3px;
            background-color: #ff3333;
            border-radius: 3px;
            transition: all 0.5s;


        }


        .menu-toggle span:nth-child(2){
            transform-origin: 0 0;
        }

        .menu-toggle span:nth-child(4){
            transform-origin: 0 100%;
        }

        .menu-toggle input:checked ~  span:nth-child(2){
            transform: rotate(45deg) translate(-1px, -1px);
        }

        .menu-toggle input:checked ~  span:nth-child(4){
            transform: rotate(-45deg) translate(-1px, 0);
        }


        .menu-toggle input:checked ~  span:nth-child(3){
            transform: scale(0);
        }


        @media (max-width: 768px) {

        .menu-toggle{
            display: flex;
        }

            .col{
                max-width: 100%;

            }

            .side-bar{
            height: 0vh;
            overflow: hidden;
            transition: all 1s;
        }

        .side-background{
            border-radius: 50px 50px 0px 0px;
        }


        .link{
            margin-top: 1.5rem;
            margin-left: 5rem;
        }
        .side-logo img{
               margin: auto;
        }

        .content{
                height: 40vh;
                overflow: auto;
                width: 100%;

            }


        .side-bar.slide{
            height: 50vh;
        }
         }



    </style>





</head>
<body >
    <div class="row top-nav d-flex justify-content-between mt-4 px-5 mb-3 align-items-center">
        <div class="side-logo">
            <img src="{{ asset('assets/logo_simdes_web.svg') }}" class="logo " alt="">
        </div>

        <div class="menu-toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-2">
            <div class="row side-bar">
                <div class="col bg-dark side-background d-flex justify-content-center">
                    <div class="content mt-5">

                        <div class="d-flex flex-column text-white  link">

                            <div class="d-flex flex-row links-item">
                                  <a href="/warga/" class="ml-3 mt-1 text-decoration-none">Data Warga</a>
                            </div>
                            <div class="d-flex flex-row links-item">
                                  <a href="/rt/" class="ml-3 mt-1 text-decoration-none">Data RT</a>
                            </div>
                            <div class="d-flex flex-row links-item">
                                  <a href="/rw/" class="ml-3 mt-1 text-decoration-none">Data RW</a>
                            </div>
                            <div class="d-flex flex-row links-item">
                                  <a href="/kades/" class="ml-3 mt-1 text-decoration-none">Data Kades</a>
                            </div>


                            <div class="d-flex flex-row links-item">
                                  <a href="/surat/" class="ml-3 mt-1 text-decoration-none">Data Surat</a>
                            </div>




                            <div class="d-flex flex-row links-item mt-5">
                                <img src="{{ asset('assets/icons/log-out.svg') }}" alt="">
                                  <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();" class="ml-3 mt-1 text-decoration-none">Log out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


    <div class="col-xl-9 col-lg-9 col-md-9">
            <section class="">
                @yield('content')
            </section>
    </div>
    <!-- Scripts -->
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    @yield('js')
</body>
</html>
