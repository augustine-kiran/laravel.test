<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Tags;
use App\Models\Image;
use App\Models\Blog;
use App\Models\TagAssigned;
use App\Models\Comments;

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

        User::create([
            'name' => 'Admin User',
            'username' => 'adminuser',
            'password' => '$2y$10$F9EjvuCzKIfxL/UCKl300er6dM3mofDKcgrSmVpZZ6vnNRL10/vzu',
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
            'user_id' => 1,
        ]);

        TagAssigned::create([
            'tag_id' => 1,
            'blog_id' => 1,
        ]);

        Comments::create([
            'blog_id' => 1,
            'user_id' => 1,
            'comment' => 'Test Comment',
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
