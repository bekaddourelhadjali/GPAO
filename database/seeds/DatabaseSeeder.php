<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefautsSeeder::class);
        $this->call(OperationssSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
