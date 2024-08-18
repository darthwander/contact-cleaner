<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reseller;

class ResellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Reseller::count() === 0) {
            Reseller::factory()->count(1)->create();
            sleep(0.2);
        }
        Reseller::factory()->count(4)->create();
    }
}
