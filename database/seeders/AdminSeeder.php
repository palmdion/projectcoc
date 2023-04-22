<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User

        $user = User::create([
            'name'    => 'Administrator',
            'last_name'     => 'admin',
            'email'         =>  'admin@gmail.com',
            'mobile_number' =>  '0986258123',
            'password'      =>  Hash::make('12345678'),
            'role_id'       => 1 ,
            'status'       => 1 ,
            'province_id'    => 1 ,
        ]);
    }
}
