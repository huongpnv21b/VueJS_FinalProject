<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name'=>'Iphone','image'=>'/company/Apple.jpg',],
              ['name'=>'Oppo','image'=>'/company/Oppo.jpg',],
              ['name'=>'Samsung','image'=>'/company/Samsung.jpg',],
              ['name'=>'Coolpad','image'=>'/company/Coolpad.png',],
              ['name'=>'HTC','image'=>'/company/HTC.jpg',],
              ['name'=>'Huawei','image'=>'/company/Huawei.jpg',],
              ['name'=>'Itel','image'=>'/company/Itel.jpg',],
              ['name'=>'Mobell','image'=>'/company/Mobell.jpg',],
              ['name'=>'Mobiistar','image'=>'/company/Mobiistar.jpg',],
              ['name'=>'Motorola','image'=>'/company/Motorola.jpg',],
              ['name'=>'Philips','image'=>'/company/Philips.jpg',],
              ['name'=>'Realme','image'=>'/company/Realme.png',],
              ['name'=>'Xiaomi','image'=>'/company/Xiaomi.png',],
              ['name'=>'ViVo','image'=>'/company/Vivo.jpg',],
              ['name'=>'Nokia','image'=>'/company/Nokia.jpg',]
           ] );
    }
}
