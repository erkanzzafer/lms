<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'German', 'tr'=> 'Almanca'],
            ['en'=> 'Sciences', 'tr'=> 'Fen'],
            ['en'=> 'Computer', 'tr'=> 'Bilgisayar'],
            ['en'=> 'English', 'tr'=> 'İngilizce'],
        ];
        foreach ($specializations as $S) {
            Specialization::create(['name' => $S]);
        }
    }
}
