<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        Post::create
        ([
            'title' => 'Post One',
            'body' => 'This is Post one',
            'user_id' => 1,
        ]);
        Post::create([
            'title' => 'Post two',
            'body' => 'This is Post two',
            'user_id' => 1,
            ]);
            Post::create([
                'title' => 'Hello Post Dapo',
                'body' => 'This is mine Dapo',
                'user_id' => 1,
                ]);
                Post::create([
                    'title' => 'Hello Post Oloruntola',
                    'body' => 'This is mine post',
                    'user_id' => 1,
                    ]);
    }
}
