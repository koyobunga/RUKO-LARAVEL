@include('mobile.asset')
    
    <div class="page-content" style="min-height: 654px;">
        <div class="page-title page-title-small">
            <h2>Rencana</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/18m.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/18m.jpg') }});"></div>
        </div>
        
       

        <div class="card card-style">
            <div class="content mb-0 px-2 pb-2">        
                <h5>Input Rencana</h5>
                <p>
                    Silahkan Merencankan Pengembangan Kompetensi 5 Tahunan
                </p>
                <form id="form-rencana" action="{{ url('mobile/rencana') }}" method="POST">
                    @csrf
                    @method('post')
                    
                    <div class="input-style input-style-2 input-required">
                        <span class="input-style-1-active input-style-1-inactive">Tahun</span>
                        <em><i class="fa fa-check color-green1-dark"></i></em>
                        <select name="tahun" required class="form-control">
                            <option value="" disabled="" selected="">Pilih</option>
                            @for($i = 0; $i < 5; $i++)
                                <option @if(old('tahun')==$i+date('Y')) {{ 'selected' }} @endif value="{{ $i+date('Y') }}">{{ $i+date('Y') }}</option>
                            @endfor
                        </select>
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-style input-style-2 input-required">
                        <span class="input-style-1-active input-style-1-inactive">Bentuk</span>
                        <em><i class="fa fa-check color-green1-dark"></i></em>
                        <select name="bentuk" required class="form-control">
                            <option value="" disabled="" selected="">Pilih</option>
                            <option @if(old('bentuk')=='pelatihan') {{ 'selected' }} @endif value="pelatihan">Pelatihan</option>
                            <option @if(old('bentuk')=='pendidikan') {{ 'selected' }} @endif value="pendidikan">Pendidikan</option>
                        </select>
                        @error('bentuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-style input-style-2 input-required">
                        <span class="input-style-1-active input-style-1-inactive">Jalur</span>
                        <em><i class="fa fa-check color-green1-dark"></i></em>
                        <select name="jalur" required class="form-control">
                            <option value="" disabled="" selected="">Pilih</option>
                            <option @if(old('jalur')=='klasikal') {{ 'selected' }} @endif value="klasikal">Klasikal</option>
                            <option @if(old('jalur')=='non klasikal') {{ 'selected' }} @endif value="non klasikal">Non Klasikal</option>
                            <option @if(old('jalur')=='blanded') {{ 'selected' }} @endif value="blanded">Blanded</option>
                        </select>
                        @error('jalur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-style input-style-2 input-required">
                        <span class="color-highlight input-style-1-active input-style-1-inactive">Diklat</span>
                        <em>(required)</em>
                        <input required value="{{ old('diklat') }}" class="form-control" autofocus type="name" readonly name="diklat" id="diklat" placeholder="">
                        @error('diklat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>   
                    <input class="form-control" value="{{ old('diklat_id') }}" required type="hidden" name="diklat_id" id="diklat_id" placeholder="">
                  

                    <button type="submit" data-menu="menu-confirm" class="btn btn-border btn-s btn-full mb-3 rounded-xl text-uppercase font-900 border-red1-dark color-red2-dark bg-theme">Tambahkan </button>


                </form>
        
            </div>
        </div>   
        
   

        <div class="card card-style px-2">
            <div class="content mb-2">
                <h5>List Rencana</h5>
                <p>
                    Perencanaan pengembangan kompetensi 5 tahunan
                </p>
                <table class="table table-borderless text-center rounded-sm" style="overflow: hidden;">
                    <thead>
                        
                    </thead>
                    <tbody id="list-rencana">
                        
                    </tbody>
                </table>
            </div>
        </div>

        
</div>



    {{-- Modal form --}}
    <div class="modal fade" id="modal-diklat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Diklat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="search-box search-color bg-red2-dark rounded-xl mb-3">
                    <i class="fa fa-search"></i>
                    <input id="search" type="text" class="border-0" placeholder="Search here.." data-search="">
                </div>
                <table id="data-diklat" data-ordering="false" class="table table-hover text-wrap">
                        @foreach($diklat as $d)
                            <tr data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk memilih.." onclick="set_diklat('{{ $d->id }}','{{ $d->nama }}')" style="cursor: pointer;">
                                <td style="min-width: 400px" class="text-wrap">{{ $d->nama }}</td>
                            </tr>
                        @endforeach
                    
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" style="" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      

     


<script>

    $(document).ready(function () {
        get_diklat();
        $('#yakin').click(function (e) { 
            var form = $("#form-rencana"); 
            var reportValidity = form[0].reportValidity();
            if(reportValidity){
                form.submit();
            }            
            $('#menu-confirm').hideMenu();

            e.preventDefault();
        });

        


    });

    $('#form-rencana').submit(function (e) { 
            e.preventDefault();
            var url = '{{ url('mobile/rencana') }}';
            $.ajax({
                type: "post",
                url: url,
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    if(response.msg=='info'){
                        $('#info').toast('show')
                        $('#info-bd').html(response.body);
                    }
                    if(response.msg=='success'){
                        $('#form-rencana')[0].reset();
                        $('#success').toast('show')
                        $('#success-bd').html(response.body);
                        get_diklat();
                    }
                    if(response.msg=='error'){
                        $('#error').toast('show')
                        $('#error-bd').html(response.body);
                    }
                }
            });
        });

    $('#diklat').click(function (e) { 
        e.preventDefault();
        $('#modal-diklat').modal('show');
    });

    function get_diklat(){
        var url ='{{ url('mobile/rencana/get') }}';
        $.ajax({
            type: "get",
            url: url,
            data: "data",
            dataType: "json",
            success: function (response) {
                var html = '';
                var nm ='';
                response.data.forEach(element => {
                    var badge = '';
                    var nm ='';
                    if(element.sts==2)
                            badge = '<span class="badge bg-green1-dark p-2">'+element.tahun+'</span>';
                    else
                        badge = '<span class="badge bg-orange-light p-2">'+element.tahun+'</span>';
                    if(element.diklat != null)
                        nm = element.diklat.nama
                    
                    html += '<tr>'+
                            '<th class="pl-1" scope="row" style="text-align:left; line-height:120%; ">'+nm+
                                '<div class="color-theme mt-2" style="text-transform: capitalize;font-weight:normal">'+element.bentuk+' - '+element.jalur+'</div></th>'+
                            '<td class="pr-1">'+badge+'</td>'+
                            '</tr>';
                });

                $('#list-rencana').html(html);
            }
        });
    }

    function set_diklat(id, nama){
        $('#diklat').focus();
        $('#diklat').val(nama);
        $('#diklat_id').val(id);
        $('#modal-diklat').modal('hide');
    }

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#data-diklat tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
</script>

