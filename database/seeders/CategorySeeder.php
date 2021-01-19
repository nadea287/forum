<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
           ['name' => 'Laptops', 'slug' => 'laptops', 'created_at' => $now, 'updated_at' => $now],
           ['name' => 'descktop', 'slug' => 'descktop', 'created_at' => $now, 'updated_at' => $now],
           ['name' => 'mobile phones', 'slug' => 'mobile phones', 'created_at' => $now, 'updated_at' => $now],
           ['name' => 'tablets', 'slug' => 'tablets', 'created_at' => $now, 'updated_at' => $now],
           ['name' => 'tv', 'slug' => 'tv', 'created_at' => $now, 'updated_at' => $now],
           ['name' => 'digital cameras', 'slug' => 'digital cameras', 'created_at' => $now, 'updated_at' => $now],
           ['name' => 'appliances', 'slug' => 'appliances', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
