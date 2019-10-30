<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Make deposit from any of user accounts
    **/
    public function deposit(Request $request)
    {
        if($request->get('account')==0) // check if user selected "select your account"
        {
            return back()->with('fail', 'Select your account');  
        }

        $this->validate($request, [
            'account'   => 'required',
            'amount'    =>  'required|numeric|gt:0' // valid amount greater than 0 and numberic
        ]);

        $transaction = new Transaction([
            'account_id_from'   =>  0,  // account_id_from is 0 when it's deposit
            'account_id_to'   =>  $request->get('account'),  // get selected account id
            'amount'    =>  $request->get('amount'), // get entered amount
        ]);
        $transaction->save(); // save to the transaction table

        $id_from = 0;    
        $id_to =  $request->get('account'); // account id
        $amount = $request->get('amount'); // deposit amount
        return back()->with('success', app('App\Http\Controllers\AccountController')->transaction($id_from, $id_to, $amount)); // update account table with new balance and return message to the user
    }


    /**
     * Make withdraw from any of user accounts
    **/
    public function withdraw(Request $request)
    {
        if($request->get('account')==0) // check if user selected "select your account"
        {
            return back()->with('fail', 'Select your account');  
        }

        $this->validate($request, [
            'account'   => 'required',
            'amount'    =>  'required|numeric|gt:0' // valid amount greater than 0 and numberic
        ]);
        
        $id_from =  $request->get('account'); // account id
        $id_to = 0;
        $amount=$request->get('amount'); // deposit amount
        
        if(app('App\Http\Controllers\AccountController')->checkBalance($id_from, $amount)==1) //  if user has enough balance, checkBalance will return 1
        {
            $transaction = new Transaction([
                'account_id_from'   =>  $request->get('account'),  
                'account_id_to'   =>  0,  // account_id_to is 0 when it's withdraw
                'amount'    =>  $request->get('amount'),
            ]);
            $transaction->save(); // save to the transaction table
            return back()->with('success', app('App\Http\Controllers\AccountController')->transaction($id_from, $id_to, $amount)); // update account table with new balance and return message to the user
        }
        else if(app('App\Http\Controllers\AccountController')->checkBalance($id_from, $amount)==0) //if user doesn't have enough balance, checkwithdraw will return 0
        {
            return back()->with('fail', 'Amount is greater than your balance.'); // when entered amount is greater than user balance
        }
        else
        {
            return back()->with('fail', 'Error :( '); // display other error
        }

    }



    /**
     * Make transfer from any of user accounts
    **/
    public function transfer(Request $request)
    {
        if($request->get('account')==0 || $request->get('accountTo')==0) // check if user selected "select your account"
        {
            return back()->with('fail', 'Select your account');  
        }

        $this->validate($request, [
            'account'   => 'required',
            'accountTo'   => 'required',
            'amount'    =>  'required|numeric|gt:0' // valid amount greater than 0 and numberic
        ]);
        
        $id_from =  $request->get('account'); // account id from
        $id_to =  $request->get('accountTo'); // account id to
        $amount=$request->get('amount'); // deposit amount


        if(app('App\Http\Controllers\AccountController')->checkBalance($id_from, $amount)==1) //  if user has enough balance, checkBalance will return 1
        {
            $transaction = new Transaction([
                'account_id_from'   =>  $id_from,  
                'account_id_to'   =>  $id_to,  // account_id_to is 0 when it's withdraw
                'amount'    =>  $request->get('amount'),
            ]);
            $transaction->save(); // save to the transaction table
            return back()->with('success', app('App\Http\Controllers\AccountController')->transaction($id_from, $id_to, $amount)); // update account table with new balance and return message to the user
        }
        else if(app('App\Http\Controllers\AccountController')->checkBalance($id_from, $amount)==0) //if user doesn't have enough balance, checkwithdraw will return 0
        {
            return back()->with('fail', 'Amount is greater than your balance.'); // when entered amount is greater than user balance
        }
        else
        {
            return back()->with('fail', 'Error :( '); // display other error
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.deposit');
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
