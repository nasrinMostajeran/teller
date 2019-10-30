<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Update user account balance 
     *
     */
    public function transaction($id_from, $id_to, $amount)
    {
        
        if($id_from==0)
        {
            $account = Account::find($id_to); // get user account 
            $balance=$account->balance; //get account balance
            $balance =  $balance + $amount; // calculate new balance
            $account->balance = $balance; // save new balance to account
            $account->save();
            return 'Deposit completed. Your new balance is $'.$balance; 
        }
        else if($id_to==0)
        {
            $account = Account::find($id_from); // get user account 
            $balance=$account->balance; //get account balance
            $balance =  $balance - $amount; // calculate new balance
            $account->balance = $balance; // save new balance to account
            $account->save();
            return 'Withdraw completed. Your new balance is $'.$balance;
        }
        else
        {
            $account = Account::find($id_from); // get user account 
            $balance=$account->balance; //get account balance
            $balance =  $balance - $amount; // calculate new balance
            $account->balance = $balance; // save new balance to account
            $account->save();

            $account_to = Account::find($id_to); // get user account 
            $balance_to=$account_to->balance; //get account balance
            $balance_to =  $balance_to + $amount; // calculate new balance
            $account_to->balance = $balance_to; // save new balance to account
            $account_to->save();   
            return 'Transfer completed.';
        }
        
    }


    /**
     * Update user account balance 
     *
     */
    public function checkBalance($id, $amount)
    {
        $account = Account::find($id); // get account id
        $balance=$account->balance; // get balance
        if ($amount> $balance) // check if user has enough balance
        {
            return 0; // not enought :(
        }
        else
        {
            return 1; // enought balance yey :)
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
