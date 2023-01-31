<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function entities(){
        return $this->belongsToMany(Entity::class)->withTimestamps();
    }

    public function service(){
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
}
