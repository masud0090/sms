<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_area extends Model
{
    use HasFactory;
    protected $fillable = [
        'Sub_area_name',
        'area_id',
        'district_id',
        'division_id',
        'country_id',

    ];

    public function roads(){
        return $this->hasMany(Road::class);
    }


    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function divisions(){
        return $this->belongsTo(Division::class,'division_id','id');
    }

    public function districts(){
        return $this->belongsTo(District::class,'district_id','id');
    }
    public function areas(){
        return $this->belongsTo(Area::class,'area_id','id');
    }
}

