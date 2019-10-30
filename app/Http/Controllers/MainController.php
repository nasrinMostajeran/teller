<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Transaction;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    function index()
    {
        return view('home');
    }

    function checklogin(Request $request)
    {
        // valid pin to be between 4 to 8 digits
        $this->validate($request, [
        'password'  => 'required|digits_between:4,8'
        ]);
        
        // get data entered 
        $user_data = array(
            'card_number'  => $request->get('card_number'),  // for this app by default card_number is 1034982 ;)
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data))
        {   
            return redirect('main/userindex'); // redirect to userindex to get transaction queries :)
        }
        else
        {
            return back()->with('error', 'Wrong Login Details');
        }

    }

    function successlogin()
    {
        return view('user/index');
    }

    function logout()
    {
        Auth::logout();
        return redirect('home');
    }

    function userindex()
    {
        $userId = Auth::user()->id; // get user id

        /*  =============== get the last 5 checking account transactioon queries ====================*/
        $checkingAccount = DB::table('transactions')
                    ->join('accounts', function ($join) {
                    $join->on('transactions.account_id_from', '=', 'accounts.id')->orOn('transactions.account_id_to', '=', 'accounts.id');
                    })
                    ->join('users', function($join)use ($userId){
                        $join->on('accounts.user_id', '=', 'users.id')
                             ->where([['accounts.user_id', '=', $userId], ['accounts.type_id', '=', '1']]);
                    })
                    ->select('transactions.*', 'accounts.balance')->take(5)
        ->get();
        
        /*  =============== get the last 5 checking account transactioon queries ====================*/
        $savingAccount = DB::table('transactions')
                    ->join('accounts', function ($join) {
                    $join->on('transactions.account_id_from', '=', 'accounts.id')->orOn('transactions.account_id_to', '=', 'accounts.id');
                    })
                    ->join('users', function($join)use ($userId){
                        $join->on('accounts.user_id', '=', 'users.id')
                             ->where([['accounts.user_id', '=', $userId], ['accounts.type_id', '=', '2']]);
                    })
                    ->select('transactions.*', 'accounts.balance')->take(5)
        ->get();

        return view('user/index', compact('checkingAccount'), compact('savingAccount'));
        
        
    }


    
    function userdeposit()
    {
        return view('user/deposit');
    }


}

?>