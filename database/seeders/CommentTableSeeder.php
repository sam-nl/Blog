<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()->count(200)->create();
    }
}
