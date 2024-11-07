<?php

namespace App\Http\Controllers;

use App\Models\Serti;
// use Barryvdh\DomPDF\PDF;
use App\Models\Serti_list;
use App\Imports\ListImport;
use App\Models\Pelaksanaan;
use App\Models\Rencana;
use App\Models\Template;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class AsertilistController extends Controller
{
    public function index()
    {
        
    }
    

    function singkron(Serti $serti){
        $jlh = 0;
        set_time_limit(0);
        foreach ($serti->serti_list as $l) {
            $cek_rencana = Rencana::select('rencanas.id as id','asn_id','diklat_id')->where('diklat_id', $serti->diklat_id)
                ->where('tahun', date('Y', strtotime($serti->tgl_mulai)))
                ->join('asns', 'asns.id', '=', 'rencanas.asn_id')
                ->where('asns.nip', $l->nip)->get();
            if($cek_rencana->count()>0){
                $cek_rencana = $cek_rencana->first();
                $insPel = [
                    'asn_id' => $cek_rencana->asn_id,
                    'rencana_id' => $cek_rencana->id,
                    'diklat_id' => $cek_rencana->diklat_id,
                    'pelaksana' => $serti->opd->nama,
                    'tgl_mulai' => $serti->tgl_mulai,
                    'tgl_selesai' => $serti->tgl_selesai,
                    'tempat' => $serti->tempat,
                    'bentuk' => $serti->bentuk,
                    'jp' => $serti->jp,
                    'no_serti' => $l->nomor,
                    'nm_file' => $l->nomor,
                ];
                // dd($cek_rencana);
                $cek_ada = Pelaksanaan::where('rencana_id', $cek_rencana->id)->where('asn_id', $cek_rencana->asn_id)
                    ->where('diklat_id', $cek_rencana->diklat_id)->get();
                    if($cek_ada->count()>0){
                        Pelaksanaan::where('id', $cek_ada->first()->id)->update($insPel);
                    }else{
                        Pelaksanaan::create($insPel);
                    }

                Rencana::where('id',$cek_rencana->id)->update(['sts'=>2]);
                Serti_list::where('id',$l->id)->update(['sts'=>2]);

                Serti::where('id', $serti->id)->update(['sts'=>1]);
                
                $id_pel = Pelaksanaan::where('rencana_id', $cek_rencana->id)->where('asn_id', $cek_rencana->asn_id)
                ->where('diklat_id', $cek_rencana->diklat_id)->first();
                $nm_file = $id_pel->id.'_serti.pdf';
                Pelaksanaan::where('id',$id_pel->id)->update(['nm_file'=>$nm_file]);

                $sumber = storage_path('app/public/sertifikat/'.$l->nm_file);
                $fl = file_get_contents($sumber);
                Storage::put('public/sertifikat/'.$nm_file, $fl);
                $jlh++;
            }
        }
        return back()->with('success', $jlh. ' data telah dihubungkan..');
    }
    
    public function terbit(Serti $serti, Request $request)
    {
        set_time_limit(0);
        $template = Template::find($request->template)->first();
        $no =explode('/', $serti->nomor);
        foreach($serti->serti_list as $s){   
            if($s->sts==2){ 
                $sts = 2;
            }else{
                $sts = 1;
            }
                $nomor = $no[0].'/'.$s->no_urut.'/'.$no[2].'/'.$no[3].'/'.$no[4].'/'.$no[5].'/'.$no[6];
                $nm_file = $s->id.'_'.$s->nip.".pdf";

                $qrcode = md5($serti->id.'-'.$s->id.'-'.$s->nip);
                
                $qrgenereate = QrCode::format('svg')->size(150)->generate($qrcode);

                $update = [
                    'qr_code' => $qrcode,
                    'nomor' => $nomor,
                    'nm_file' => $nm_file,
                    'sts' => $sts,
                ];
                
                Serti_list::where('id', $s->id)->update($update);

                $path = public_path('img/bg-serti/'.$template->nm_file);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $cont = file_get_contents($path);
                $bg = 'data:image/'.$type.';base64,'.base64_encode($cont);
                
                $data = [
                    'title' => 'Sertifikat ',
                    'list' => Serti_list::where('id', $s->id)->first(),
                    'serti' => $serti,
                    'bg' => $bg,
                    'qrcode' => base64_encode($qrgenereate),
                ];

                $pdf = PDF::setOption(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadview('admin.serti_pdf', $data)->setPaper('a4', 'landscape');
                // return $pdf->stream();
                $content=  $pdf->download()->getOriginalContent();
                Storage::put('public/sertifikat/'.$nm_file, $content);
            
        }
        return response()->json(['message'=>'Sertifikat diterbitkan']);
        // return back()->with('success', 'Sertifikat telah diterbitkan..');
        
    }


    public function create(Request $request)
    {
        return view('admin.serti_list_create', [
            'title' => 'Import file peserta',
            'serti_id' => $request->serti_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        set_time_limit(0);
        $request->validate([
            'file' => 'required|mimes:xls|max:2048',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            if(Excel::import(new ListImport(), $request->file))
            return redirect('admin/serti/'.$request->serti_id)->with('success', 'Berhasil import data..');
        
        }
        return back()->with('error', 'File tidak sesuai.');
    
      
    }

    public function show(Serti_list $serti_list)
    {
        // dd($serti_list);
        $file_path = storage_path('app/public/sertifikat/'.$serti_list->nm_file);
        $file_name = $serti_list->nama.'.pdf';
    
        return response()->download($file_path, $file_name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serti_list $serti_list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Serti_list $serti_list)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serti_list $serti_list)
    {
        if($serti_list->sts==2)
            return back()->with('error', 'Gagal menghapus data. Data ini telah terhubung dengan laporan Pelaksanaan ASN');
        if(Serti_list::destroy($serti_list->id)){
            if(file_exists(storage_path('app/public/sertifikat/'.$serti_list->nm_file)))
                unlink(storage_path('app/public/sertifikat/'.$serti_list->nm_file));
                return back()->with('warning', 'Data telah dihapus..');
        }
        return back()->with('error', 'Gagal menghapus. File tidak ditemukan..');
    }

}
