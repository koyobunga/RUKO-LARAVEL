<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rencana extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['asn','diklat'];

    public function asn(){
        return $this->belongsTo(Asn::class);
    }

    public function diklat(){
        return $this->belongsTo(Diklat::class);
    }


}
