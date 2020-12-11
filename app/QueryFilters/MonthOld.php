<?php


namespace App\QueryFilters;


use Illuminate\Support\Carbon;

class MonthOld extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->whereDate('created_at', '=', Carbon::today()->subMonth(1));
    }
}
