<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentOffCoupon extends Model
{
    use HasFactory;

    protected $table = 'percent_off_coupons';

    public function discount($total)
    {
        return round(($this->percent_off / 100) * str_replace(' ', '', $total));
    }
}
