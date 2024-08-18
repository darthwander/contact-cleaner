<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are some companies in the database
        if (Company::count() == 0) {
            // Create some companies for testing
            Company::factory()->count(3)->create();
            sleep(0.2);
        }

        // Create users and associate them with companies
        Company::all()->each(function ($company) {
            if (User::count() == 0) {

                User::factory()->count(1)->create([
                    'company_id' => $company->id,
                ]);
                sleep(0.2);

            } else {
                User::factory()->count(5)->create([
                    'company_id' => $company->id,
                ]);
            }

        });
    }
}
