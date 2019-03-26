<?php

use Illuminate\Database\Seeder;
use App\Service;
use Faker\Generator as Faker;


class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {

            $newService = new Service;

            $newService->service = $faker->sentence(1);
            
            $newService->save();

        }
    }
}
