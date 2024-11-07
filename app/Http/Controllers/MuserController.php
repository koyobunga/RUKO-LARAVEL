<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class MuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if(Auth::check()){
            if(Auth::user()->level=='asn')
                return redirect('mobile/asn')->with('info', 'Telah login');
        }
        return view('mobile',[
            'title' => 'RUKO Mobile'
        ]);
      
    }

    public function offline(){
        $html = view('mobile.offline',[
            'asn' => Asn::find(Auth::user()->asn_id),
        ])->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    public function logout()
    {
        
        Session::flush();
        Auth::logout();        
        return redirect('mobile/login')->with('info','Log out');
    }

    public function auth(Request $request)
    {
        
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $validate['sts'] = '1';
        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            if(Auth::user()->level == 'asn'){
                return redirect('mobile/asn')->with('success','Login berhasil');
            }
            return back()->with('error','Login gagal');
        }
        return back()->with('error','Login gagal');
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
