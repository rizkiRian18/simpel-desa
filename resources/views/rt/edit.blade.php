
@extends('layouts.main')


@section('title', 'Ubah Data Ketua RT')

@section('container')
    <div class="container">
        <h2 class="mt-3">Ubah Data Ketua RT</h2>
            <hr>
        <div class="row">
            <div class="col-6 mt-3">
                <form method="post" action="/rt/{{$rt->id}}">

                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="" class="form-control mt-2" id="nama" name="nama" value="{{ $rt -> nama }}" placeholder="Masukan Nama Baru">
                        <label for="nik" class="form-label mt-1">NIK</label>
                        <input type="" class="form-control mt-1" id="password" name="nik" value="{{ $rt -> nik }}" placeholder="Masukkan NIK Baru">
                      <label for="password" class="form-label mt-2">Password</label>
                      <input type="password" class="form-control mt-1" id="password" name="password" value="" placeholder="Masukkan Password Baru">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection
