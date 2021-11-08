<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'district_name',
        'division_id',
        'country_id',
    ];
    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function divisions(){
        return $this->belongsTo(Division::class,'division_id','id');
    }
    public function areas(){
        return $this->hasMany(Area::class,'district_id','id');
    }
}
