<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_name',


    ];
    public function divisions(){
        return $this->hasMany(Division::class,'country_id','id');
    }

//    public function district(){
//        return $this->hasMany(District::class);
//    }
//    public function area(){
//        return $this->hasMany(Area::class);
//    }
}
