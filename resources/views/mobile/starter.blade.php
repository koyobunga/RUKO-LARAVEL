@extends('layout.mobile')
@section('page')
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" data-back-button=""><i class="fa fa-arrow-left"></i></a>Settings</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url($asn->foto) }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/20s.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/20s.jpg') }});"></div>
        </div>
        <div class="card card-style">
            <div class="d-flex content mb-1">
                <!-- left side of profile -->
                <div class="flex-grow-1">
                    <h5 class="font-700">{{ $asn->nama }}<i class="fa fa-check-circle color-blue2-dark float-right font-13 mt-2 mr-3"></i></h5>
                    <p class="mb-2" style="line-height: 120%">
                        Mohon laporankan setiap pelaksanaan kompetensi yang telah Anda lakukan. 
                    </p>
                    
                </div>
                
            </div>

            

        </div>

    </div>


    <script>
        
    </script>
@endsection