@include('mobile.asset')
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('{{ url('mobile/dashboard') }}')" ><i class="fa fa-arrow-left"></i></a>AKD</h2>
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
                    <h5 class="font-700 font-18">{{ $asn->nama }}<i class="fa fa-check-circle color-blue2-dark float-right font-13 mt-2 mr-3"></i></h5>
                    <p class="mb-2" style="line-height: 120%">
                        {{ $asn->keljab->nama }}
                    </p>
                    
                </div>
                
            </div>

            <div class="row">
                <div class="col-lg-12">
                    
                        <h5 class="ml-3 mt-4">Manajerial</h5>    
                        
                        <div id="accordion" class="mt-2">
                            @foreach($kategori->where('id', '!=', '9') as $k)
                                <div class="mb-0">
                                    <div class="card-header bg-light border-bottom" id="headingOne_{{ $k->id }}">
                                        <h6 class="m-0">
                                            <a href="#collapseOne_{{ $k->id }}" class="text-secondary d-flex" data-toggle="collapse"
                                                aria-expanded="false"
                                                aria-controls="collapseOne_{{ $k->id }}">
                                                {{ $k->nama }}
                                                <i class="icon-arrow-down ml-auto"></i>
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseOne_{{ $k->id }}" class="collapse @if($loop->iteration == 1) {{ 'show' }} @else {{ 'hide' }} @endif"
                                            aria-labelledby="headingOne_{{ $k->id }}" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table table-hover">
                                                <tbody>
                                                    @foreach($isian->where('kategori_id','=',$k->id) as $i)
                                                        
                                                        @php
                                                        $checked = '';
                                                        $ak = $akd->where('isian_id',$i->id)->first();
                                                            if($ak != NULL){
                                                                if($ak->nilai==1){
                                                                    $checked = 'checked';
                                                                }
                                                            }
                    
                                                        @endphp
                                                        <tr>
                                                            <td><input {{ $checked }} type="checkbox" onclick="setakd('{{ $i->id }}')" id="isian_{{ $i->id }}" class=""></td>
                                                            <td style="vertical-align: middle">{{ $i->isi }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div> <!-- end col -->
        
            </div>

        </div>



        <div class="card card-style">
   
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h5 class="pl-3">Sosial Kultural</h5>
        
                        <ul class="nav nav-tabs tabs-bordered mt-3">
                            @foreach($kategori->where('id', '9') as $s)
                                <span class="d-none d-sm-block">{{ $s->nama }}</span>
                                
                            @endforeach
                        </ul>
                        
                        @foreach($kategori->where('id', '9') as $c)
                        <div class="pl-3">
                            <table class="table">
                                <tbody>
                                    @foreach($isian->where('kategori_id','=',$c->id) as $i)
                                         @php
                                            $checked = '';
                                            $ak = $akd->where('isian_id',$i->id)->first();
                                            if($ak != NULL){
                                                if($ak->nilai==1){
                                                    $checked = 'checked';
                                                }
                                            }

                                        @endphp
                                        <tr>
                                            <td><input {{ $checked }} type="checkbox" onclick="setakd('{{ $i->id }}')" value="{{ $i->id }}" id="isian_{{ $i->id }}" ></td>
                                            <td style="vertical-align: middle">{{ $i->isi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                    </div>
                </div> <!-- end col -->
        
            </div>

        </div>

        <div class="card card-style">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h5 class="mb-0 p-3">Teknis</h5>
                        
                        <button type="button" class="btn btn-success btn-xs ml-3 mt-0" id="tambah">
                            Buat Uraian
                        </button>            
        
                        <table class="table table-hover mt-3">
                            <tr>
                                <th>Uraian Tugas</th>
                                <th></th>
                            </tr>
                            <tbody id="tabel-teknis">
                                
                            </tbody>
                        </table>
        
                    </div>
                </div>
            </div>
        </div>
        
            
    
       


    </div>


           
            {{-- Modal form teknis --}}
            <div class="modal fade" id="form-teknis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Uraian Kendala Teknis</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ url('mobile/akd/teknis') }}" method="POST" id="frm-teknis">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tugas" class="mb-0">Nama Tugas</label>
                                    <input class="form-control" type="text" required name="tugas" id="tugas" placeholder="Nama Tugas">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tugas" class="mb-0">Uraian Tugas</label>
                                    <input class="form-control" type="text" required name="uraian" id="uraian" placeholder="Uraian Tugas">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tugas" class="mb-0">Kendala yang Dihadapi</label>
                                    <input class="form-control" type="text" required name="kendala" id="kendala" placeholder="Kendala">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
        
        
        
        </div>


    <script>
             
        var teknis = [];
        $(document).ready(function () {
            getteknis();
    
            // $('#yakin').click(function (e) { 
            //     var form = $("#form-rencana"); 
            //     var reportValidity = form[0].reportValidity();
            //     if(reportValidity){
            //         form.submit();
            //     }            
            //     $('#menu-confirm').hideMenu();

            //     e.preventDefault();
            // });


            $('#tambah').click(function (e) { 
                e.preventDefault();
                $('#frm-teknis')[0].reset();
                $('#id').val('');
                $('#form-teknis').modal('show');
            });

            $('#frm-teknis').submit(function (e) { 
                e.preventDefault();
                var url = $(this).attr('action');      
                $.ajax({
                    type: "post",
                    url: url,
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if(response.msg=='success'){
                            $('#form-teknis').modal('hide');
                            $('#success').toast('show');
                            $('#success-bd').html(response.bd);
                            $('#frm-teknis')[0].reset()
                            getteknis()
                        }else{
                            $('#error').toast('show');
                            $('#error-bd').html(response.bd);
                        }
                    }
                });
                
            });
        });
    
    
        function getteknis(){
            var url = '{{ url('mobile/akd/teknis') }}';
            $.ajax({
                type: "get",
                url: url,
                data: "data",
                dataType: "json",
                success: function (response) {
                    var html='';
                    var i = 0;
                    var del_url;
                    var n = 0;
                    teknis = response;
                    response.forEach(element => {
                        i++;
                        html += '<tr>'+
                                '<td style="line-height:110%"><h5>'+element.tugas+'</h5>'+
                                '<div class="mt-2 font-12 color-brown1-dark">'+element.uraian+'</div>'+
                                '<div class="alert mt-2 mb-2 alert-warning">'+element.kendala+'</div></td>'+
                                '<td class="text-right px-0">'+
                                    '<div class="dropdown m-0">'+
                                    '<button class="btn btn-outline-pink btn-sm" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                        '<i class="fa fa-ellipsis-v"></i>'+
                                    '</button>'+
                                    '<div class="dropdown-menu dropdown-menu-right px-0 font-13" aria-labelledby="dropdownMenu2">'+
                                        '<button onclick="edit('+n+')" class="dropdown-item"><i class="far fa-edit mr-1"></i>Edit</button>'+
                                        '<button onclick="hapus('+element.id+')" class="dropdown-item" ><i class="far fa-trash-alt mr-1 text-pink"></i>Hapus</button>'+
                                    '</div></div>'+
                                '</td>'+
                            '</tr>';
                            n++;
                    });
                    $('#tabel-teknis').html(html);
                }
            });
        }
        
        function edit(index) { 
            $('#tugas').val(teknis[index].tugas);
            $('#uraian').val(teknis[index].uraian);
            $('#kendala').val(teknis[index].kendala);
            $('#id').val(teknis[index].id);
            $('#form-teknis').modal('show');
        }
    
        function hapus(teknis_id) { 
            var url = "{{ url('mobile/akd/teknis/del') }}";
            
                $.ajax({
                    type: "get",
                    url: url,
                    data: {id:teknis_id},
                    dataType: "json",
                    success: function (response) {
                            if(response.msg=='success'){
                                getteknis();
                                $('#info').toast('show');
                                $('#info-bd').html('Data dihapus');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal menghapus');
                            }
                    }
                });           
           
        }
    
        function setakd(isian_id) { 
            var nilai;
            var asn_id = '{{ $asn->id }}';
            var keljab_id = '{{ $asn->keljab_id }}';
            if($('#isian_'+isian_id).is(':checked') ){
                nilai = 1
            }else{
                nilai = 0;
            }
    
            $.ajax({
                type: "get",
                url: "{{ url('mobile/akd/store') }}",
                data: {isian_id:isian_id, nilai:nilai, asn_id:asn_id, keljab_id:keljab_id},
                dataType: "json",
                success: function (response) {
                    if(nilai==1){
                        $('#success').toast('show');
                        $('#success-bd').html('Disimpan');
                    }else{
                        $('#info').toast('show');
                        $('#info-bd').html('Telah diubah');
                    }
                }
            });
         }
    </script>
    
