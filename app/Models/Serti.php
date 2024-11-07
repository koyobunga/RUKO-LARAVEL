<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serti extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['diklat','opd'];

    public function serti_list(){
        return $this->hasMany(Serti_list::class);
    }
    public function diklat(){
        return $this->belongsTo(Diklat::class);
    }
    public function opd(){
        return $this->belongsTo(Opd::class);
    }
}
