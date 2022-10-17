<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $faker = Factory::create();
         foreach(range(1,10) as $item){
            Post::create([
                'title'=> $faker->name,
                'description' =>$faker->paragraph,
            ]);
         }
       
    }
}
