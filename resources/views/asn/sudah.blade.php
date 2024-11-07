@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="{{ url('/asn') }}">Dashboard</a></li> --}}
                        
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="btn-group btn-group-justified text-white mb-2">

        <a href="{{ url('asn/profile') }}" class="btn btn-{{ (request()->is('asn/profile'))? '' : 'outline-' }}primary waves-effect waves-light" role="button"><i class="mdi mdi-tooltip-account mr-1"></i> Profile</a>
        <a href="{{ url('asn/sudah') }}" class="btn btn-{{ (request()->is('asn/sudah'))? '' : 'outline-' }}warning waves-effect waves-light" role="button"><i class="icon-like mr-1"></i> Kompetensi Diikuti</a>
        <a href="{{ url('asn/belum') }}" class="btn btn-{{ (request()->is('asn/belum'))? '' : 'outline-' }}danger waves-effect waves-light" role="button"><i class="icon-paper-plane mr-1"></i> Kompetensi Dibutuhkan</a>
    </div>


    <div class="card-box">
        <div class="header-title">Silahkan Tambahkan Diklat/Kompetensi yang telah diikuti</div>
        {{-- <div class="text-danger">Beri tanda centang <i class="fe-check-square text-primary"></i> pada Diklat yang telah diikuti</div> --}}
    </div>

    <div class="card-box">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-diklat">
            Tambah
          </button>
            <table id="" class="table table-hover  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        
                <thead>
                <tr>
                    <th style="width: 10px">No.</th>
                    <th>Diklat</th>
                    <th>Kategori</th>
                    <th></th>
                </tr>
                </thead>


                <tbody id="tabel-body">
            
            
            
                </tbody>
            </table>
        
    </div>


    <div class="modal fade" id="modal-diklat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Diklat/Pelatihan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table id="datatable" class="table table-striped  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        
                    <thead>
                    <tr>
                        <th></th>
                        <th>Diklat</th>
                        <th>Kategori</th>
                    </tr>
                    </thead>
    
    
                    <tbody>
                        @foreach($diklat as $d)   
                            <tr>
                                <td>
                                    <button onclick="add('{{ $d->id }}')" class="btn btn-sm py-1 px-2 btn-primary"><i class="icon-plus"></i></button>
                                </td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->kategoridiklat->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

<script>
    $(document).ready(function () {
        getdata();
    });

    function add(id){
        var url = "{{ url('/asn/sudah/add') }}";
        $.ajax({
            type: "get",
            url: url,
            data: {id:id},
            dataType: "json",
            success: function (response) {
                if(response.message == 1){
                    getdata();
                    alertify.success('Diklat ditambahkan');
                }else if(response.message == 4){
                    alertify.warning('Diklat sudah ditambahkan sebelumnya..');
                }else{ 
                    alertify.error('Gagal menambahkan diklat..');
                }
            }
        });
    }    

    function getdata(){
        $.ajax({
            type: "get",
            url: "{{ url('/asn/sudah/getdata') }}",
            data: "data",
            dataType: "json",
            success: function (response) {
                var html = '';
                var i = 0;
                response.forEach(element => {
                    i++;
                    html += '<tr>'+
                        '<td class=text-center>'+i+'</td>'+
                        '<td>'+element.diklat.nama+'</td>'+
                        '<td>'+element.diklat.kategoridiklat.nama+'</td>'+
                        '<td><button onclick="del('+element.id+')" class="btn btn-sm btn-outline-danger"><i class="icon-trash"></i></button></td>'+
                    '</tr>';
                });

                $('#tabel-body').html(html);
            }
        });
    }

    function del(id){
        $.ajax({
            type: "get",
            url: "{{ url('/asn/sudah/delete') }}",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                if(response.message == 1){
                    getdata();
                    alertify.warning('Diklat telah di hapus..');
                }else{
                    alertify.error('Gagal menghapus..');
                }
            }
        });
    }
</script>

@endsection