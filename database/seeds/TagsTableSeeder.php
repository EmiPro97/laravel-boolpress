<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Front End', 'Back End', 'Design', 'UX', 'Laravel'];

        foreach ($tags as $tag) {
            // New instance
            $new_tag = new Tag();

            // Population
            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($tag, '-');

            // Save
            $new_tag->save();
        }
    }
}
