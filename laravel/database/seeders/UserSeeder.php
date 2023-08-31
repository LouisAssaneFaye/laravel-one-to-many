<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i<15; $i++){
            $newUser=new User();
            $newUser->name=$faker->name();
            $newUser->email=$faker->email();
            $newUser->password=Hash::make
            ($faker->password());
            $newUser->save();
        }
        $newUser=new User();
        $newUser->name='ginetta';
        $newUser->email='laf96@outlook.it';
        $newUser->password=Hash::make('123456');
        $newUser->save();
    }
}
