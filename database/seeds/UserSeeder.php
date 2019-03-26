<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {

            $newUser = new User;

            $newUser->name = $faker->firstName;
            $newUser->lastname = $faker->lastName;
            $newUser->date_of_birth = $faker->date($format = 'Y-m-d', $max = 'now');
            $newUser->email = $faker->email;
            $newUser->password = $faker->password;
            
            $newUser->save();

        }
    }
}


