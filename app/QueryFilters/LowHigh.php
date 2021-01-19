<?php


namespace App\QueryFilters;


class LowHigh extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('price');
    }
}
