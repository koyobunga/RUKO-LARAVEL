@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class=""><a style="margin-top: -5px" class="btn btn-success" href="{{ url('admin/jadwal/create') }}">Tambah data</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($jadwal->count())
        <div class="card-box">
            <div class="header-title mb-0">DATA JADWAL DIKLAT</div>
            <div class="text-warning mb-3"></div>
            <table class="table table-hover" id="datatable-buttons">
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
                                <span class="text-primary">
                                    <i class="icon-location-pin mr-1"></i>{{ $j->tempat }}
                                </span>
                                <span class="text-pink">
                                    <i class="icon-magic-wand ml-2 mr-1"></i>{{ $j->jenis }}
                                </span>
                                <span class="text-purple">
                                    <i class=" icon-calender mr-1 ml-2"></i>{{ $j->tgl_mulai.' sd '.$j->tgl_selesai }}
                                </span>
                            </div>
                            
                        </td>
                        <td class="text-right d-flex" style="width: 80px">
                             <a href="{{ url('admin/jadwal/'.$j->id.'/edit') }}" class="btn btn-outline-blue btn-sm mr-1">
                                    <i class="mdi mdi-square-edit-outline"></i></a>
                                <form action="{{ url('admin/jadwal/'.$j->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Hapus data ini?')" type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></button>
                                </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Data Pelaporan Pelaksanaan Diklat</div>
    @endif

<script>

    
</script>

@endsection