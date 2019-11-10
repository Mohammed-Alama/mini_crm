<?php

use App\Employee;
use Illuminate\Database\Seeder;

/**
 * Class EmployeeTableSeeder
 */
class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employee::class, 500)->create();
    }
}
