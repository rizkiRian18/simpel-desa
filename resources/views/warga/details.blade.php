
@extends('layouts.main')


@section('title', 'Data Warga')

@section('container')

<div class="container">

    <div class="row">
        <div class="col-4">
            <h2 class ="mt-5">Detail Warga</h1>
            <hr>
            <div class="card mt-5" >
              <div class="card-body">
                <h5 class="card-title">{{$warga->nama}} </h5>
                <h6 class="card-subtitle mb-3 mt-3 text-muted">{{$warga->nik}}</h6>
                <a href="{{$warga->id}}/edit" class="btn btn-danger">Edit </a>

              </div>
            </div>

        </div>
    </div>
</div>
@endsection
