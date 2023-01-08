<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Platform;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    /*
  User::factory(10)->create();
    Category::factory(10)->create();
    Platform::factory(10)->create();
    */

    /*
    Game::factory(10)->create();

    */
    Product::factory(10)->create();
  }
}
