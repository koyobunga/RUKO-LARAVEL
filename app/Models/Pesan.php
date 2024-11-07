<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['asn','jadwal'];

    public function asn(){
        return $this->belongsTo(Asn::class);
    }
    
    public function jadwal(){
        return $this->belongsTo(Jadwal::class);
    }
}
