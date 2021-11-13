
@extends('layouts.sidebar')

@section('css')

@endsection
@section('title', 'Data Kepala Desa')

@section('content')
    <div class="heads d-flex flex-row">
        <h5 class="font-weight-bold">Daftar Kades</h5>
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
        <table class="table tal" id="table-kades">
            <thead class="thead-dark">
            <tr>
                <th scope="col"class="text-center">Nama</th>
                <th scope="col" class="text-center">NIK</th>
                <th scope="col" class="text-center">Aksi</th>

            </tr>
            </thead>
        </table>
    </div>


    <!-- Modal Tambah Kades-->
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
                    <input class="form-control mb-3" type="text" maxlength="16" placeholder="NIK" aria-label="default input example" name="nik" >
                    <input class="form-control mb-3" type="password" placeholder="Password" aria-label=".form-control-sm example" name="password">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

            </div>

        </div>
        </div>
    </div>


     <!-- Modal Edit RW-->
     <div class="modal fade" id="editKades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Kades</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="/kades/edit" method="POST" id="form-edit">
                    @method('put')

                    @csrf
                    <input class="form-control mb-3" type="hidden" placeholder="Nama Ketua RW" aria-label=".form-control-lg example" name="id">
                    <input class="form-control mb-3" type="text" placeholder="Nama Ketua RW" aria-label=".form-control-lg example" name="nama">
                    <input class="form-control mb-3" type="text" maxlength="16" placeholder="NIK" aria-label="default input example" name="nik">
                    <input class="form-control mb-3" type="password" placeholder="Password" aria-label=".form-control-sm example" name="password">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

            </div>

        </div>
        </div>
    </div>


      <!-- Modal Hapus RW-->
      <div class="modal fade" id="deleteKades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kades</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin untuk menghapus data ini ?

                <form action="/kades/delete" method="POST" id="form-delete">
                    @method('delete')

                    @csrf
                    <input class="form-control mb-3" type="hidden"  name="id">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

            </div>

        </div>
        </div>
    </div>
@endsection


@section('js')
    <script>

        const table = $('#table-kades').DataTable( {


            autoWidth:false,
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"/kades",
            },
            columns: [

                {data: 'nama'},
                {data: 'nik'},
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


         $('#table-kades tbody').on('click', 'button.edit', function(){
        myrow = table.row( $(this).parents('tr') ).data();


        $('#editKades').modal('show');

        $("#form-edit [name='id']").val(myrow.id)
        $("#form-edit [name='nama']").val(myrow.nama)
        $("#form-edit [name='nik']").val(myrow.nik)
    });


         $('#table-kades tbody').on('click', 'button.delete', function(){
        myrow = table.row( $(this).parents('tr') ).data();


        $('#deleteKades').modal('show');

        $("#form-delete [name='id']").val(myrow.id)

    });
    </script>
@endsection
