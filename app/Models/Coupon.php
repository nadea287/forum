<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function coupon()
    {
        return $this->morphTo();
    }

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        return $this->coupon->discount($total);
    }

//    public function discount($total)
//    {
//        if ($this->type == 'fixed') {
//            return $this->value;
//        } elseif ($this->type == 'percent') {
//            return round(($this->percent_off / 100) * str_replace(' ', '', $total));
//        } else {
//            return 0;
//        }
//    }
}
