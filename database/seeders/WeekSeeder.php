<?php

namespace Database\Seeders;

use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    public function run(): void
    {
        $start = Carbon::now()->startOfWeek();
        $end = $start->copy()->addWeeks(52);

        while ($start < $end) {
            Week::updateOrCreate(
                [
                    'year' => $start->year,
                    'week_number' => $start->weekOfYear,
                ],
                [
                    'week_starts_at' => $start->copy()->startOfWeek(),
                    'week_ends_at' => $start->copy()->endOfWeek(),
                ]
            );
            $start->addWeek();
        }
    }
}
