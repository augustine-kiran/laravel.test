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
        User::create([
            'name' => 'Admin User',
            'username' => 'adminuser',
            'password' => '$2y$10$F9EjvuCzKIfxL/UCKl300er6dM3mofDKcgrSmVpZZ6vnNRL10/vzu',
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
