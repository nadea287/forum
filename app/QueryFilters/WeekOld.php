<?php


namespace App\QueryFilters;
use Closure;
use Illuminate\Support\Carbon;

class WeekOld extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->whereDate('created_at', '=', Carbon::today()->subWeek(1));
    }
}
