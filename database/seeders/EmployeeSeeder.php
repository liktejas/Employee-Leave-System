<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee')->insert([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'mobile'=>'9876543210',
            'password'=>'admin123',
            'department_id'=>1,
            'address'=>'India',
            'birthday'=>'2000-02-11',
            'role'=>1
        ]);
    }
}
