@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#"></a></li>
                        <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
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
            <div class="header-title mb-0">DATA ASN</div>
            <div class="text-warning mb-3">Pilih ASN untuk menampilkan data Rencana Kompetensi</div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                    </tr>
                </thead>
            </table>
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Data Pelaporan Pelaksanaan Diklat</div>
    @endif

<script>

    
</script>

@endsection