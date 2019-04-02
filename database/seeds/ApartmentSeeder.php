<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;
use App\Service;



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


            $newApartment->description = randomElement($array = array ('a','b','c'));

            // $newApartment->description = $faker->sentence(4);
            // $newApartment->rooms_number = $faker->numberBetween($min = 1, $max = 50);
            // $newApartment->beds_number = $faker->numberBetween($min = 1, $max = 50);
            // $newApartment->baths_number = $faker->numberBetween($min = 1, $max = 50);
            // $newApartment->surface = $faker->numberBetween($min = 0, $max = 50);
            // $newApartment->address = $faker->city;
            // $newApartment->lat = $faker->latitude($min = -90, $max = 90) ;
            // $newApartment->lng = $faker->longitude($min = -180, $max = 180);
            // $newApartment->image = $faker->imageUrl($width = 640, $height = 480, 'nature');
            // $newApartment->price = $faker->numberBetween($min = 20, $max = 100);


            $newApartment->user_id = $faker->numberBetween($min = 1, $max = 10);

            // $services = [];
            // for ($i=1; $i < 5; $i++) {
                // $servizio = Service::inRandomOrder()->first();
                // $services[] = $servizio['id'];
            // }
            // dd($services);
            $newApartment->save();

            // $newApartment->services()->sync($services);

        }
    }
}
