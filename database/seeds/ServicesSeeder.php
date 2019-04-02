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
        for ($i=0; $i < 11; $i++) {

            $newService = new Service;

            $servizi = ['aria condizionata', 'tv', 'finestre con vista', 'parcheggio gratuito incluso', 'phon', 'ferro da stiro', 'riscaldamento', 'wi-fi', 'lavatrice', 'cucina', 'ingresso privato'];


            $newService->service = $servizi[$i];

            $newService->save();

        }
    }
}
