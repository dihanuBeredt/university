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
        $name = [
            ['id' => 1, 'name' => "john", 'lname' => "doe", 'email' => "admin@roshdiyeh.ac.ir", 'phone' => '09123456789', 'username' => 'johndoe', 'password' => bcrypt('123456789') , 'created_at' => \Carbon\Carbon::now()->subWeeks(3)],
            ['id' => 2, 'name' => "jane", 'lname' => "doe", 'email' => "FaraSystem@gmail.com", 'phone' => '09876543210', 'username' => 'janedoe', 'password' => bcrypt('123456789'), 'created_at' => \Carbon\Carbon::now()->subMonths(15)]
        ];

        foreach ($name as $item) {
            DB::table('stepers')->insert($item);
        }
    }

}
