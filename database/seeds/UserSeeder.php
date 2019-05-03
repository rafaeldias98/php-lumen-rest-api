<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->delete();
        
        User::create([
            'name'  => 'John Doe',
            'age'   => 20,
            'email' => 'john.doe@gmail.com',
        ]);

        User::create([
            'name'  => 'Foo Bar',
            'age'   => 20,
            'email' => 'foo.bar@gmail.com',
        ]);

        User::create([
            'name'  => 'Lorem Ipsum',
            'age'   => 20,
            'email' => 'lorem.ipsum@gmail.com',
        ]);
    }
}
