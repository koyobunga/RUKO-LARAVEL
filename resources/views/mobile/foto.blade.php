@include('mobile.asset')
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('{{ url('mobile/profile') }}')"><i class="fa fa-arrow-left"></i></a>Foto Profile</h2>
            <a href="#" data-menu="menu-main" style="width: 60px; height: 60px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url($asn->foto) }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
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
                    <h4 class="font-500">{{ $asn->nama }}</h4>
                    <p class="mb-2" style="line-height: 120%">
                        {{-- Mohon laporankan setiap pelaksanaan kompetensi yang telah Anda lakukan.  --}}
                    </p>
                    
                </div>
                
            </div>

            <div class="card card-style mt-4">
                <div class="content mb-0">
                    <h5>Upload Foto Profil</h5>
                    <p>
                        Silahkan upload foto profile anda disini.
                    </p>
                    <form id="form-foto" action="{{ url('mobile/profile/upfoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="file-data">
                            <input required name="foto" type="file" value="{{ old('foto') }}" class="upload-file bg-highlight shadow-s rounded-s @error('foto') {{ 'is-invalid' }} @enderror" accept="image/*">
                            <p class="upload-file-text color-white">Pilih foto</p>
                            @error('foto')
                                <div class="invalid-feedback font-14">{{ $message }}</div>
                            @enderror
                            <img src="{{ url('mobiles/images/empty.png') }}">
                        </div>
                        <div class="list-group list-custom-large upload-file-data disabled">
                            <button data-menu="menu-confirm" type="submit" class="btn btn-xs color-blue2-dark border-blue2-dark mt-2">Simpan foto</button>
                            <a href="#" class="border-0">
                                <i class="fa font-14 fa-info-circle color-blue2-dark"></i>
                                <span>File Name</span>
                                <strong class="upload-file-name">JS Populated</strong>
                            </a>        
                            <a href="#" class="border-0">
                                <i class="fa font-14 fa-weight-hanging color-brown1-dark"></i>
                                <span>File Size</span>
                                <strong class="upload-file-size">JS Populated</strong>
                            </a>        
                            <a href="#" class="border-0">
                                <i class="fa font-14 fa-tag color-red2-dark"></i>
                                <span>File Type</span>
                                <strong class="upload-file-type">JS Populated</strong>
                            </a>        
                            <a href="#" class="border-0 pb-4">
                                <i class="fa font-14 fa-clock color-blue2-dark"></i>
                                <span>Modified Date</span>
                                <strong class="upload-file-modified">JS Populated</strong>
                            </a>        
                        </div>
                </form>
                </div>
            </div>

        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#yakin').click(function (e) { 
                    var form = $("#form-foto"); 
                    var reportValidity = form[0].reportValidity();
                    if(reportValidity){
                        form.submit();
                    }            
                    $('#menu-confirm').hideMenu();
                    e.preventDefault();
                });

            $('#form-foto').submit(function (e) { 
            e.preventDefault();
            var formData = new FormData(this);
            var url = $(this).attr('action');
                    $.ajax({
                        type: "post",
                        url: url,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function(){
                            $('#toast-loading').toast('show');
                        },
                        complete: function(e){
                            $('#toast-loading').toast('hide');
                        },
                        success: function (response) {
                            $('#toast-loading').toast('hide');
                            if(response.msg == 1){
                                $('#info').toast('show');
                                $('#info-bd').html('Foto diperbarui');
                                getHtml('{{ url('mobile/profile') }}');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal perbarui foto');
                            }
                        }
                    });

            });

        });
    </script>
