@extends('layouts.main')


@section('title', 'Detail Ketua RW')

@section('container')
<div class="container">

    <div class="row">
        <div class="col-6">
            <h2 class ="mt-5">Detail Ketua RW</h1>
            <hr>
            <div class="card mt-5" >
              <div class="card-body ">
                <h5 class="card-title">{{$rw->nama}} </h5>
                <h6 class="card-subtitle mb-3 mt-3 text-muted">{{$rw->nik}}</h6>
                <a href="{{$rw->id}}/edit" class="btn btn-danger">Edit </a>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
