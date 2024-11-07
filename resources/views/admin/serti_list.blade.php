@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li>
                            <div class="btn-group" style="margin-top: -5px" role="group" aria-label="Basic example">
                                <a href="{{ url('admin/serti') }}" type="button" class="btn btn-outline-secondary " style="padding-top: 8px; padding-bottom: 0px; width: 40px;"><i class="dripicons-chevron-left"></i></a>
                                <a href="{{ url('admin/serti_list/create?serti_id='.$serti->id) }}" type="button" class="btn btn-primary"><i class="mdi mdi-file-import mr-1"></i>Import Perserta</a>
                                <a href="{{ url('format_excel/excel_format.xls') }}" class="btn btn-info"><i class="mdi mdi-file-download mr-1"></i>Format Excel</a>
                                <a id="terbitkan"   type="button" data-toggle="modal" data-target="#modal-terbit" class="btn btn-warning"><i class="mdi mdi-file-document-box-check mr-1"></i>Terbitkan</a>
                                <a href="{{ url('admin/serti/singkron/'.$serti->id) }}" onclick="return confirm('Singkron ke Laporan Pelaksanaan ASN?')" class="btn btn-pink"><i class="mdi mdi-sync mr-1"></i>Singkron</a>
                              </div>
                        </li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($serti->count())
        <div class="card-box px-4">
            <div class="header-title mb-3">DATA PESERTA</div>
            
            <table class="table table-hover" id="datatable">
                <thead>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th style="width: 60px">No. Urut</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th style="width:70px">Sertifikat</th>
                        <th style="max-width:100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->no_urut }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->nip }}</td>
                            <td>
                                @if($s->sts==0)
                                    <div class="badge bg-secondary p-1">Belum terbit..</div>
                                @elseif($s->sts==1)
                                    <div class="badge bg-primary p-1">Telah terbit</div>
                                @else
                                    <div class="badge bg-success p-1">Telah Singkron</div>
                                @endif
                            </td>
                            <td class="text-right">
                                    @if($s->sts>0)
                                    <a style="font-size: 14px" class="btn btn-outline-primary btn-sm d-inline" href="{{ url('admin/serti_list/'.$s->id) }}" ><i class="mdi mdi-file-pdf mx-0 p-0"></i></a>
                                    @endif
                                    @if($s->sts<2)
                                    <form action="{{ url('admin/serti_list/'.$s->id) }}" method="post" class="d-inline">
                                          @csrf
                                          @method('DELETE')  
                                          <button style="font-size: 12px" class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('Hapus data Sertifikat?')"><i class="mdi mdi-trash-can-outline"></i></button>
                                     </form>
                                     @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Data Sertifikat</div>
    @endif

<!-- Modal -->
<div class="modal fade" id="modal-terbit" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Template Sertifikat</h5>
          <button id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-1 bg-light">

            

            <div class="row">
                @foreach($template as $t)  
                    <div class="col-sm-4">
                        <a href="#" class="nav-link text-secondary font-weight-bold" onclick="terbit('{{ $serti->id }}','{{ $t->id }}')">
                        <div class="card">
                            <img class="card-img-top" src="{{ url('img/bg-serti/'.$t->nm_file) }}" alt="Card image cap">
                            <div class="card-body text-center p-2">
                                        {{ $t->nama }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                
            </div>
            
            
        </div>
       
      </div>
    </div>
  </div>

  <script>

      function terbit(id, template){
        $url = "{{ url('admin/serti/terbit') }}/"+id+'?template='+template;
        alertify.confirm('Terbitkan sekrang?', function(){
            $('#modal-terbit').modal('hide');
            $.ajax({
            type: "GET",
            url: $url,
            dataType: 'json',
                beforeSend: function () {
                   loadingShow();
                },
                success: function (data) {
                    loadingHide();
                    $('#modal-terbit').modal('hide');
                    alertify.success(data.message);
                    document.location='';         
                },
                complete: function () {
                    loadingHide();
                },
            });
        });
        
      }
  </script>

@endsection