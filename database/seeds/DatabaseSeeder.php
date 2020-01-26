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
        $users = [
            ['id' => 1, 'firstname' => "مدیر", 'lastname' => "کل", 'email' => "admin@roshdiyeh.ac.ir", 'password' => bcrypt('12345678'), 'level' => "admin", 'created_at' => Carbon::now()->subWeeks(3)],
            /*           ['id' => 2, 'firstname' => "مدیر", 'lastname' => "میانی", 'email' => "FaraSystem@gmail.com", 'password' => bcrypt('123456'), 'level' => "admin", 'created_at' => Carbon::now()->subMonths(15)],
                       ['id' => 3, 'firstname' => "سارا", 'lastname' => "صادقی", 'email' => "sadeghi@gmail.com", 'password' => bcrypt('123456'), 'level' => "user", 'created_at' => Carbon::now()->subMonths(5)],*/
        ];

        foreach ($users as $item) {
            DB::table('users')->insert($item);
        }
        $roles_users = [
            ['user_id' => 1, 'role_id' => 1],
        ];

        foreach ($roles_users as $role_user) {
            DB::table('role_user')->insert($role_user);
        }
    }
}
