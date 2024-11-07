@include('mobile.asset')
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
                        {{-- Mohon laporankan setiap pelaksanaan kompetensi yang telah Anda lakukan.  --}}
                    </p>
                    
                </div>
                
            </div>

            <div class="card card-style mt-5">
                <div class="content text-center pt-4">
                    <h2><i class="fa fa-sync fa-spin color-red2-dark fa-3x"></i></h2>
                    <h3 class="pt-4">Anda sedang offline</h3>
                    <p class="boxed-text-l">
                        Silahkan periksa koneksi internet anda
                    </p>
                    <div class="row mb-4 text-center">
                        <div class="col-12 pr-0 ms-auto"><a href="{{ url('mobile/login') }}" class="back-button btn btn-m btn-center-m bg-highlight rounded-sm font-800 text-uppercase">Back Home</a></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
