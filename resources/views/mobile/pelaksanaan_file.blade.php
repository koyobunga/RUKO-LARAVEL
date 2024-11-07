@include('mobile.asset')
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('mobile/pelaksanaan')"><i class="fa fa-arrow-left"></i></a>Sertifikat</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
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
                    <p class="mb-3" style="line-height: 120%">
                        Silahkan mengunggah sertifikat disini.
                    </p>
                    
                </div>
                    
            </div>
        </div>

        <div class="card card-style p-3">
            
            <h5>
                @if($pelaksanaan->diklat_id==0) 
                    {{ $pelaksanaan->ket }}
                @else
                    {{ $pelaksanaan->diklat->nama }}                                
                @endif
                                     Silahkan mengunggah sertifikat disini.</h5>
            <p class="mb-2 color-blue1-dark" style="text-transform: capitalize">{{ $pelaksanaan->bentuk.', '.$pelaksanaan->jp }} JP</p>
            <form id="form-file" action="{{ url('mobile/laporan/file') }}" method="post" enctype="multipart/form-data">
                 @csrf
                <input type="text" id="pelaksanaan_id" name="id" value="{{ $pelaksanaan->id }}">
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
    
                <button data-menu="menu-confirm" type="submit" class="btn btn-success"><i class="icon-cloud-upload mr-2"></i>Upload file</button>
            </form>
        </div>
    </div>

<script>
   $(document).ready(function () {
        $('#yakin').click(function (e) { 
                var form = $("#form-file"); 
                var reportValidity = form[0].reportValidity();
                if(reportValidity){
                    form.submit();
                }            
                $('#menu-confirm').hideMenu();

                e.preventDefault();
            });

        $('#form-file').submit(function (e) { 
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
                                $('#info-bd').html('File diperbarui');
                                getHtml('{{ url('mobile/pelaksanaan') }}');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal perbarui file');
                            }
                        }
                    });

            });

   });
</script>
