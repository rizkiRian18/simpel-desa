
@extends('layouts.main')


@section('title', 'Data KADES')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 class ="mt-5">Daftar KADES</h1>
                @if (session('status'))
                         <div class="alert alert-success">
                              {{ session('status') }}
                         </div>
                @endif
                @if (session('error'))
                         <div class="alert alert-danger">
                              {{ session('error') }}
                         </div>
                @endif
<button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Kades
  </button>

                </div>
                <hr class="mt-3 ">
            <table class="table  table-hover mt-5">
                    <thead class="table-dark">
                        <tr>
                            <th> # </th>
                            <th>NAMA</th>
                            <th> NIK </th>
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $kades as $items)
                        <tr>
                            <th>{{$loop->iteration + $kades->firstItem() - 1 }} </th>
                            <td> {{$items->nama}} </td>
                            <td> {{$items->nik}}</td>
                            <td>
                                {{-- <a href="/rw/{{$rwe->id}}" class="btn btn-primary me-md-2">edit</a> --}}

                            </td>
                        </tr>
                       @endforeach
                    </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{  $kades->links('pagination::bootstrap-4')  }}
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah KADES</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/kades/tambah" method="POST">
                @csrf
                <input class="form-control mb-3" type="text" placeholder="Nama Kepala Desa" aria-label=".form-control-lg example" name="nama">
                <input class="form-control mb-3" type="text" maxlength="16" placeholder="NIK" aria-label="default input example" name="nik">
                <input class="form-control mb-3" type="text" maxlength="16" placeholder="E-Mail" aria-label="default input example" name="email">
                <input class="form-control mb-3" type="password" placeholder="Password" aria-label=".form-control-sm example" name="password">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>

@endsection
