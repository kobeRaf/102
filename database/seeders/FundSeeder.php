<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fund;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
 

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'GF', 
                        'name' => 'General Fund']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'TF', 'name' => 
                        'Trust Fund']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Alubijid']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Balingasag']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Claveria']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Initao']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Magsaysay']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Gingoog']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999),
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Talisayan']);

        Fund::create(['ref_no' => 'FUND-' . date('Ymd') . '-' . rand(10000, 99999), 
                        'code' => 'MOPH', 
                        'name' => 'MOPH - Manticao']);
    }
}
