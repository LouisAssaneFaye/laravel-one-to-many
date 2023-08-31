<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     
     */
    public function run(Faker $faker):void
    {
        $categoryIds= Category::all()->pluck('id');
        $usersIds = User::all()->pluck('id');

        for ($i=0; $i<100; $i++){
            $newPost = new Post();
            $newPost->category_id=$faker->randomElement($categories);
            $newPost->user_id=($faker->randomElement($userIds));
            $newpost->title=ucfirst($faker->unique()->words(4,true));
            $newpost->content=$faker->paragraph(10, true);
            $newpost->slug= $faker->slug();
            $newpost->image=$faker->imageUrl(480, 360, 'post', true, 'posts', true, 'png');
            $newpost->save();
            $newPost->slug = Str::of("$newPost->id" . $newPost->title)->slug('-');
            $newpost->save();
        }
    }
}
