@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        @if(isset($diklat))
                        <li class=""><a class="btn btn-sm btn-outline-secondary" href="{{ url('asn/jadwal') }}">Lihat Semua</a></li>
                        @endif
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="card-box">
        @if(isset($diklat))
            <div class="row">
                <div class="col-lg-10">
                    <div class="text-pink">Jadwal Pelaksanaan Diklat</div>
                    <div class="header-title mb-3">{{ $diklat->diklat->nama }}</div>
                </div>
               
            </div>

        @else
            <div class="text-pink mb-2">Semua Jadwal Diklat</div>
        @endif
        
        <table id="datatable-buttons" class="table table-hover  dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th style="width: 10px">No.</th>
                    <th>Diklat</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="text-wrap font-weight-bold">
                                {{ $j->diklat->nama }}
                            </div>
                            <div class="mt-1">{{ $j->pelaksana }}</div>
                            <div class="mt-2" style="font-size: 11px">
                                <span class="text-blue">
                                    <i class="icon-location-pin mr-1"></i>{{ $j->tempat }}
                                </span>
                                <span class="text-pink">
                                    <i class="icon-magic-wand ml-2 mr-1"></i>{{ $j->jenis }}
                                </span>
                                <span class="text-primary">
                                    <i class=" icon-calender mr-1 ml-2"></i>{{ $j->tgl_mulai.' sd '.$j->tgl_selesai }}
                                </span>
                            </div>
                            
                        </td>
                        <td class="text-right">
                            <a href="{{ url('asn/rekom/create?id='.$j->id) }}" class="btn btn-sm btn-outline-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Menerbitkan Surat Rekomendasi..">
                                <i class="dripicons-document-new mr-1"></i>Meminta</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script>

    
</script>

@endsection