<?php

namespace App\Http\Controllers;

use App\Models\Opd;

use App\Models\Jenis;
use App\Models\Kaban;
use App\Models\Serti;
use App\Models\Diklat;
use App\Models\Serti_list;
use App\Models\Template;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SertiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serti = Serti::orderby('id','desc')->get();
        
        return view('admin.serti',[
            'title' => 'Data Sertifikat',
            'serti' => $serti,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diklat = Diklat::all();
        $opd = Opd::all();
        $jenis = Jenis::all();
        $kaban = Kaban::where('sts',1)->orderby('id','desc')->first();
        return view('admin.serti_create',[
            'title' => 'Buat Sertifikat',
            'diklat' => $diklat,
            'opd' => $opd,
            'jenis' => $jenis,
            'kaban' => $kaban,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'diklat_id' => 'required',
            'opd_id' => 'required',
            'jp' => 'required|integer',
            'label_bentuk' => 'required',
            'label_diklat' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'ttd_oleh' => 'required',
            'ttd_nama' => 'required',
            'ttd_nip' => 'required',
            'ttd_pangkat' => 'required',
            'bentuk' => 'required',
            'tempat' => 'required',
        ]);
        $nomor = Str::upper($request->no_1).'/'.$request->no_2.'/'.$request->no_3.'/'.$request->no_4.'/'.$request->no_5.'/'.$request->no_6.'/'.$request->no_7;
        $validate['nomor'] = $nomor;
        if(Serti::create($validate))
            return redirect('admin/serti')->with('success','Data telah disimpan...');
        return back()->with('error','Gagal menyimpan data...');
    }

    /**
     * Display the specified resource.
     */
    public function show(Serti $serti)
    {
        $list = Serti_list::where('serti_id', $serti->id)->orderby('no_urut', 'asc')->get();
        return view('admin.serti_list', [
            'title' => 'List Peserta Diklat',
            'serti' => $serti,
            'list' => $list,
            'template' => Template::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serti $serti)
    {
        $diklat = Diklat::all();
        $opd = Opd::all();
        $jenis = Jenis::all();
        $kaban = Kaban::where('sts',1)->orderby('id','desc')->first();
        return view('admin.serti_edit',[
            'title' => 'Buat Sertifikat',
            'diklat' => $diklat,
            'opd' => $opd,
            'jenis' => $jenis,
            'kaban' => $kaban,
            'serti' => $serti
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Serti $serti)
    {
        $validate = $request->validate([
            'diklat_id' => 'required',
            'opd_id' => 'required',
            'jp' => 'required|integer',
            'label_bentuk' => 'required',
            'label_diklat' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'ttd_oleh' => 'required',
            'ttd_nama' => 'required',
            'ttd_nip' => 'required',
            'ttd_pangkat' => 'required',
            'bentuk' => 'required',
            'tempat' => 'required',
        ]);
        $nomor = Str::upper($request->no_1).'/'.$request->no_2.'/'.$request->no_3.'/'.$request->no_4.'/'.$request->no_5.'/'.$request->no_6.'/'.$request->no_7;
        $validate['nomor'] = $nomor;
        if(Serti::find($serti->id)->update($validate))
            return redirect('admin/serti')->with('success','Perubahan telah disimpan...');
        return back()->with('error','Gagal menyimpan perubahan data...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serti $serti)
    {
        $cek = Serti::where('id', $serti->id)->where('sts', 0)->get();
        if($cek->count()>0){
            if(Serti::destroy($serti->id))
                return back()->with('warning', 'Data telah dihapus..');
            return back()->with('error', 'Gagal meghapus..');
        }
        return back()->with('warning', 'Tidak dapat menghapus, sertifikat telah diterbitkan..');
    }
}
