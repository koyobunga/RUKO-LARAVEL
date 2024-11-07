<?php

namespace App\Http\Controllers;

use App\Models\Teknis;
use App\Http\Requests\StoreTeknisRequest;
use App\Http\Requests\UpdateTeknisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeknisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Teknis::where('asn_id', Auth::user()->asn_id)->get();
        return response()->json($data);
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
        

        $validate = $request->validate([
            'tugas' => 'required',
            'uraian' => 'required',
            'kendala' => 'required',
        ]);
        $validate['asn_id'] = Auth::user()->asn_id;
     
        if(empty($request->id)){
            if(Teknis::create($validate)){
                return response()->json([
                    'message'=>'success',
                    'pesan'=>'Data telah ditambahkan..'
                ]);
            }
        }else{
            if(Teknis::where('id', $request->id)->update($validate)){
                return response()->json([
                    'message'=>'success',
                    'pesan'=>'Data telah diperbarui..'
                ]);
            }
        }
        return response()->json(['message'=>'error']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teknis $teknis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teknis $teknis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeknisRequest $request, Teknis $teknis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teknis $teknis)
    {
       
    }

    public function del(Request $request){
        if(Teknis::destroy($request->id)){
            return response()->json(['message'=>'success']);
        }
        return response()->json(['message'=>'error']);
    }
}
