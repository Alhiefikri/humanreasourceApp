<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Task;
use Illuminate\Database\Seeder;

class HumanResourcesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Departemen
        $depts = ['IT', 'HR', 'Marketing', 'Finance', 'Operations'];
        foreach ($depts as $name) {
            Department::create(['name' => $name, 'status' => 'active', 'description' => "Divisi $name"]);
        }

        // 2. Buat Roles
        $roles = ['Manager', 'Developer', 'Staff', 'HR Specialist', 'Accounting'];
        foreach ($roles as $title) {
            Role::create(['title' => $title, 'description' => "Role as $title"]);
        }

        // 3. Buat 15 Karyawan dan berikan Task serta Payroll
        Employee::factory()->count(15)->create()->each(function ($employee) {
            // Berikan 5 tugas (Task) secara acak
            for ($i = 1; $i <= 5; $i++) {
                Task::create([
                    'title' => 'Project Task ' . $i,
                    'description' => 'Selesaikan laporan modul ' . $i,
                    'assigned_to' => $employee->id,
                    'due_date' => now()->addDays(rand(1, 30)),
                    'status' => collect(['pending', 'in_progress', 'completed'])->random(),
                ]);
            }

            // Berikan Payroll
            Payroll::create([
                'employee_id' => $employee->id,
                'salary' => $employee->salary,
                'bonuses' => rand(500000, 2000000),
                'deductions' => rand(100000, 500000),
                'net_salary' => $employee->salary + 300000,
                'pay_date' => now(),
            ]);
        });
    }
}
