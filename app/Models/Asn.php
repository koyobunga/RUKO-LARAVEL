<?php

namespace App\Models;

use App\Models\Opd;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asn extends Model
{
    use HasFactory;
    protected $with = ['opd','keljab', 'user'];
    protected $guarded = ['id'];


    public function opd(){
        return $this->belongsTo(Opd::class);
    }
    
    public function keljab(){
        return $this->belongsTo(Keljab::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kategori(){
        return $this->hasMany(Kategori::class);
    }
    
    public function rencana(){
        return $this->hasMany(Rencana::class);
    }
    
    public function pelaksanaan(){
        return $this->hasMany(Pelaksanaan::class);
    }

    public function pesan(){
        return $this->hasMany(Pesan::class);
    }
}
