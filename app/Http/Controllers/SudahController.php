<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Sudah;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSudahRequest;
use App\Http\Requests\UpdateSudahRequest;
use App\Models\Diklat;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;

class SudahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asn = Asn::find(Auth::user()->asn_id);
        // $sudah = Sudah::where('asn_id', $asn->id)->get();
        $diklat = Diklat::all();
        return view('asn.sudah',[
            'title' => 'Kompetensi Telah Diikuti',
            'asn' => $asn,
            'diklat' => $diklat,
        ]);
    }

    public function add(Request $request)
    {
        if(Sudah::where('diklat_id', $request->id)->where('asn_id', Auth::user()->asn_id)->first()){
            return response()->json(['message' => 4]);
        }
        $data = [
            'asn_id' => Auth::user()->asn_id,
            'diklat_id' => $request->id,
        ];
        if(Sudah::create($data)){
            return response()->json(['message' => 1]);
        }
        return response()->json(['message' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getdata(Request $request)
    {
     
        $data = Sudah::where('asn_id', Auth::user()->asn_id)->orderby('id','desc')->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSudahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sudah $sudah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sudah $sudah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSudahRequest $request, Sudah $sudah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(Sudah::destroy($request->id))
            return response()->json(['message' => 1]);
        return response()->json(['message' => 0]);

    }
}
