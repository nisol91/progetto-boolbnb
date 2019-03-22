<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;



class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $newApartment = new Apartment;


            // $randomCategory = Category::inRandomOrder()->first();

            $newApartment->description = $faker->sentence(4);
            $newApartment->rooms_number = $faker->numberBetween($min = 0, $max = 50);
            $newApartment->beds_number = $faker->numberBetween($min = 0, $max = 50);
            $newApartment->baths_number = $faker->numberBetween($min = 0, $max = 50);
            $newApartment->surface = $faker->numberBetween($min = 0, $max = 50);
            $newApartment->address = $faker->sentence(4);
            // $newApartment->image = $faker->sentence(4);



            // $newApartment->user_id = $randomCategory->id;

            $newApartment->save();




        }
    }
}
