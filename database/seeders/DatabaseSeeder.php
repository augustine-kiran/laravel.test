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
            'name' => "Example Category",
        ]);

        Author::create([
            'username' => 'Example Author',
        ]);

        Tags::create([
            'name' => 'Example Tag',
        ]);

        Image::create([
            'path' => 'images/1ZpNTxKNXWJBijFmsLGYpgzvODbCikCHNiYvIznM.jpg',
        ]);

        Blog::create([
            'title' => 'Example Title',
            'content' => 'Example Content',
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
