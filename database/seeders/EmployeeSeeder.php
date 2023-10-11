<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder {
    public function run() {
        Employee::factory()
            ->count(5)
            ->create();
    }
}
