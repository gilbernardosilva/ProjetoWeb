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
        'name'  => 'cbeludo',
        'firstName' => 'Pauleta',
        'lastName' => 'Josefino',
        'email' => 'peido@gmail.com',
        'address' => 'Rua das Camélias',
        'password' => 'po1234',
        'image'=>'https://source.unsplash.com/random',
       ],
    ];
        	User::insert($user);
    }
}
