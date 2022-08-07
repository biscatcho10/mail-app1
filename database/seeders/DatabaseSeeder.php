<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Email;
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
        if (User::all()->count() == 0)
            $this->call(UserSeeder::class);
        Category::factory()->count(10)->create();
        Email::factory()->count(10)->create();

    }
}
