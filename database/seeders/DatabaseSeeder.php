<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        DB::table('users')->insert([
            'fullname' => 'Đỗ Trần Anh Sơn',
            'username' => 'asotaku205',
            'phone' => '0926395770',
            'email' => 'sonotaku555@gmail.com',
            'password' => bcrypt('123456'),
            ]);



        DB::table('admin')->insert([
            'admusername'=>'asotaku',
            'admemail'=> '123@123.com',
            'admpassword'=> bcrypt('123456'),
            'admphone'=>'12312321',
        ]);
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
