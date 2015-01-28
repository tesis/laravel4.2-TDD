<?php // database/seeds/UserTableSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * seed user table
 * uncomment DatabaseSeeder on DatabaseSeeder $this->call('UserTableSeeder');
 *
 * if you are calling Artisan::call('migrate:refresh'), records are deleted
 * you need to call $this->seed();
 *
 * from command line:
 * uncomment DB::table('users')->delete();
 * run php artisan db:seed (sure - after migrating)
 *
 * included on tests/models/UserTest.php
 * just need to uncomment it when needed
 *
 * don't forget to migrate CreatePasswordResetsTable
 * if does not exist
 *
 */
class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->delete();
        //insert some dummy records
        $password = '$2y$10$l.6/2a6DgYgr21.HFka9a.ljZSOZbwDa.s4SR//qSz6v60kP.E9XO';
        //password: 111111

        $data = array(
            array('name'=>'Admin','email'=>'tereza.simcic@gmail.com','password'=>$password),
            array('name'=>'Tesis','email'=>'tesis@test.si','password'=>$password),
            array('name'=>'Tesi','email'=>'tesi@test.si','password'=>$password),
            array('name'=>'Tereza','email'=>'tereza@test.si','password'=>$password),
        );
      DB::table('users')->insert($data);
    }

}
