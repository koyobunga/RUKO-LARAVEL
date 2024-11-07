<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Serti_list;
use App\Imports\ListImport;
use PHPExcel_Reader_Excel5;
use App\Jobs\PesertaCSVData;
use Illuminate\Http\Request;
use Dotenv\Store\File\Reader;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreSerti_listRequest;
use App\Http\Requests\UpdateSerti_listRequest;

class SertiListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asn = Asn::find(Auth::user()->asn_id);
        $list = Serti_list::where('nip', $asn->nip)->where('sts',2)->get();
        return view('asn.serti',[
            'title' => 'Sertifikat',
            'asn' => $asn,
            'list' => $list,
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
      
    }
      
        
    

    /**
     * Display the specified resource.
     */
    public function show(Serti_list $serti_list)
    {
        $file_path = storage_path('app/public/sertifikat/'.$serti_list->nm_file);
        $file_name = $serti_list->serti->diklat->nama.'.pdf';
    
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
    public function update(UpdateSerti_listRequest $request, Serti_list $serti_list)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serti_list $serti_list)
    {
        //
    }
}
