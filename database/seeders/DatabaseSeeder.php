<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Team;
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

        Team::factory()->create(['name' => 'Administradores',
                                 'user_id' => 1,
                                 'personal_team' => false]);

        User::factory()->create(['name' => 'Germán Cascales',
                                 'email' => 'germancascales@uma.es',
                                 'password' => '$2y$10$K1HVtrZOdZcM6JyHHyCLfOaXkACqdoOZjIzwdfQ6xH24PznxTIoIq', // 12345678
                                 'current_team_id' => 1]);
        
        Category::factory()->create(['name' => 'Categoría 1']);
        Category::factory()->create(['name' => 'Categoría 2']);
        Category::factory()->create(['name' => 'Categoría 3']);

        PostType::factory()->create(['name' => 'Mensaje', 'style' => 'bg-blue text-white']);
        PostType::factory()->create(['name' => 'Pregunta', 'style' => 'bg-yellow']);
        PostType::factory()->create(['name' => 'Sugerencia', 'style' => 'bg-green text-white']);

        Post::factory(15)->create();
    }
}
