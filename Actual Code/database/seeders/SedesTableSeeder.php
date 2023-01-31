<?php

namespace Database\Seeders;

use App\Models\Sedes;
use App\Models\User;
use Illuminate\Database\Seeder;

class SedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Sedes = [
            'Magangué',
            'Sincelejo',
            'Mompox'
        ];
        foreach ($sedes as $sedesName) {
            $sedes = Sedes::create([
                'name' => $sedesName
            ]);
            $sedes->users()->saveMany(
                User::factory(4)->state(['role' => 'doctor'])->make()
            );
        }
        User::find(3)->specialties()->save($sedes);
    }
}
