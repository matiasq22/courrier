<?php

use App\User;
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
        $user = new User();

        $user->name  =  "Matias";
        $user->email = "mati@mati.com";
        $user->password = bcrypt('123');
        $user->save();
    }
}
