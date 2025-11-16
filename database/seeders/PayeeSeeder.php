<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payee;

class PayeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */   

    public function run(): void
    {

        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Cecilia Dalusong']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Reziel Mae Oco']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Nelia Faburada']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'School Fund']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Parasat']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Converge']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Globe']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Phillhealth']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'GSIS']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Pag-ibig']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'LTO']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Water District']);
        Payee::create(['ref_no' => 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999), 'name' => 'Cepalco']);
    }
}
