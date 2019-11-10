<?php

use App\Company;
use App\Employee;
use Illuminate\Database\Seeder;

/**
 * Class CompanyTableSeeder
 */
class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class, 50)->create()->each(
        /**
         * @param $company
         */ function ($company) {
            $company->employee()->save(factory(Employee::class)->make());
        });
    }
}
