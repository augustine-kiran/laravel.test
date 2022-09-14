<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Author;
use App\Models\Tags;
use App\Models\Image;
use App\Models\Blog;
use App\Models\TagAssigned;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => "example",
        ]);

        Author::create([
            'username' => 'example',
        ]);

        Tags::create([
            'name' => 'example',
        ]);

        Image::create([
            'path' => 'images/KFEoiUGVKiBmdortUWutvRs95RMkMAnDUxabFWjT.jpg',
        ]);

        Blog::create([
            'title' => 'Example title',
            'content' => 'Example content',
            'image_id' => 1,
            'category_id' => 1,
            'author_id' => 1,
        ]);

        TagAssigned::create([
            'tag_id' => 1,
            'blog_id' => 1,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
