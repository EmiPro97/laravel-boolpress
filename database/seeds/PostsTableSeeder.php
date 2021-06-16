<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            // New instance
            $new_post = new Post();

            // Populate
            $new_post->title = 'Post Title ' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias voluptatibus architecto aut inventore cumque esse! Quaerat quidem, mollitia fugit odit sunt corporis, consectetur hic, nemo et sapiente earum illum rerum.';

            // Save
            $new_post->save();
        }
    }
}
