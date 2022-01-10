<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create(['name' => 'Germán Cascales',
                                 'email' => 'germancascales@uma.es',
                                 'password' => '$2y$10$K1HVtrZOdZcM6JyHHyCLfOaXkACqdoOZjIzwdfQ6xH24PznxTIoIq', // 12345678
                                 'current_team_id' => null]);
        
        Category::factory()->create(['name' => 'Categoría 1']);
        Category::factory()->create(['name' => 'Categoría 2']);
        Category::factory()->create(['name' => 'Categoría 3']);

        Post::factory(10)->create();
    }
}
