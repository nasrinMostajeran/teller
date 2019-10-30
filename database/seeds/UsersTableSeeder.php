<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'    => 'Nasrin',
            'last_name'    => 'Mostajeran',
            'email'    => 'nasrin.mostajeran@ttrus.com',
            'card_number'    => '1034982',
            'password'   =>  Hash::make('12345')
        ]);

        User::create([
            'first_name'    => 'Alex',
            'last_name'    => 'Bowling',
            'email'    => 'bowling@ttrus.com',
            'card_number'    => '1034123',
            'password'   =>  Hash::make('12345')
        ]);

        User::create([
            'first_name'    => 'Lindsey',
            'last_name'    => 'Winchester',
            'email'    => 'lwinchester@ttrus.com',
            'card_number'    => '1034345',
            'password'   =>  Hash::make('12345')
        ]);
    }
}
