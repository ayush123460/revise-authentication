<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuid = Str::uuid();

        DB::table('users')->insert([
            'uuid' => $uuid,
            'fname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('passw0rd'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('admins')->insert([
            'uuid' => $uuid,
            'empno' => '10001',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
