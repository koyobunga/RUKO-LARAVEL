<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Jadwal;
use App\Models\Jenis;
use App\Models\Pesan;
use App\Models\Rencana;
use Illuminate\Database\Schema\Grammars\RenameColumn;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AjadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.jadwal', [
            'title' => 'Data Jadwal Diklat',
            'jadwal' => Jadwal::orderby('id', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jadwal_create', [
            'title' => 'Input Jadwal Diklat',
            'diklat' => Diklat::orderby('nama', 'asc')->get(),
            'jenis' => Jenis::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'diklat_id' => 'required',
            'pelaksana' => 'required',
            'tempat' => 'required',
            'jenis' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',   
        ]);



        if(Jadwal::create($data)){
            $cek = Rencana::where('diklat_id', $request->diklat_id)->where('sts', 0)->get();
            $jadwal_id = Jadwal::orderby('id','desc')->first()->id;
            foreach ($cek as $c) {
                $data = [
                    'asn_id' => $c->asn_id,
                    'jadwal_id' => $jadwal_id,
                    'label' => 'jadwal',
                    'title' => 'Jadwal Diklat',
                    'isi' => 'Diklat yang sesuai dengan Rencana Kompetensi Anda telah dibuat..',
                ];
                Pesan::create($data);
            }
            return redirect('admin/jadwal')->with('success', 'Jadwal telah ditambahkan..');
        }
        return back()->with('error', 'Gagal menambahkan..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        return view('admin.jadwal_edit',[
            'title' => 'Edit Jadwal',
            'jadwal' => $jadwal,
            'diklat' => Diklat::orderby('nama', 'asc')->get(),
            'jenis' => Jenis::all(),
            'nama_diklat' => $jadwal->diklat->nama,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $data = $request->validate([
            'diklat_id' => 'required',
            'pelaksana' => 'required',
            'tempat' => 'required',
            'jenis' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',   
        ]);

        if(Jadwal::where('id',$jadwal->id)->update($data))
            return redirect('admin/jadwal')->with('warning', 'Perubahan telah disimpan..');
        return back()->with('error', 'Gagal menyimpan..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        if(Jadwal::destroy($jadwal->id))
            return back()->with('warning', 'Data telah dihapus...');
        return back()->with('danger', 'Gagal menghapus...');
    }
}
