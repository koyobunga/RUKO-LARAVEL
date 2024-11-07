@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="{{ url('/asn') }}">Dashboard</a></li> --}}
                        <li class="breadcrumb-item"><a href="#">AKD</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="card-box">
        <h4 class="header-title">{{ $asn->keljab->nama }}</h4>
                <div class="text-muted">Jabatan Anda</div>
                <div class="text-danger mt-2">Di bawah ini adalah quesioner tentang kelompok jabatan. Anda bisa memberi tanda centang <i class="fe-check-square text-secondary"></i> pada indikator kompetensi yang sudah Anda kuasai. </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">     
                <h4 class="header-title text-success">Manajerial</h4>    
                
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
                                                <tr class="table table-striped">
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
            </div>
        </div> <!-- end col -->

    </div>
    


    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title text-success">Sosial Kultural</h4>

                <ul class="nav nav-tabs tabs-bordered mt-3">
                    @foreach($kategori->where('id', '9') as $s)
                        <li class="nav-item">
                            <a href="#home-{{ $s->id }}" data-toggle="tab" aria-expanded="false" class="nav-link @if($loop->iteration==1) {{ 'active' }} @endif">
                                <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                <span class="d-none d-sm-block">{{ $s->nama }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    
                    @foreach($kategori->where('id', '9') as $c)
                        <div class="tab-pane @if($loop->iteration==1) {{ 'active' }} @endif" id="home-{{ $c->id }}">
                            <table class="table table-striped">
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
                                        <tr class="table table-striped">
                                            <td><input {{ $checked }} type="checkbox" onclick="setakd('{{ $i->id }}')" value="{{ $i->id }}" id="isian_{{ $i->id }}" ></td>
                                            <td style="vertical-align: middle">{{ $i->isi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="header-title h4 text-success mr-auto d-flex">Teknis</div>
                    </div>
                    <div class="col-lg-3 text-right">
                        <button type="button" class="btn btn-outline-success" id="tambah">
                            Buat Uraian
                        </button>            
                    </div>
                </div>

                <table class="table table-hover mt-3">
                    <tr>
                        <th>No.</th>
                        <th>Nama Tugas</th>
                        <th>Uraian</th>
                        <th>Kendala</th>
                        <th style="width: 115px">Opt</th>
                    </tr>
                    <tbody id="tabel-teknis">
                        
                    </tbody>
                </table>

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
            <form action="{{ route('teknis.store') }}" method="POST" id="frm-teknis">
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tugas">Nama Tugas</label>
                            <input class="form-control" type="text" required name="tugas" id="tugas" placeholder="Nama Tugas">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tugas">Uraian Tugas</label>
                            <input class="form-control" type="text" required name="uraian" id="uraian" placeholder="Uraian Tugas">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tugas">Kendala yang Dihadapi</label>
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


<script>
     
    var teknis = [];
    $(document).ready(function () {
        getteknis();

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
                    if(response.message=='success'){
                        $('#form-teknis').modal('hide');
                        alertify.success(response.pesan);
                        $('#frm-teknis')[0].reset()
                        getteknis()
                    }else{
                        alertify.warning('Gagal menambahkan..');
                    }
                }
            });
            
        });
    });


    function getteknis(){
        var url = '{{ route('teknis.index') }}';
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
                    html += "<tr>"+
                            "<td>"+i+"</td>"+
                            "<td>"+element.tugas+"</td>"+
                            "<td>"+element.uraian+"</td>"+
                            "<td>"+element.kendala+"</td>"+
                            "<td>"+
                                    "<button onclick='edit("+n+")' class='btn btn-outline-primary btn-sm mr-1' type='button'><i class='dripicons-document-edit'></i></button>"+
                                    "<button onclick='hapus("+element.id+")' class='btn btn-outline-danger btn-sm' type='button'><i class='dripicons-trash'></i></button>"+
                            "</td>"+
                        "</tr>";
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
        var url = "{{ url('/asn/akd/teknis/del') }}";
        
        
        alertify.confirm('Hapus data ini?', function(){
            $.ajax({
                type: "get",
                url: url,
                data: {id:teknis_id},
                dataType: "json",
                success: function (response) {
                        if(response.message=='success'){
                            getteknis();
                            alertify.warning('Data telah dihapus..');
                        }else{
                            alertify.error('Gagal menghapus data..');
                        }
                }
            });
        }).set({title:'Konfirmasi'});
        
       
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
            url: "{{ url('asn/akd/store') }}",
            data: {isian_id:isian_id, nilai:nilai, asn_id:asn_id, keljab_id:keljab_id},
            dataType: "json",
            success: function (response) {
                if(nilai==1)
                    alertify.success('Telah memilih..');
                else
                alertify.warning('Telah diubah..');
            }
        });
     }
</script>

@endsection