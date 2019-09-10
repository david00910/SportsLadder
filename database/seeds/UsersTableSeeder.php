<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->truncate();
        DB::table('clubs')->insert([
            'first_name' => 'Jack', 'last_name' => 'Phelps',
            'email' => 'jackie@gmail.com', 'password' => 'dummypw',
            'gender' => 'Male', 'phone' => '+4581928571',
            'ranking' => 1, 'address_id' => 1,
            'is_admin' => 0
            ]);
    }
}
