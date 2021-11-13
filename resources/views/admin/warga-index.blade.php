
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

{{--
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
    </div> --}}




    <div class="table-data">
        <table class="table tal" id="table-warga">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nama</th>
                <th scope="col" class="">NIK</th>
                <th scope="col" class="">No.KK</th>
                <th scope="col" class="">RT</th>
                <th scope="col" class="">RW</th>
                <th scope="col">Alamat</th>
                <th scope="col" class="">Agama</th>
                <th scope="col" class="">Jenis Kelamin</th>
                <th scope="col" class="">Tempat Lahir</th>
                <th scope="col" class="">Tanggal Lahir</th>
                <th scope="col" class="">Kewarganegaraan</th>
                <th scope="col" class="">Pekerjaan</th>
                <th scope="col" class="">Lampiran KK</th>
                <th scope="col" class="">Lampiran KTP / Identitas Lainnya</th>
            </tr>
            </thead>
        </table>
    </div>



    {{-- LAMPIRAN KK--}}

    <div class="modal fade" id="showLampiranKK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="modal-body">
                    <img src="" alt="" id="imgLampiranKK" class="img-fluid">
            </div>
        </div>
        </div>
    </div>

{{-- LAMPIRAN KTP--}}

    <div class="modal fade" id="showLampiranKTP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="modal-body">
                    <img src="" alt="" id="imgLampiranKTP" class="img-fluid">
            </div>
        </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
 var SITEURL = '{{ URL::to('') }}';
        let data = [];
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
                {data: 'lampiran_kk',
                render: function(data, type, row){
                        let showLampiranKK = `<button class = "btn-primary text-white showLampiranKK rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiranKK;
                    }
                },
                {data: 'lampiran_ktp',
                render: function(data, type, row){
                        let showLampiranKTP = `<button class = "btn-primary text-white showLampiranKTP rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiranKTP;
                    }
                },


            ],
            search:{
                "regex" :true,
                },
                fixedColumns: true

         });


         $('#table-warga tbody').on('click', 'button.showLampiranKK', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiranKK').modal('show');
        $('#imgLampiranKK').attr('src', SITEURL+'/img/lampiran_kk/' + myrow.lampiran_kk);


    });


       $('#table-warga tbody').on('click', 'button.showLampiranKTP', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiranKTP').modal('show');
        $('#imgLampiranKTP').attr('src', SITEURL+'/img/lampiran_ktp/' + myrow.lampiran_ktp);


    });
    </script>
@endsection
