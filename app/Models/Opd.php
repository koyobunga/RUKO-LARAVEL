<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function asn(){
        return $this->hasMany(Asn::class);
    }
    public function upt(){
        return $this->hasMany(Upt::class);
    }
    
}
