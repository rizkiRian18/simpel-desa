@extends('layouts.sidebar')

@section('css')
@endsection

@section('title', 'Data Surat Pengantar')

@section('content')
    <div class="heads d-flex flex-row">
        <h5 class="font-weight-bold">Daftar Surat</h5>
        <button class="btn-btn ml-4" data-toggle="modal" data-target="#tambahKades">
            <img src="{{ asset('assets/icons/tambah-ic.svg') }}" alt="" class="edit-ic" >
        </button>
    </div>

    <hr>

    @if (session('true'))
    <div class="alert alert-success">
        {{ session('true') }}
    </div>
@endif

@if(session('false'))
<div class="alert alert-danger">
    {{ session('false') }}
</div>
@endif


@if($errors->any())
    @foreach ($errors->all() as $error )
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif


<div class="table-data">
    <table class="table tal" id="table-surat">
        <thead class="thead-dark">
        <tr>
            <th scope="col"class="text-center">No.Reg (RT)</th>
            <th scope="col"class="text-center">No.Reg (RW)</th>
            <th scope="col"class="text-center">Nama Pemohon</th>
            <th scope="col" class="text-center">NIK</th>
            <th scope="col" class="text-center">Nomor KK</th>
            <th scope="col" class="text-center">RT</th>
            <th scope="col" class="text-center">RW</th>
            <th scope="col" class="text-center">Kp.</th>
            <th scope="col" class="text-center">Tempat Lahir</th>
            <th scope="col" class="text-center">Tanggal Lahir</th>
            <th scope="col" class="text-center">Jenis Kelamin</th>
            <th scope="col" class="text-center">Kewarganegaraan</th>
            <th scope="col" class="text-center">Agama</th>
            <th scope="col" class="text-center">Maksut / Tujuan</th>
            <th scope="col" class="text-center">Status Surat</th>
            <th scope="col" class="text-center">Lampiran 1</th>
            <th scope="col" class="text-center">Lampiran 2</th>
            <th scope="col" class="text-center">Lampiran 3</th>
            <th scope="col" class="text-center">Lampiran 4</th>
            <th scope="col" class="text-center">Lampiran 5</th>
            <th scope="col" class="text-center">Lampiran 6</th>
            <th scope="col" class="text-center">Lampiran 7</th>
            <th scope="col" class="text-center">Surat Kades</th>
            <th scope="col" class="text-center">Aksi</th>
        </tr>
        </thead>
    </table>
</div>



        <!-- Modal Lihat -->
        <div class="modal fade" id="tambahKades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kades</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="/kades/tambah" method="POST">
                            @csrf
                            <input class="form-control mb-3" type="text" placeholder="Nama Kades" aria-label=".form-control-lg example" name="nama">
                            <input class="form-control mb-3" type="text" maxlength="16" placeholder="NIK" aria-label="default input example" name="nik">
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


{{-- LAMPIRAN 1 --}}
        <div class="modal fade" id="showLampiran1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modal-body">
                        <img src="" alt="" id="imgLampiran1" class="img-fluid">
                </div>
            </div>
            </div>
        </div>

{{-- LAMPIRAN 2 --}}
        <div class="modal fade" id="showLampiran2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modal-body">
                        <img src="" alt="" id="imgLampiran2" class="img-fluid">
                </div>
            </div>
            </div>
        </div>


{{-- LAMPIRAN 3--}}


        <div class="modal fade" id="showLampiran3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modal-body">
                        <img src="" alt="" id="imgLampiran3" class="img-fluid">
                </div>
            </div>
            </div>
        </div>



{{-- LAMPIRAN 4--}}


        <div class="modal fade" id="showLampiran4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modal-body">
                        <img src="" alt="" id="imgLampiran4" class="img-fluid">
                </div>
            </div>
            </div>
        </div>





{{-- LAMPIRAN 5--}}

        <div class="modal fade" id="showLampiran5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modal-body">
                        <img src="" alt="" id="imgLampiran5" class="img-fluid">
                </div>
            </div>
            </div>
        </div>

{{-- LAMPIRAN 6--}}

        <div class="modal fade" id="showLampiran6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modal-body">
                        <img src="" alt="" id="imgLampiran6" class="img-fluid">
                </div>
            </div>
            </div>
        </div>

{{-- LAMPIRAN 7--}}

        <div class="modal fade" id="showLampiran7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="modal-body">
                        <img src="" alt="" id="imgLampiran7" class="img-fluid">
                </div>
            </div>
            </div>
        </div>

{{-- UPDATE SURAT  --}}


 <!-- Modal Edit Siswa -->
 <div class="modal col-md fade" id="editDataSurat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <form action="/data_surat/edit" method="POST" enctype="multipart/form-data" id="form-edit">
                    @method('put')
                    @csrf

                    <input type="hidden" value="" class="form-control" name="id" aria-describedby="">


                    <div class="form-group  d-flex flex-col align-items-center">
                        <label for="optionStatus" class="col-sm-4">Status Surat</label>
                        <select name="kades_status" id="optionStatus" class="form-control col-sm-8">
                            <option value="Dalam Proses Pemeriksaan">Dalam Proses Pemeriksaan</option>
                            <option value="Di Setujui">Di Setujui</option>
                            <option value="Tidak Di Setujui">Tidak Di Setujui</option>
                        </select>
                    </div>

                       <div class="custom-file mb-2">
                            <input type="hidden" name="hidden_file_kades"  id="">
                           <input type="file"  name="file_kades" id="fileKades">
                       </div>

                       <div class="modal-footer">
                           <button type="submit" class="btn btn-primary">Simpan</button>
                       </div>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>



@endsection



@section('js')
    <script>
  var SITEURL = '{{ URL::to('') }}';
        let data = [];
        const table = $('#table-surat').DataTable( {


            autoWidth:false,
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"/surat",
            },
            columns: [

                {data: 'nomor_urut_rt'},
                {data: 'nomor_urut_rw'},
                {data: 'nama'},
                {data: 'nik'},
                {data: 'nomor_kk'},
                {data: 'rt'},
                {data: 'rw'},
                {data: 'alamat'},
                {data: 'tempat_lahir'},
                {data: 'tanggal_lahir'},
                {data: 'jenis_kelamin'},
                {data: 'kewarganegaraan'},
                {data: 'agama'},
                {data: 'maksud_surat'},
                {data: 'kades_status'},
                {data: 'lampiran_satu',
                render: function(data, type, row){
                        let showLampiran1 = `<button class = "btn-primary text-white showLampiran1 rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiran1;
                    }
               },
                {data: 'lampiran_dua',
                render: function(data, type, row){
                        let showLampiran2 = `<button class = "btn-primary text-white showLampiran2 rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiran2;
                    }
            },
                {data: 'lampiran_tiga',
                render: function(data, type, row){
                        let showLampiran3 = `<button class = "btn-primary text-white showLampiran3 rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiran3;
                    }
            },
                {data: 'lampiran_empat',
                render: function(data, type, row){
                        let showLampiran4 = `<button class = "btn-primary text-white showLampiran4 rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiran4;
                    }
            },
                {data: 'lampiran_lima',
                render: function(data, type, row){
                        let showLampiran5 = `<button class = "btn-primary text-white showLampiran5 rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiran5;
                    }
            },
                {data: 'lampiran_enam',
                render: function(data, type, row){
                        let showLampiran6 = `<button class = "btn-primary text-white showLampiran6 rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiran6;
                    }
            },
                {data: 'lampiran_tujuh',
                render: function(data, type, row){
                        let showLampiran7 = `<button class = "btn-primary text-white showLampiran7 rounded-lg">
                            Lihat Gambar
                            </button>`
                        return showLampiran7;
                    }
            },
                {data: 'file_kades',
                "render": function ( data, type, row ) {
                    return "<a href='/filesurat/surat_desa/"+ row.file_kades +"'>" + row.file_kades+ "</a>";

                }
            },
                {data: null,
                    render:function(data, type, row){
                        let tombol =  ` <button class="btn-btn delete">
                                            <img src="{{ asset('assets/icons/hapus-ic.svg') }}" alt="" class="edit-ic" >
                                        </button>`
                        tombol += ` <button class="btn-btn edit" id="examples">
                                              <img src="{{ asset('assets/icons/edit-ic.svg') }}" alt="" class="edit-ic" >
                                        </button>`
                        return tombol;
                    }
                }



            ],
            search:{
                "regex" :true,
                },
                fixedColumns: true
         });




    $('#table-surat tbody').on('click', 'button.showLampiran1', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiran1').modal('show');
        $('#labelNama').text(myrow.nama_lengkap);
        $('#imgLampiran1').attr('src', SITEURL+'/img/lampiran_surat/' + myrow.lampiran_satu);


    });


       $('#table-surat tbody').on('click', 'button.showLampiran2', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiran2').modal('show');
        $('#labelNama').text(myrow.nama_lengkap);
        $('#imgLampiran2').attr('src', SITEURL+'/img/lampiran_surat/' + myrow.lampiran_dua);


    });


       $('#table-surat tbody').on('click', 'button.showLampiran3', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiran3').modal('show');
        $('#labelNama').text(myrow.nama_lengkap);
        $('#imgLampiran3').attr('src', SITEURL+'/img/lampiran_surat/' + myrow.lampiran_tiga);


    });




       $('#table-surat tbody').on('click', 'button.showLampiran4', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiran4').modal('show');
        $('#labelNama').text(myrow.nama_lengkap);
        $('#imgLampiran4').attr('src', SITEURL+'/img/lampiran_surat/' + myrow.lampiran_empat);


    });


     $('#table-surat tbody').on('click', 'button.showLampiran5', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiran5').modal('show');
        $('#labelNama').text(myrow.nama_lengkap);
        $('#imgLampiran5').attr('src', SITEURL+'/img/lampiran_surat/' + myrow.lampiran_lima);


    });



     $('#table-surat tbody').on('click', 'button.showLampiran6', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiran6').modal('show');
        $('#labelNama').text(myrow.nama_lengkap);
        $('#imgLampiran6').attr('src', SITEURL+'/img/lampiran_surat/' + myrow.lampiran_enam);


    });


      $('#table-surat tbody').on('click', 'button.showLampiran7', function(){

        myrow = table.row( $(this).parents('tr') ).data();

        $('#showLampiran7').modal('show');
        $('#labelNama').text(myrow.nama_lengkap);
        $('#imgLampiran7').attr('src', SITEURL+'/img/lampiran_surat/' + myrow.lampiran_tujuh);

    });





    $('#table-surat tbody').on('click', 'button.edit', function(){
        myrow = table.row( $(this).parents('tr') ).data();


        $('#editDataSurat').modal('show');

        $("#form-edit [name='id']").val(myrow.id)
        $("#form-edit [name='kades_status']").val(myrow.kades_status)
        $("#form-edit [name='hidden_file_kades']").val(myrow.file_kades)
          });

    </script>
@endsection

