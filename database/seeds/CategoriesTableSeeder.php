<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['HTML', 'CSS', 'JAVASCRIPT', 'PHP', 'LARAVEL'];

        foreach ($categories as $category) {
            // New instance
            $new_category = new Category();

            // Population
            $new_category->name = $category;
            $new_category->slug = Str::slug($category, '-');

            // Save
            $new_category->save();
        }
    }
}
