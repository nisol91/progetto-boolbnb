<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {

            $newMessage = new Message;

            $newMessage->name = $faker->firstName;
            $newMessage->email = $faker->email;
            $newMessage->body = $faker->text;

            $newMessage->apartment_id = $faker->numberBetween($min = 1, $max = 10);


            $newMessage->save();

        }
    }
}
