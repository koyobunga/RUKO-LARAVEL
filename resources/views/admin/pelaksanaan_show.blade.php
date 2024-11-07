@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="btn btn-outline-warning" href="{{ url('admin/pelaksanaan') }}">Kembali</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <div class="h5 mb-0">{{ $asn->nama }}</div>
                <div class="mb-1">NIP. {{ $asn->nip }}</div>
                <div class="mb-1">{{ $asn->opd->nama }}</div>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($asn->pelaksanaan->count())
        <div class="card-box">
            <div class="header-title mb-3">LAPORAN PELAKSANAAN KOMPETENSI</div>
            <table class="table table-hover  text-wrap" id="datatable">
                <thead>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Kompetensi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asn->pelaksanaan as $p)
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
                            <td class="text-right">
                                @if($p->nm_file != NULL)
                                <a href="{{ url('admin/pelaksanaan/donwload/'.$p->id) }}" class="btn btn-outline-primary"><i class="mdi mdi-download mr-1"></i>Sertifikat</a>
                                @endif
                                    <a onclick="return confirm('Hapus data ini?')" class="btn btn-outline-danger" href="{{ url('admin/pelaksanaan/destroy/'.$p->id) }}" class="btn"><i class="mdi mdi-trash-can-outline"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ditemukan laporan pelaksanaan kompetensi..</div>
    @endif

<script>

     
</script>

@endsection