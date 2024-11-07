
@include('mobile.asset')

<div id="menu-password" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="280" data-menu-effect="menu-over" style="height: 200px; display: block;">
    <div class="content mb-0">
        <h5 class="font-700 mb-0">Ubah Password</h5>
        <p class=" mt-n1 mb-0">
            Silahkan mengganti password anda disini
        </p>
        <form id="form-password" action="{{ url('mobile/password') }}" method="post">
            @csrf
            @method('post')
            <div class="input-style mt-3 has-icon input-style-1 input-required">
                <i class="input-icon fa fa-lock"></i>
                <span>Password baru</span>
                <em>(required)</em>
                <input type="password" required id="baru" name="password" placeholder="Password baru">
            </div>  
            <div class="input-style has-icon input-style-1 input-required pb-2">
                <i class="input-icon fa fa-lock"></i>
                <span>Ulangi password</span>
                <em>(required)</em>
                <input onkeyup="cekpass()" type="password" required id="ulangi" name="ulangi" placeholder="Ulangi password">
                <span id="notifpass" class="mb-4 color-red1-dark"></span>
            </div>   
            <a href="#" id="batal" class="close-menu float-left btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 border-dark1-dark">Batal</a>
            <button type="button" id="simpan" class="btn float-right btn-full btn-m button-s shadow-l rounded-s text-uppercase font-900 bg-red2-dark">Simpan Password</button>
        </form>
    </div>
</div>
<div class="page-content" style="min-height: 654px;">
        
    <div class="page-title page-title-small">
        <h2>Opsi</h2>
        <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url($asn->foto) }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
    </div>
    <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
        <div class="card-overlay bg-highlight opacity-80"></div>
        <div class="card-overlay dark-mode-tint"></div>
        <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/18m.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/18m.jpg') }});"></div>
    </div>
    
    <div class="card card-style">
        <div class="content mt-0 mb-2">
            <div class="list-group list-custom-large mb-4">
                <a href="#" onclick="getHtml('{{ url('mobile/profile') }}')">
                    <i class="fas font-14 fa-user-cog bg-success color-white rounded-sm"></i>
                    <span>Profile</span>
                    <strong>Lengkapi biodata ASN</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a> 
               
                
                    
                <a href="#" onclick="getHtml('{{ url('mobile/rekap') }}')">
                    <i class="fas font-14 fa-table bg-blue2-dark rounded-sm"></i>
                    <span>Rekap</span>
                    <strong>Rekap kegiatan rencana diklat ASN</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a> 

                <a href="#" onclick="getHtml('{{ url('mobile/jadwal') }}')">
                    <i class="fa fa-calendar font-14 bg-pink1-dark rounded-sm"></i>
                    <span>Jadwal Diklat</span>
                    <strong>Temukan jadwal pelaksanaan diklat</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a> 
                <a href="#" onclick="getHtml('{{ url('mobile/rekom') }}')">
                    <i class="fas fa-file-alt font-14 bg-green2-dark rounded-sm"></i>
                    <span>Surat Rekomendasi</span>
                    <strong>Unduh surat Rekomendasi</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a> 

                <a href="#" data-toggle-theme="" class="show-on-theme-light">
                    <i class="fa font-14 fa-moon bg-brown1-dark rounded-sm"></i>
                    <span>Mode Gelap</span>
                    <strong>Tetapkan mode gelap</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a>     
                <a href="#" data-toggle-theme="" class="show-on-theme-dark">
                    <i class="fa font-14 fa-lightbulb bg-yellow1-dark rounded-sm"></i>
                    <span>Mode Terang</span>
                    <strong>Tetapkan mode terang</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a>     
                
                <a href="#" data-menu="menu-password">
                    <i class="fas font-14 fa-key bg-yellow2-dark color-white rounded-sm"></i>
                    <span>Ubah Password</span>
                    <strong>Silahkan perbarui password secara berkala</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a> 
                
                <a data-menu="menu-logout" href="#">
                    <i class="fas font-14 fa-sign-out-alt bg-red2-dark rounded-sm"></i>
                    <span>Log out</span>
                    <strong>Keluar dari aplikasi</strong>
                    <i class="fa fa-angle-right mr-2"></i>
                </a>     
                
                 
               
            </div>
            
        </div>  
    </div>
    


   
    
</div>

<script>
    $(document).ready(function () {
        $('#simpan').click(function (e) { 
            e.preventDefault();
            if(cekpass())
                $('#form-password').submit();
        });

        $('#form-password').submit(function (e) { 
            e.preventDefault();
            $('#batal').trigger('click');
            var url = $(this).attr('action');
                    $.ajax({
                        type: "post",
                        url: url,
                        data: $(this).serialize(),
                        dataType: "json",
                        beforeSend: function(){
                            $('#toast-loading').toast('show');
                        },
                        complete: function(){
                            $('#toast-loading').toast('hide');
                        },
                        success: function (response) {
                            $('#toast-loading').toast('hide');
                            if(response.msg == 1){
                                $('#success').toast('show');
                                $('#success-bd').html('Password diperbarui');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal menyimpan');
                            }
                        }
                    });

        });

    });
    function cekpass(){
                var pass = $('#baru').val();
                var ulangi = $('#ulangi').val();
                if(pass != ulangi){
                    $('#notifpass').html('** Password tidak sesuai..');
                    $('#notifpass').attr('class', 'text-danger');
                    $('#ulangi').focus();
                    return false;
                }else{
                    $('#notifpass').html('OK');
                    $('#notifpass').attr('class', 'text-success');
                    return true;
                }
            }
</script>
