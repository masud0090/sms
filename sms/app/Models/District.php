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

    public function division(){
        return $this->belongsTo(Division::class);
    }
    public function area(){
        return $this->hasMany(Area::class);
    }
}
