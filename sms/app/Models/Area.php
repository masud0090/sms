<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_name',
        'district_id',
        'division_id',
        'country_id',
    ];

    public function sub_area(){
        return $this->hasMany(Sub_area::class);
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
    }

    public function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }

}
