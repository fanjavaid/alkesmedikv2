<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Setting;

class SettingSeeder extends Seeder
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
        Setting::create([
        	'site_title' => $faker->sentence($nbWords = 3),
        	'tagline' => $faker->sentence($nbWords = 10),
        	'email_address' => $faker->email(),
        	'site_banner' => ''
        ]);
    }
}
