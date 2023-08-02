<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Brands;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
class Productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        foreach(range(1,100) as $value){
            Product::create([
              'name'=>$faker->randomElement(Brands::pluck('name')). 'watch',
              'price'=>$faker->numberBetween($min = 5000, $max = 100000),
              'sale_price' =>$faker->numberBetween($min = 500, $max = 4999),
              'color' =>$faker->randomElement(['Black','White','Red','Orange','Yellow']),
              'brand_id' =>$faker->randomElement(Brands::pluck('id')),
              'product_code'=>$faker->numerify('WEBP-###'),
              'gender'=>$faker->randomElement(['Male','Female']),
              'function' =>$faker->randomElement(Config::get('function')),
              'stock' =>$faker->randomDigit(),
              'description' =>$faker->text($maxNbChars = 200),
              'image' =>$faker->imageUrl($width = 640, $height = 480),
              'is_active' =>$faker->randomElement(['1','0']),
            ]);
        }
    }
}
