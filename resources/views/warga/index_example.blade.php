

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <title>Hello, world!</title>
  </head>
  <body >

    {{-- <img src="{{asset('assets/logo_gambar.svg')}}" alt="" class="rounded mx-auto d-block mt-10 ">

    <div class="container-fluid ">
      <div class="row min-vh-10 flex-column flex-md-row bk">
        <aside class="col-2 col-md-2 col-sm-2 p-0 bg-dark flex-shrink mw-10 rounded-end">
          <nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row align-item-center py-2 text-center sticky-top " id="sidebar" >
              <div class="text-center py-3  ic">
                <img src="{{asset('assets/mail.svg')}}" alt="" class="icon" width="40.5px" height="33.5px" color="white">
              </div>

              <div class="text-center py-3 ic">
                <img src="{{asset('assets/person.svg')}}" alt="" class="icon"width="40.5px" height="33.5px" >
              </div>
          </nav>
        </aside>

        <main class="col px-0 flex-grow-1">
          <div class="container">
            <div class="row ">
              <div class="col-md-auto mt-5">
                <div class=" card card1" style="width: 18rem;">
                  <div class="card-body">
                    <p class="card-text">RW</p>
                  </div>
                </div>
              </div>
              <div class="col-md-auto mt-5">
                <div class=" card card2" style="width: 18rem; height:144px; text-align:center;">
                  <div class="card-body" style="text-size:20px; text-align:center;">
                    <p class="card-text" >RT</p>
                  </div>
                </div>
              </div>
              <div class="col-md-auto mt-5 ">
                <div class=" card card3" style="width: 18rem;">
                  <div class="card-body">
                    <p class="card-text ">WARGA</p>
                  </div>
                </div>
              </div>
            </div>
            
           
            

          </div>
        </main>

      </div>
    </div> --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class ="head">Daftar Warga</h1>
          <hr class="line">
        </div> 


      
            <div class="container">
              <div class="row height d-flex justify-content-center align-items-center">
                  <div class="col-md-6">
                      <div class="search"> <i class="fa fa-search"></i> <input type="text" class="form-control" placeholder="Have a question? Ask Now"> <button class="btn btn-primary">Search</button> </div>
                  </div>
              </div>
          </div>
                </div> 
      <div class="container">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped">
              
                  <thead> 
                      <tr>
                          <th> # </th>
                          <th>NAMA</th>
                          <th> NIK </th>
                          <th> RT </th>
                          
                          <th> Aksi </th>
                      </tr>
                  </thead> 
                  <tbody>
                      @foreach( $warga as $wr)
                      <tr>
                          <th> {{$loop->iteration}}</th>
                          <td> {{$wr->nama}} </td>
                          <td> {{$wr->nik}}</td>
                          <td> {{$wr->rt}} </td>
                      
  
                          <td>
                              <a href="" class="btn btn-primary btn-sm">edit</a>
                              
                          </td>
                      </tr>
                     @endforeach
                  </tbody>
               </table>
              </div>
            </div>
          </div>
        


            {{-- <ul class="list-group">
            @foreach ($warga as $wr)
              <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ $wr ->nama}}

                <a href="/warga/{{$wr->id}}" class="btn btn-primary btn-sm"> Detail</a>
              </li>
             @endforeach
            </ul> --}}
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