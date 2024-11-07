<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Jenis;
use App\Models\Rekom;
use App\Models\Diklat;
use App\Models\Rencana;
use App\Models\Pelaksanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MpelaksanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rencana = Rencana::where('asn_id', Auth::user()->asn_id)->where('sts','<',2)->get();
        $pelaksanaan = Pelaksanaan::where('asn_id', Auth::user()->asn_id)->orderby('id','desc')->get();
        $jp_th = Pelaksanaan::where('asn_id', Auth::user()->asn_id)->whereyear('tgl_mulai', date('Y'))->get()->sum('jp');
        $html = view('mobile.pelaksanaan',[
            'title' => 'Laporan Pelaksanaan Diklat',
            'asn' => Asn::find(Auth::user()->asn_id),
            'pelaksanaan' => $pelaksanaan,
            'rencana' => $rencana,
            'jp_th' => $jp_th,
            'jp_all' => $pelaksanaan->sum('jp'),
        ])->render();

        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    
    public function download(Pelaksanaan $pelaksanaan)
    {
        $path = storage_path('app/public/sertifikat/'.$pelaksanaan->nm_file);
        $name = $pelaksanaan->asn->nama.'.pdf';
    
        return response()->download($path, $name);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = [
            'title' => 'Input Laporan Kompetensi',
            'asn' => Asn::find(Auth::user()->asn_id),
            'diklat' => Diklat::all(),
            'jenis' => Jenis::all(),
        ];
        if(isset($request->rencana)){
            $rencana = Rencana::find($request->rencana);
            $rekom = Rekom::where('rencana_id', $rencana->id)->first();
            $data ['rencana'] = $rencana;
            $data ['rekom'] = $rekom;
        }

        $html = view('mobile.pelaksanaan_create', $data)->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $create = $request->validate([
            'diklat_id' => 'required',
            'pelaksana' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'tempat' => 'required',
            'bentuk' => 'required',
            'jp' => 'required|integer',
            'no_serti' => 'required',
        ]);
        $create['asn_id'] = Auth::user()->asn_id;
        if(!empty($request->rencana_id)){
            $create['rencana_id'] = $request->rencana_id;
        }
        $msg = 0;
        if(Pelaksanaan::create($create)){
            if(!empty($request->rencana_id)){
                Rencana::find($request->rencana_id)->update(['sts'=>2]);
            }
            $msg =1;
        }
        return response()->json(['msg'=>$msg]);
    }


    public function unggah(Request $request){
        $file = $request->validate([
            'nm_file' => 'required|file|mimes:pdf|max:2048'
        ]);
        
        $typefile = '.'.$request->nm_file->extension();
        $namefile = $request->id.'_serti'.$typefile;

        // dd(storage_path());
        if($request->nm_file->move(storage_path('app/public/sertifikat'), $namefile)){
            Pelaksanaan::find($request->id)->update(['nm_file'=>$namefile]);
            return response()->json(['msg'=>1]);
        }
        return response()->json(['msg'=>0]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelaksanaan $pelaksanaan)
    {
        $html = view('mobile.pelaksanaan_file',[
            'title' => 'Upload File Sertifikat',
            'asn' => Asn::find(Auth::user()->asn_id),
            'pelaksanaan' => $pelaksanaan
        ])->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelaksanaan $pelaksanaan)
    {
        $data = [
            'title' => 'Edit Laporan Kompetensi',
            'asn' => Asn::find(Auth::user()->asn_id),
            'diklat' => Diklat::all(),
            'jenis' => Jenis::all(),
            'laporan' => $pelaksanaan
        ];

        $html = view('mobile.pelaksanaan_edit', $data)->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelaksanaan $pelaksanaan)
    {
        $update = $request->validate([
            'rencana_id' => 'required',
            'diklat_id' => 'required',
            'pelaksana' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'tempat' => 'required',
            'bentuk' => 'required',
            'jp' => 'required|integer',
            'no_serti' => 'required',
        ]);

        if(Pelaksanaan::find($pelaksanaan->id)->update($update))
        return response()->json(['msg'=>1]);
        return response()->json(['msg'=>0]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelaksanaan $pelaksanaan)
    {
        $cek = Rencana::where('id', $pelaksanaan->rencana_id)->get();
        if($cek->count())
            Rencana::where('id', $pelaksanaan->rencana_id)->update(['sts'=>0]);
        
        if(Pelaksanaan::destroy($pelaksanaan->id)){
            if(file_exists(storage_path('app/public/sertifikat/'.$pelaksanaan->nm_file)) && !empty($pelaksanaan->nama_file))
                unlink(storage_path('app/public/sertifikat/'.$pelaksanaan->nm_file));
                return response()->json(['msg'=>1]);
        }
        return response()->json(['msg'=>0]);
    }
}