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

            $descrizioni = ['Appartamento con vista', 'Appartamento in centro storico', 'Appartamento in edificio moderno', 'Casa indipendente', 'Biocale in città', 'Appartamento', 'Appartamento rustico', 'Casa in campagna', 'Casa nel bosco', 'Casa in riva al mare', 'Villa isolata'];
            $citta = ['Milano', 'Parma', 'Torino', 'Trento', 'Bologna', 'Roma', 'Venezia', 'Firenze', 'Palermo', 'Aosta', 'Modena'];
            $prezzi = [10,20,30,40,50,60];


            $newApartment->description = $faker->randomElement($descrizioni);
            $newApartment->rooms_number = $faker->numberBetween($min = 1, $max = 10);
            $newApartment->beds_number = $faker->numberBetween($min = 1, $max = 10);
            $newApartment->baths_number = $faker->numberBetween($min = 1, $max = 5);
            $newApartment->surface = $faker->numberBetween($min = 0, $max = 20);
            $newApartment->address = $faker->randomElement($citta);
            $newApartment->lat = $faker->latitude($min = 40, $max = 45) ;
            $newApartment->lng = $faker->longitude($min = 7, $max = 15);
            $newApartment->image = $faker->imageUrl($width = 640, $height = 480, 'nature');
            $newApartment->price = $faker->randomElement($prezzi);

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
