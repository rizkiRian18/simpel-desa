
@extends('layouts.sidebar')


@section('title', 'Data Warga')

@section('content')
    <div class="heads d-flex flex-row">
        <h5 class="font-weight-bold">Daftar Warga</h5>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <hr>


    <div class="table-data">
        <table class="table tal" id="table-warga">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nama</th>
                <th scope="col" class="">NIK</th>
                <th scope="col" class="">No.KK</th>
                <th scope="col">Alamat</th>
                <th scope="col" class="">RT</th>
                <th scope="col" class="">RW</th>
                <th scope="col" class="">Agama</th>
                <th scope="col" class="">Jenis Kelamin</th>
                <th scope="col" class="">Tempat Lahir</th>
                <th scope="col" class="">Tanggal Lahir</th>
                <th scope="col" class="">Kewarganegaraan</th>
                <th scope="col" class="">Pekerjaan</th>
                <th scope="col" class="">Lampiran KK</th>
                <th scope="col" class="">Lampiran KTP</th>


            </tr>
            </thead>
        </table>
    </div>

@endsection


@section('js')
    <script>

        const table = $('#table-warga').DataTable( {


            autoWidth:false,
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"/warga/",
            },
            columns: [

                {data: 'nama'},
                {data: 'nik'},
                {data: 'nomor_kk'},
                {data: 'alamat'},
                {data: 'rt'},
                {data: 'rw'},
                {data: 'agama'},
                {data: 'jenis_kelamin'},
                {data: 'tempat_lahir'},
                {data: 'tanggal_lahir'},
                {data: 'kewarganegaraan'},
                {data: 'pekerjaan'},
                {data: 'lampiran_kk'},
                {data: 'lampiran_ktp'},


            ],
            search:{
                "regex" :true,
                },
                fixedColumns: true

         });
    </script>
@endsection
