<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            HumanResourcesSeeder::class, // Isi Dept, Role, Employee, Task, Payroll
            PressenceSeeder::class,      // Isi Absensi 12 bulan
        ]);

        // Buat User untuk Login Admin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
