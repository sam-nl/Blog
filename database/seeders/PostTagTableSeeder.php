<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        foreach (\App\Models\Post::all() as $post){
            $numbers = range(1, \App\Models\Tag::max('id'));
            shuffle($numbers);
            $tag_num = rand(1,5);
            for ($current = 0; $current<$tag_num; $current++){
                $post->tags()->attach($numbers[$current]);
            }

        }
        //dd($post->tags());
        /*
        $post = \App\Models\Post::find(1);
        $post = \App\Models\Tag::inRandomOrder()->pluck('id');
        $test->tags()->attach($tags);
        /*
        foreach (\App\Models\Post::all() as $post){
            $tags = \App\Models\Tag::inRandomOrder()->take(rand(0,5))->pluck('id');
            DB::table('post_tag')->add();
        }*/
    }
}
