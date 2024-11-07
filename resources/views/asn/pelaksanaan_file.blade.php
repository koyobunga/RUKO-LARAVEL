@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/asn/pelaksanaan') }}">Laporan Komptensi</a></li>
                        <li class="breadcrumb-item"><a href="#">Upload File</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    
    <div class="card-box">
        <form id="form-file" action="{{ url('asn/laporan/file') }}" method="post" enctype="multipart/form-data">
        @csrf
            @method('post')
            <input type="hidden" id="pelaksanaan_id" name="id" value="{{ $pelaksanaan->id }}">
            <div class="row">

                <div class="col-sm-12">
                    <label for="jenis">Pilih file</label>
                    <input type="file" accept=".pdf" id="nm_file" required name="nm_file" class="form-control w-100 @error('nm_file') is-invalid @enderror" required>
                    @error('nm_file')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
            </div>

            <button id="simpan" type="submit" class="btn mt-2 btn-primary"><i class="icon-cloud-upload mr-2"></i>Upload file</button>
        </form>
    </div>


    <script>
        // $(document).ready(function () {
        //     $('#simpan').click(function () { 
        //         var selectedFile = document.getElementById('nm_file').files[0];
        //         var allowedTypes = ['application/pdf'];

        //         if (!allowedTypes.includes(selectedFile.type)) {
        //             alertify.warning('Mohon memilih file type PDF');
        //             document.getElementById('nm_file').value = '';
        //         }

            
        //      });
        // });
       
    </script>
@endsection