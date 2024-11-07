<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akd extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $with = ['kategori','isian','keljab'];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    public function isian(){
        return $this->belongsTo(Isian::class);
    }
    public function keljab(){
        return $this->belongsTo(Keljab::class);
    }
}
