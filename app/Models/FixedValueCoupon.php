<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedValueCoupon extends Model
{
    use HasFactory;

    protected $table = 'fixed_value_coupons';

    public function discount($total)
    {
        return $this->value;
    }


}
