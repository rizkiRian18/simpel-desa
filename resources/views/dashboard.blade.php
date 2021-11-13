

@extends('layouts.sidebar')


@section('title', 'Dashboard')

@section('content')
<div class="container mb-5 mt-5 cc">
  <div class="row ">

    <div class="col-md-4 ">

      <div class="card mt-3 x bg-dark">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <h6 class="card-subtitle mb-2 text-white">Data Warga</h6>
          <p class="card-text"></p>
          <a href="/warga/" class="btn btn-secondary "role="button">Detail</a>
        </div>
      </div>
    </div>
    <div class="col-md-4  ">
      <div class="card mt-3 x bg-dark">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <h6 class="card-subtitle mb-2 text-white">Data Ketua RT</h6>
          <p class="card-text"></p>
          <a href="/rt/" class="btn btn-secondary "role="button">Detail</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 ">
      <div class="card mt-3 x bg-dark">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <h6 class="card-subtitle mb-2 text-white">Data Ketua RW</h6>
          <p class="card-text"></p>
          <a href="/rw/" class="btn btn-secondary "role="button">Detail</a>
        </div>
      </div>
    </div>
      </div>
    </div>

  </div>
</div>


@endsection

