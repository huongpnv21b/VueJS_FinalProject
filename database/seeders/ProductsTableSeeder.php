<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;
use DB;
use Faker\Generator as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0;$i<5;$i++)
        {
       DB::table('products')->insert(
           [
        'name'=>'Iphone 12',
        'price'=>$faker->numberBetween(100000,500000),
        'units'=>$faker->numberBetween(1,400),
        'description'=>'Hoàn hảo từ màu sắc, thiết kế cho đến chất son,  tạo nên “phép nhiệm màu” mà mọi bạn gái đã mong chờ, đợi ngóng suốt bao lâu nay. Son đỏ đất, khiến bao nàng ngây ngất.',
        'image'=> '/images/ip.jpg',
        'category_id'=>1,
        'created_at' => Carbon::create('2021', '01', '25'),
        'updated_at' => null,   

           ]
           );
        }
        for($i=0;$i<5;$i++)
        {
       DB::table('products')->insert(
           [
        'name'=>'Oppo 12',
        'price'=>$faker->numberBetween(100000,500000),
        'units'=>$faker->numberBetween(1,400),
        'description'=>'Hoàn hảo từ màu sắc, thiết kế cho đến chất son,  tạo nên “phép nhiệm màu” mà mọi bạn gái đã mong chờ, đợi ngóng suốt bao lâu nay. Son đỏ đất, khiến bao nàng ngây ngất.',
        'image'=> '/images/op.png',
        'category_id'=>2,
        'created_at' => Carbon::create('2021', '01', '25'),
        'updated_at' => null,

           ]
           );
        }
        for($i=0;$i<5;$i++)
        {
       DB::table('products')->insert(
           [
        'name'=>'Samsung 12',
        'price'=>$faker->numberBetween(100000,500000),
        'units'=>$faker->numberBetween(1,400),
        'description'=>'Hoàn hảo từ màu sắc, thiết kế cho đến chất son,  tạo nên “phép nhiệm màu” mà mọi bạn gái đã mong chờ, đợi ngóng suốt bao lâu nay. Son đỏ đất, khiến bao nàng ngây ngất.',
        'image'=> '/images/sam.png',
        'category_id'=>3,
        'created_at' => Carbon::create('2021', '01', '25'),
        'updated_at' => null,

           ]
           );
        }
    }
}
