
@extends('layouts.sidebar')


@section('title', 'Data Warga')

@section('content')
    <div class="heads d-flex flex-row">
        <h5 class="font-weight-bold">Daftar Ketua RT</h5>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <hr>


    <div class="table-data">
        <table class="table tal" id="table-rt">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nama</th>
                <th scope="col" class="">NIK</th>
                <th scope="col" class="">RT</th>
                <th scope="col" class="">RW</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection


@section('js')
    <script>

        const table = $('#table-rt').DataTable( {


            autoWidth:false,
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"/rt/",
            },
            columns: [

                {data: 'nama'},
                {data: 'nik'},
                {data: 'rt'},
                {data: 'rw'},



            ],
            search:{
                "regex" :true,
                },
                fixedColumns: true

         });
    </script>
@endsection
