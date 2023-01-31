<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyCedula;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\QuestionCreated;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'tdocumento',
        'password',
        'cedula',
        'fnacimiento',
        'sexo',
        'dpto',
        'municipio',
        'address',
        'phone',
        'phone2',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    public function specialties(){
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

    public function sedes(){
        return $this->belongsToMany(Sedes::class)->withTimestamps();
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cedula_verified_at' => 'datetime',
    ];
    
    public function scopeAdmin($query){
        return $query->where('role', 'admin');
    }



    public function asDoctorAppointments(){
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
    public function attendedAppointments(){
        return $this->asDoctorAppointments()->where('status', 'Atendida');
    }
    public function cancellAppointments(){
        return $this->asDoctorAppointments()->where('status', 'Cancelada');
    }

    public function asPatientAppointments(){
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    
}
