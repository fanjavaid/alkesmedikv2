<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        for ($i=0; $i < 20; $i++) { 
        	Category::create([
        		'category_name' => $faker->sentence($nbWords = 2),
        		'description' => $faker->text($maxNbChars = 100)
        	]);
        }
    }
}
