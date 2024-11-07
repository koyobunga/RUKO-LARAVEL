<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belum extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['diklat'];

    public function diklat(){
        return $this->belongsTo(Diklat::class);
    }
}
