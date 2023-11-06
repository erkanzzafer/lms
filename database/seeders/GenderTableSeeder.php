<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('genders')->delete();

        $genders = [
            ['en'=> 'Male', 'tr'=> 'Erkek'],
            ['en'=> 'Female', 'tr'=> 'Kadın'],

        ];
        foreach ($genders as $ge) {
            Gender::create(['name' => $ge]);
        }
    }
}
