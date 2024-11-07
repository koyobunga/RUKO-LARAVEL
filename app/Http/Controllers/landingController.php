<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use Illuminate\Http\Request;

class landingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->tahun){
            $tahun = $request->tahun;
        }else{
            $tahun = date('Y');
        }
        $grouprencana = Diklat::join('rencanas', 'diklats.id', '=', 'rencanas.diklat_id')->where('rencanas.tahun', date('Y'))->get();
        return view('landing',[
            'grouprencana' => $grouprencana,
            'tahun'=>$tahun
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
