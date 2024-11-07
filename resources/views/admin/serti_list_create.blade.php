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

    <div class="card-box">

        <form action="{{ url('admin/serti_list') }}" method="POST" enctype="multipart/form-data">
            @csrf
        @method('post')
        <input type="hidden" name="serti_id" value="{{ $serti_id }}">
        <div class="mb-2">Pilih file excel</div>
        <input type="file" accept=".xls" required name="file" class="form-control">
        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-file-import mr-1"></i>Import file</button>
    </form>
</div>

<script>

    
</script>

@endsection