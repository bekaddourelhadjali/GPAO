<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::insert( "insert into users (\"username\",\"password\",\"role\",\"created_at\",\"updated_at\") 
values ('admin','".\Illuminate\Support\Facades\Hash::make('12345678')
            ."','Admin','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')");
    }
}
