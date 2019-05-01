<?php

use Illuminate\Database\Seeder;

class AddAdminAccountSeeder extends Seeder {
    public function run() {
        \Illuminate\Support\Facades\DB::table('admins')->create([
                'email' => 'phpdevsami@gmail.com',
                'password' => \Illuminate\Support\Facades\Hash::make(123456)
            ]
        );
    }
}
