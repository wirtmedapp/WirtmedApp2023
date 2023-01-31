<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'nit',
        'name',
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function specialties(){ 
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }
}
