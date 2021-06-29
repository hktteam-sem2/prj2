<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();


        $admin = Admin::create([
            'admin_name' => 'thienadmin',
            'admin_email' => 'thien@admin.com',
            'admin_phone' => '0990990000',
            'admin_password' => '123456'
        ]);
        $author = Admin::create([
            'admin_name' => 'thienauthor',
            'admin_email' => 'thienauthor@gmail.com',
            'admin_phone' => '0990990000',
            'admin_password' => '123456'
        ]);



        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);

    }
}
