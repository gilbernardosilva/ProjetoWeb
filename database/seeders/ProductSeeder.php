<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $products=[
        [
        'name'  => 'peido 3.0 5G',
        'type' => 'Josefino',
        'email' => 'peido@gmail.com',
        'address' => 'Rua das Camélias',
        'password' => 'peido1234',
        'cart_id' => '3',
       ],
    ];
        	Products::insert($products);
    }
}
