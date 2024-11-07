@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="btn btn-outline-warning" href="{{ url('admin/rencana') }}">Kembali</a></li>
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
    @if($asn->rencana->count())
        <div class="card-box">
            <div class="header-title mb-3">RENCANA KOMPETENSI</div>
            <table class="table table-hover  text-wrap" id="datatable">
                <thead>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th class="text-center">Tahun</th>
                        <th>Kompetensi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asn->rencana as $r)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $r->tahun }}</td>
                            <td>{{ $r->diklat->nama }}</td>
                            <td class="text-right">
                                <a onclick="return confirm('Hapus data ini?')" class="btn btn-outline-danger" href="{{ url('admin/rencana/destroy/'.$r->id) }}" class="btn"><i class="mdi mdi-trash-can-outline"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ditemukan rencana kompetensi..</div>
    @endif

<script>

     
</script>

@endsection