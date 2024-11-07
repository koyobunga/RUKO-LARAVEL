@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class=""><a style="margin-top: -5px" class="btn btn-success" href="{{ url('admin/diklat/create') }}">Tambah data</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($diklat->count())
        <div class="card-box">
            <div class="header-title mb-0">DATA DIKLAT</div>
            <div class="text-warning mb-3"></div>
            <table class="table table-hover" id="datatable-buttons">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Diklat</th>
                        <th>Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($diklat as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-wrap">{{ $d->nama }}</td>
                            <td>{{ $d->kategoridiklat->nama }}</td>
                            <td class="d-flex">   
                                <a href="{{ url('admin/diklat/'.$d->id.'/edit') }}" class="btn btn-outline-blue btn-sm mr-1">
                                    <i class="mdi mdi-square-edit-outline"></i></a>
                                <form id="hapus" action="{{ url('admin/diklat/'.$d->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Hapus data in?')" type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></button>
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


@endsection