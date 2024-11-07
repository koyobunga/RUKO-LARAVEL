@include('mobile.asset')   
    <div class="page-content" style="min-height: 654px;">
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('{{ url('mobile/setting') }}')"><i class="fa fa-arrow-left"></i></a>Profile</h2>
            <a href="#" data-menu="menu-main" style="width: 60px; height: 60px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url($asn->foto) }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/17m.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/17m.jpg') }});"></div>
        </div>
        
       

        <div class="card card-style">
            <div class="content mb-0">        
                <h3 class="float-left">Formulir</h3>
                <a href="#" onclick="getHtml('{{ url('mobile/profile/foto') }}')" class="float-right rounded-xl color-green1-dark btn btn-xs border-gray2-dark"><i class="far fa-edit mr-2"></i>Foto</a>
                <div class="clearfix"></div>
                <p>
                    Lengkapi data yang sesuai
                </p>
                <form id="form-profile" action="{{ url('mobile/profile/update') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="input-style input-style-2 has-icon input-required">
                        <i class="input-icon fa fa-user"></i>
                        <span class="color-highlight input-style-1-active input-style-1-inactive">Nama</span>
                        <em><i class="fa fa-check color-green1-dark"></i></em>
                        <input class="form-control" required type="text" value="{{ old('nama',$asn->nama) }}" name="nama">
                    </div> 
                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">NIP</span>
                        <em>(required)</em>
                        <input required value="{{ old('nip', $asn->nip) }}" class="form-control" type="number" name="nip" placeholder="NIP">
                    </div>

                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">Pendidikan</span>
                        <em><i class="fa fa-angle-down"></i></em>
                        @php
                            $pend = ['SMP', 'SMA/SMK', 'D1', 'D2', 'D3' ,'D4', 'S1', 'S2','S3'];
                        @endphp
                        <select name="pendidikan" required class="form-control">
                            <option value="" selected="">Pilih</option>
                            @foreach($pend as $p)
                                <option @if($p==Str::upper($asn->pendidikan)) {{ "selected" }} @endif  value="{{ $p }}">{{ $p }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">Golongan</span>
                        <em><i class="fa fa-angle-down"></i></em>
                        @php
                            $gol = ['II A', 'II B', 'II C', 'II D','III A', 'III B', 'III C', 'III D','IV A', 'IV B', 'IV C', 'IV D', 'IV E'];
                        @endphp
                        <select name="golongan" required class="form-control">
                            <option value="">Pilih</option>
                            @foreach($gol as $g)
                                <option @if($g==$asn->golongan) {{ "selected" }} @endif  value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">Kelompok ASN</span>
                        <em><i class="fa fa-angle-down"></i></em>
                        @php
                            $kel = ['GURU', 'NON GURU'];
                        @endphp
                        <select name="kelasn" required class="form-control">
                            <option value="">Pilih</option>
                            @foreach($kel as $g)
                                <option @if($g==$asn->kelasn) {{ "selected" }} @endif  value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">OPD</span>
                        <em><i class="fa fa-angle-down"></i></em>
                        <select name="opd_id" required class="form-control">
                            <option value="default" disabled="">Pilih</option>
                            @foreach($opd as $g)
                                <option @if($g->id==$asn->opd_id) {{ "selected" }} @endif  value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">Kelompok ASN</span>
                        <em><i class="fa fa-angle-down"></i></em>
                        <select name="keljab_id" required class="form-control">
                            <option value="default" disabled="">Pilih</option>
                            @foreach($keljab as $g)
                                <option @if($g->id==$asn->keljab_id) {{ "selected" }} @endif  value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">UPT</span>
                        <em><i class="fa fa-angle-down"></i></em>
                        <select name="upt_id" class="form-control">
                            <option value="default" disabled="">Pilih</option>
                            @foreach($upt as $g)
                                <option @if($g->id==$asn->upt_id) {{ "selected" }} @endif  value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">Email</span>
                        <em>(required)</em>
                        <input class="form-control" value="{{ old('email', $asn->email) }}" type="email" name="email" placeholder="">
                    </div>   
                
                    <button data-menu="menu-confirm" type="submit" class="btn btn-m btn-full mb-3 rounded-xl text-uppercase font-900 shadow-s bg-red2-dark">Simpan Perubahan</button>
                </form>
        
            </div>
        </div>    
</div>


<script>
    $(document).ready(function () {
        $('#yakin').click(function (e) { 
                var form = $("#form-profile"); 
                var reportValidity = form[0].reportValidity();
                if(reportValidity){
                    form.submit();
                    $('#menu-confirm').hideMenu();
                }            

                e.preventDefault();
            });

        $('#form-profile').submit(function (e) { 
            e.preventDefault();
            var url = $(this).attr('action');
                    $.ajax({
                        type: "put",
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
                                $('#success-bd').html('Data disimpan');
                                getHtml('{{ url('mobile/profile') }}');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal menyimpan');
                            }
                        }
                    });

        });
    });
</script>
