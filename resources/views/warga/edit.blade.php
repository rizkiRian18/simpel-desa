@extends('layouts.main')


@section('title', 'Ubah Data Warga')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-6 mt-3">
                <form method="post" action="/warga/{{$warga->id}}">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" value="" placeholder="Masukkan Password Baru">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection
