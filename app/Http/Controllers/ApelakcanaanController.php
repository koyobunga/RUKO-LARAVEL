<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Pelaksanaan;
use App\Models\Rencana;
use Illuminate\Http\Request;

class ApelakcanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if($request->search){
            $asn = Asn::where('nama','like','%'.$search.'%')->paginate(10)->withQueryString();
        }else{
            $asn = Asn::paginate(10)->withQueryString();
        }
        
        return view('admin.pelaksanaan',[
            'title' => 'Laporan Pelaksaaan Komeptensi',
            'asn' => $asn,
            'search' => $search,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asn $asn)
    {
        return view('admin.pelaksanaan_show',[
            'title' => 'Rencana Kompetensi',
            'asn' => $asn,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelaksanaan $pelaksanaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelaksanaan $pelaksanaan)
    {
        //
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
            if(file_exists(storage_path('app/public/sertifikat/'.$pelaksanaan->nm_file)) && !empty($pelaksanaan->nm_file))
                unlink(storage_path('app/public/sertifikat/'.$pelaksanaan->nm_file));
            return back()->with('error', 'Data telah dihapus.');
        }
        return back()->with('error', 'Gagal menghapus data.');
    }

    
    public function download(Pelaksanaan $pelaksanaan)
    {
        $file_path = storage_path('app/public/sertifikat/'.$pelaksanaan->nm_file);
        $file_name = $pelaksanaan->asn->nama.'.pdf';
    
        return response()->download($file_path, $file_name);
    }
}
