@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right py-0">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item" style="margin-top: 5px"><a href="{{ url('/asn') }}">Dashboard</a></li> --}}
                        <li class=""><button data-toggle="modal" data-target="#modal-menu" class="btn btn-success btn-sm" style="font-size: 14px">
                            Buat Laporan <i class="icon-plus ml-1"></i></button></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

  

    @if($pelaksanaan->count())
        <div class="card-box table-responsive">
            <table id="datatable" class="table table-hover  text-wrap">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Diklat</th> 
                        <th>File</th> 
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelaksanaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="pb-3">
                                <div class="mb-2 font-weight-bold">
                                    @if($p->diklat_id==0) 
                                        {{ $p->ket }}
                                    @else
                                        {{ $p->diklat->nama }}                                
                                    @endif
                                </div>
                                <div style="text-transform: capitalize">
                                    <i class="icon-clock mr-1 text-primary"></i>{{ $p->jp }} JP
                                    <i class="icon-emotsmile mr-1 ml-2 text-purple"></i>{{ $p->bentuk }}
                                    <i class="icon-location-pin mr-1 ml-2 text-blue"></i>{{ $p->tempat }}
                                    <i class="icon-user-female mr-1 ml-2 text-primary"></i>{{ $p->pelaksana }}
                                    <i class="icon-calender  mr-1 ml-2 text-warning"></i>{{ date('Y', strtotime($p->tgl_mulai)) }}
                                    @if($p->rencana_id==0)
                                        <i class="icon-close mr-1 ml-2 text-danger"></i>Tidak Sesuai
                                        @else
                                        <i class="icon-check mr-1 ml-2 text-success"></i>Sesuai
                                    @endif
                                </div>
                            </td>
                            <td style="font-size: 12px">
                                @if($p->nm_file==NULL)
                                
                                <div class="text-secondary"><i class="icon-close mr-1"></i> Not Available</div>
                                @else
                                <div class="text-success"><i class="icon-check mr-1"></i> Available</div>
                                @endif
                            </td>
                            <td style="width: 10px">
                                <div class="dropdown">
                                    <button class="btn btn-outline-pink btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-settings"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                        @if($p->nm_file==NULL)
                                            <a href="{{ url('asn/pelaksanaan/'.$p->id) }}" class="dropdown-item"><i class="mdi mdi-upload mr-1"></i>Unggah file</a>
                                        @else
                                            <a href="{{ url('asn/pelaksanaan/'.$p->id) }}" class="dropdown-item"><i class="mdi mdi-upload mr-1"></i>Perbarui file</a>
                                            <a href="{{ url('asn/download/pelaksanaan/'.$p->id) }}" class="dropdown-item"><i class="mdi mdi-download mr-1"></i>Unduh Sertifikat</a>
                                        @endif
                                        <hr class="my-1">
                                        <a href="{{ url('asn/pelaksanaan/'.$p->id.'/edit') }}" class="dropdown-item" type="button"><i class="mdi mdi-account-edit mr-1"></i>Edit Laporan</a>
                                        <form action="{{ url('asn/pelaksanaan/'.$p->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')  
                                                <button type="submit" onclick="return confirm('Hapus data ASN?')" class="dropdown-item text-pink" type="button"><i class="mdi mdi-trash-can-outline mr-1 text-pink"></i>Hapus Laporan</button>
                                        </form>
                                    
                                    </div>
                                  </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Data Pelaporan Pelaksanaan Diklat</div>
    @endif
    


    <!-- Modal -->
<div class="modal fade" id="modal-menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Pelaporan Kompetensi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center pb-4">
                <div class="row text-center">
                    <div class="col-sm-12 pr-2">
                        <div class="text-pink px-3 mb-3 alert alert-light">Laporkan Pelaksanaan Kompetensi sesuai dengan Perencanaan atau Kompetensi lainnya yang dilakukan tanpa perencanaan pada Aplikasi Ruko.</div>
                        {{-- <a  class="btn w-100 btn-pink btn-lg"></a> --}}
                        
                        <div class="dropdown w-100">
                            <a href="{{ url('asn/perencanaan/create') }}" class="btn btn-success w-100 py-2" style="font-size: 15px" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Kompetensi Sesuai Perencanaan <i class="mdi mdi-chevron-down ml-3"></i> 
                            </a>
                            <div class="dropdown-menu w-100" aria-labelledby="dropdownMenu2">
                                @foreach($rencana as $key => $value)
                                    <a href="{{ url('asn/pelaksanaan/create?rencana='.$value->id) }}" class="dropdown-item py-2 w-100" type="button">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                {{ $value->tahun }}
                                            </div>
                                            <div class="col-sm-10 pl-3">
                                                @if($value->diklat != null) 
                                                    {{ $value->diklat->nama }}                                
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 pl-2 mt-2">
                        <a href="{{ url('asn/pelaksanaan/create') }}" class="btn w-100 btn-outline-primary btn-lg">Kompetensi lainnya</a>
                    </div>
                </div>
        </div>
      </div>
    </div>


<script>
    function modalfile(id){
        $('#modal-file').modal('show');
        $('#pelaksanaan_id').val(id);
    }
</script>

@endsection