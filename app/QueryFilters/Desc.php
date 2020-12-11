<?php


namespace App\QueryFilters;
use Closure;

class Desc extends Filter
{
    protected function applyFilter($builder)
    {
//        dd($builder->get()); - all threads
//            return $builder->orderBy('created_at', 'DESC');
            return $builder->orderBy('created_at', 'DESC');
    }
}
