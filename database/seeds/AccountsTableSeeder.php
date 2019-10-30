<?php

use Illuminate\Database\Seeder;
use App\Account;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'user_id'    => '1',
            'type_id'    => '1',
            'balance'    => '38765.98',
        ]);
        Account::create([
            'user_id'    => '1',
            'type_id'    => '2',
            'balance'    => '8198765.76',
        ]);

        Account::create([
            'user_id'    => '2',
            'type_id'    => '1',
            'balance'    => '97654.12',
        ]);
        Account::create([
            'user_id'    => '2',
            'type_id'    => '2',
            'balance'    => '765487.55',
        ]);

        Account::create([
            'user_id'    => '3',
            'type_id'    => '1',
            'balance'    => '65438.88',
        ]);
        
    }
}
