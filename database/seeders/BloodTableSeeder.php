<?php

namespace Database\Seeders;

use App\Models\Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bgs = ['0-', '0+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach ($bgs as $bg) {
            Blood::create(['name' => $bg]);
        }
    }
}
