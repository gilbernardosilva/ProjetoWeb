<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user=[
        [
        'name'  => 'cucabeludo',
        'firstName' => 'Pauleta',
        'lastName' => 'Josefino',
        'email' => 'peido@gmail.com',
        'address' => 'Rua das Camélias',
        'password' => 'peido1234',
        'cart_id' => '3',
       ],
    ];
        	User::insert($user);
    }
}
