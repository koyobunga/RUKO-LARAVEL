@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Download</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @if($list->count())
        
        <div class="card-box">
            <div class="header-title">SERTIFIKAT DITERBITKAN BPSDM PROVINSI GORONTALO</div>
            <table id="datatable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Diklat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $l)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="mt-0 font-weight-bold">{{ $l->serti->diklat->nama }}</div>
                                <div class="mt-0">{{ $l->nomor }}</div>
                                    <div style="text-transform: capitalize" class="mt-2" style="font-size: 12px">
                                        <i class="icon-clock mr-1 text-primary"></i>{{ $l->serti->jp }} JP
                                        <i class="icon-emotsmile mr-1 ml-2 text-purple"></i>{{ $l->serti->bentuk }}
                                        <i class="icon-location-pin mr-1 ml-2 text-blue"></i>{{ $l->serti->tempat }}
                                        <i class="icon-user-female mr-1 ml-2 text-primary"></i>{{ $l->serti->opd->nama }}
                                        <i class="icon-calender  mr-1 ml-2 text-warning"></i>{{ date('Y', strtotime($l->serti->tgl_mulai)) }}
                                    
                                    </div>
                            </td>
                            <th>
                                <a href="{{ url('asn/serti_list/'.$l->id) }}" class="btn btn-outline-pink btn-sm"><i class="mdi mdi-download mr-1"></i>Unduh</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Sertifikat</div>
    @endif

@endsection