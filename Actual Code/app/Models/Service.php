<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cups',
        'name',
    ];
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function sedes(){
        return $this->belongsToMany(Sedes::class)->withTimestamps();
    }

    public function specialty(){
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

}
