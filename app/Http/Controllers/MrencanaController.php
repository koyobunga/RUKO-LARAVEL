<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Diklat;
use App\Models\Jadwal;
use App\Models\Rencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MrencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::wheredate('tgl_mulai', '>=', today())->get();
        $rencana = Rencana::where('asn_id', Auth::user()->asn_id)->orderby('id','desc')->get();
        $html = view('mobile.rencana',[
            'title' => 'Rencana Pengembangan Kompetensi',
            'asn' => Asn::find(Auth::user()->asn_id),
            'diklat' => Diklat::all(),
            'rencana' => $rencana,
            'jadwal' => $jadwal,
        ])->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');;
    }

    public function get(){
        $rencana = Rencana::where('asn_id', Auth::user()->asn_id)->orderby('id','desc')->get();
        return response()->json(['data'=>$rencana]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun' => 'required',
            'bentuk' => 'required',
            'jalur' => 'required',
            'diklat_id' => 'required',
        ]);
        $data['asn_id'] = Auth::user()->asn_id;
        
        $cek = Rencana::where('tahun', $request->tahun)->where('asn_id', Auth::user()->asn_id)->get();
        if($cek->count()>1)
            return response()->json([
                'body'=>'Maksimum 2 rencan per tahun',
                'msg' => 'info'
            ]);
            // return back()->with('info', 'Rencana '.$request->tahun.' melebihi batas maksimum..');

        if(Rencana::create($data))
            return response()->json([
                'body'=>'Telah disimpan',
                'msg' => 'success'
            ]);
            // return back()->with('success', 'Rencana Kompetensi telah disimpan..');
        return response()->json([
            'body'=>'Gagal menyimpan',
            'msg' => 'error'
            ]);
        // return back()->with('error', 'Gagal menyimpan..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rencana $rencana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rencana $rencana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rencana $rencana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rencana $rencana)
    {
        //
    }
}
