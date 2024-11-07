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
        <form action="{{ url('admin/diklat') }}" method="POST">
            @csrf
            @method('post')
            <div class="form-group row">
                <div class="col-6">
                    <label for="tugas">Diklat</label>
                    <input required class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="tugas">Kategori Diklat</label>
                    <select required class="form-control @error('nama') is-invalid @enderror" name="kategoridiklat_id" id="kategoridiklat_id">
                        <option value="">Pilih</option>
                        @foreach($kategoridiklat as $k)
                            <option @if(old('kategoridiklat_id')==$k->id) {{ "selected" }} @endif value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategoridiklat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-outline-info">Tambahkan </button>
        </form>
    </div>
<script>

    
</script>

@endsection