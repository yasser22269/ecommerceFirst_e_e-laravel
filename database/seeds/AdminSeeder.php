<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'  => 'Yasser',
            'email'  => 'admin@admin.com',
            'password'  => bcrypt('12345678'),

       ]);
    }
}
