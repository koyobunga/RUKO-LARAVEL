<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekom extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['diklat','asn'];

    public function diklat(){
        return $this->belongsTo(Diklat::class);
    }
    public function asn(){
        return $this->belongsTo(Asn::class);
    }

}
