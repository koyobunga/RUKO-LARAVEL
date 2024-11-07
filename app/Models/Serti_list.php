<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serti_list extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['serti','opd','diklat'];

    public function serti(){
        return $this->belongsTo(Serti::class);
    }
    public function opd(){
        return $this->belongsTo(Opd::class);
    }
    public function diklat(){
        return $this->belongsTo(Diklat::class);
    }
    

}
