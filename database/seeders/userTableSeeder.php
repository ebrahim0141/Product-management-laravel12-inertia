<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        User::insert([
            [
                'firstName'=>'Super', 
                'lastName'=>'Admin', 
                'email'=>'admin@gmail.com', 
                'mobile'=>'01929841231', 
                'otp'=>0, 
                'password'=>'$2y$12$uSu.SY1DfPxDpWohVnB8juT/tuvsouNEpVKAXUGPmfV4j0qrxJfIq'
            ]//123456
        ]);
    }
}
