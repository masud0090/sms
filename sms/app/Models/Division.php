<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = [
        'division_name',
        'country_id',
];
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function district(){
        return $this->hasMany(District::class);
    }
}
