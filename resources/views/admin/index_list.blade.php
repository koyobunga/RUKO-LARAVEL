@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($data)
        <div class="card-box">
            <div class="header-title mb-3">{{ $diklat->nama }}</div>
            {{-- <div class="text-warning mb-3">Pilih ASN untuk menampilkan data Rencana Kompetensi</div> --}}
            <table class="table table-hover" id="datatable-buttons">
                <thead>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Asal OPD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="font-weight-bold">{{ $d->asn->nama }}</div>        
                            </td>
                            <td>{{ $d->asn->nip }}</td>
                            <td>
                                @if($d->asn->opd)
                                {{ $d->asn->opd->nama }}
                                @endif
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