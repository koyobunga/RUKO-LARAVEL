<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['kategoridiklat'];

    public function kategoridiklat(){
        return $this->belongsTo(Kategoridiklat::class);
    }

    public function rencana(){
        return $this->hasMany(Rencana::class);
    }
}
