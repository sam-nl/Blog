<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Post;
use \App\Models\Tag;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Post::all() as $post){
            $numbers = range(1, Tag::max('id'));
            shuffle($numbers);
            $tag_num = rand(1,5);
            for ($current = 0; $current<$tag_num; $current++){
                $post->tags()->attach($numbers[$current]);
            }
        }
    }
}