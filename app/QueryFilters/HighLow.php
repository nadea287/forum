<?php


namespace App\QueryFilters;


class HighLow extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->orderBy('price', 'DESC');
    }
}
