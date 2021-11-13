
@extends('layouts.main')


@section('title', 'Data Ketua RT')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 class ="mt-5">Daftar Ketua RT</h1>
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
            <!-- Button trigger modal -->
<button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Ketua RT
  </button>


                {{-- <a href="/tambah" class="btn btn-success me-md-2"> Tambah Ketua RT</a> --}}

            {{-- <form class="d-flex mt-3" method="GET" action="/rt/">
                <input name="search" class="form-control me-2 w-50" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-secondary " type="submit">Search</button>
            </form> --}}
                </div>
                <hr class="mt-3 ">
            <table class="table  table-hover mt-5">

                    <thead class="table-dark">
                        <tr>
                            <th> # </th>
                            <th>NAMA</th>
                            <th> NIK </th>
                            <th> RT </th>
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $rt as $rte )
                        <tr>
                            <th>{{$loop->iteration + $rt->firstItem() - 1 }}</th>
                            <td> {{$rte->nama}} </td>
                            <td> {{$rte->nik}}</td>
                            <td> {{$rte->rt}} </td>


                            <td>
                                <a href="/rt/{{$rte->id}}" class="btn btn-primary me-md-2">edit</a>

                            </td>
                        </tr>
                       @endforeach
                    </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{  $rt->links('pagination::bootstrap-4')  }}
            </div>

            {{-- <ul class="list-grou mt-3">
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
 <!-- Tambah RT -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Ketua RT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/rt/tambah" method="POST">
                @csrf
                <input class="form-control mb-3" type="text" placeholder="Nama Ketua RT" aria-label=".form-control-lg example" name="nama">
                <input class="form-control mb-3" type="text" maxlength="16" placeholder="NIK" aria-label="default input example" name="nik">

                <input class="form-control mb-3" type="text" placeholder="RT" aria-label=".form-control-sm example" name="rt">
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
