<?php

namespace Database\Factories;

use App\Models\Pressence;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PressenceFactory extends Factory
{
    public function definition(): array
    {
        // Kita biarkan kosong atau default, karena kita akan menggunakan loop di Seeder
        return [];
    }

    /**
     * State untuk mengatur jam absen yang realistis
     */
    public function onDate($employeeId, $date)
    {
        $dateObj = Carbon::parse($date);

        // Jam masuk acak antara 07:30 - 08:30
        $checkIn = (clone $dateObj)->setTime(rand(7, 8), rand(0, 59), 0);

        // Jam keluar acak antara 17:00 - 18:00
        $checkOut = (clone $dateObj)->setTime(rand(17, 18), rand(0, 59), 0);

        return $this->state(fn(array $attributes) => [
            'employee_id' => $employeeId,
            'date'        => $dateObj->format('Y-m-d'),
            'check_in'    => $checkIn,
            'check_out'   => $checkOut,
            'status'      => 'present',
        ]);
    }
}
