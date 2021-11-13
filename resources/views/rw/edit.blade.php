
@extends('layouts.main')


@section('title', 'Ubah Data Ketua RW')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-6 mt-2">
                <form method="post" action="/rw/{{$rw->id}}">

                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="" class="form-control mt-2" id="nama" name="nama" value="{{ $rw -> nama }}" placeholder="Masukan Nama Baru" >
                        <label for="nik" class="form-label mt-1">NIK</label>
                        <input type="" class="form-control mt-1" id="password" name="nik" value="{{ $rw -> nik }}" placeholder="Masukkan NIK Baru" maxlength="16">
                      <label for="password" class="form-label mt-2">Password</label>
                      <input type="password" class="form-control mt-1" id="password" name="password" value="" placeholder="Masukkan Password Baru">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection
