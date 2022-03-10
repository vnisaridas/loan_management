<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
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
        $user = User::where('email','developer@email.com')->first();

        if(!$user) {

            DB::table('users')->insert([
                'name' => 'developer',
                'username' => 'developer',
                'email' => 'developer@email.com',
                'password' => bcrypt('Test@Tuna123#'),
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]);
        }
    }
}
