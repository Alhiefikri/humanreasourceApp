<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Pressence;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PressenceSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();
        $year = 2025; // Mengisi histori setahun penuh 2025

        foreach ($employees as $employee) {
            for ($month = 1; $month <= 12; $month++) {
                // Tiap bulan buat 15-20 hari absen acak
                $daysInMonth = rand(15, 20);
                for ($i = 0; $i < $daysInMonth; $i++) {
                    $date = Carbon::create($year, $month, rand(1, 28));

                    if (!$date->isWeekend()) {
                        Pressence::factory()->onDate($employee->id, $date)->create([
                            'status' => 'present'
                        ]);
                    }
                }
            }
        }
    }
}
