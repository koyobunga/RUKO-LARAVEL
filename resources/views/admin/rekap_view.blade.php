@php
    use App\Models\Pelaksanaan;
@endphp
@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#"></a></li>
                        <li class="" style="margin-top: -5px"><a class="btn btn-outline-primary" href="{{ url('admin/rekap') }}">Kembali</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $opd->nama }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($data)
        <div class="card-box">
            <div class="header-title mb-0 ">{{ $view }}</div>
        </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div id="accordion" class="mb-3">

                        

                            <div class="card mb-0">
                                <div style="background: #fafafa" class="card-header border-bottom" id="headingOne">
                                    <h5 class="m-0">
                                        <a href="#collapseOne" style="font-size: 13px" class="nav-link text-success py-0 pl-0" data-toggle="collapse"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="mdi mdi-chevron-right mr-2"></i>OPD
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show"
                                        aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <table class="table table-hover" id="datatable-buttons">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>NIP</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sudah = 0;
                                                    $belum = 0;    
                                                @endphp
                                                @foreach($data->where('upt_id', 0) as $d)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $d->nama }}
                                                        </td>
                                                        <td>{{ $d->nip }}</td>
                                                        <td>
                                                            @if($v_id == 'rencana')
                                                                @php $hit = $d->rencana->where('tahun', $tahun)->groupby('asn_id')->count(); @endphp
                                                            @elseif($v_id == 'laporan')
                                                                @php 
                                                                    $pel = Pelaksanaan::whereyear('tgl_mulai', $tahun)->where('asn_id', $d->id)->get();
                                                                    $hit = $pel->groupby('asn_id')->count(); 
                                                                @endphp
                                                            @elseif($v_id == 'jp')
                                                                @php
                                                                    $pel = Pelaksanaan::whereyear('tgl_mulai', $tahun)->where('asn_id', $d->id)->get(); 
                                                                    $hit = $pel->sum('jp'); 
                                                                    if($hit>19){
                                                                        $hit = 1;
                                                                    }else{
                                                                        $hit = 0;
                                                                    }
                                                                @endphp
                                                            @else

                                                            @endif
                                                                @if($v_id != 'login')
                                                                    @if($hit>0)
                                                                        @php
                                                                            $sudah++;
                                                                        @endphp
                                                                        <span class="text-success"><i class=" mdi mdi-checkbox-multiple-marked-circle" style="font-size:16px"></i> Fix</span>
                                                                    @else
                                                                        @php
                                                                            $belum++;
                                                                        @endphp
                                                                        <span class="text-muted"><i class="mdi mdi-close-box-multiple-outline fs-3"></i> Not</span>
                                                                    @endif
                                                                @endif

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if($v_id != 'login')
                                            <div class="text-center mt-3 mb-3" style="font-size: 13px">
                                                <span class="text-success"><i class="mdi mdi-checkbox-multiple-marked mr-1"></i><b> {{ $sudah }}</b> Menyelesaikan</span> 
                                                <span class="text-muted"><i class="mdi mdi-close-box-multiple-outline ml-3 mr-1"></i> <b>{{ $belum }}</b> Belum</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @foreach($opd->upt as $u)
                                <div class="card mb-0">
                                    <div style="background: #fafafa" class="card-header border-bottom" id="headingOne_{{ $u->id }}">
                                        <h5 class="m-0">
                                            <a href="#collapseOne_{{ $u->id }}" style="font-size: 13px" class="nav-link text-success py-0 pl-0" data-toggle="collapse"
                                                    aria-expanded="true"
                                                    aria-controls="collapseOne_{{ $u->id }}">
                                                <i class="mdi mdi-chevron-right mr-2"></i>{{ $u->nama }}
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne_{{ $u->id }}" class="collapse"
                                            aria-labelledby="headingOne_{{ $u->id }}" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table table-hover" id="datatable-upt_{{ $u->id }}">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>ASN</th>
                                                        <th>NIP</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $sudah = 0;
                                                        $belum = 0;    
                                                    @endphp
                                                    @foreach($data->where('upt_id', $u->id) as $d)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                {{ $d->nama }}
                                                            </td>
                                                            <td>{{ $d->nip }}</td>
                                                            <td>
                                                                @if($v_id == 'rencana')
                                                                    @php $hit = $d->rencana->where('tahun', $tahun)->count(); @endphp
                                                                @elseif($v_id == 'laporan')
                                                                    @php 
                                                                        $pel = Pelaksanaan::whereyear('tgl_mulai', $tahun)->where('asn_id', $d->id)->get();
                                                                        $hit = $pel->count(); 
                                                                    @endphp
                                                                @elseif($v_id == 'jp')
                                                                    @php
                                                                        $pel = Pelaksanaan::whereyear('tgl_mulai', $tahun)->where('asn_id', $d->id)->get(); 
                                                                        $hit = $pel->sum('jp'); 
                                                                        if($hit>19){
                                                                            $hit = 1;
                                                                        }else{
                                                                            $hit = 0;
                                                                        }
                                                                    @endphp
                                                                @else
    
                                                                @endif
                                                                    @if($v_id != 'login')
                                                                        @if($hit>0)
                                                                            @php
                                                                                $sudah++;
                                                                            @endphp
                                                                            <span class="text-success"><i class=" mdi mdi-checkbox-multiple-marked-circle" style="font-size:16px"></i> Fix</span>
                                                                        @else
                                                                            @php
                                                                                $belum++;
                                                                            @endphp
                                                                            <span class="text-muted"><i class="mdi mdi-close-box-multiple-outline fs-3"></i> Not</span>
                                                                        @endif
                                                                    @endif
    
                                                            </td>
    
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if($v_id != 'login')
                                                <div class="text-center mt-3 mb-3" style="font-size: 13px">
                                                    <span class="text-success"><i class="mdi mdi-checkbox-multiple-marked mr-1"></i><b> {{ $sudah }}</b> Menyelesaikan</span> 
                                                    <span class="text-muted"><i class="mdi mdi-close-box-multiple-outline ml-3 mr-1"></i> <b>{{ $belum }}</b> Belum</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        

                    </div>

                </div>
      
            </div> 
            
         
        
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Data Pelaporan Pelaksanaan Diklat</div>
    @endif

<script>
    var data = {!! json_encode($opd->upt) !!};
    $(document).ready(function () {
        data.forEach(element => {     
            $("#datatable-upt_"+element.id).DataTable({ 
                
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            }); 
        });
    });
</script>

@endsection