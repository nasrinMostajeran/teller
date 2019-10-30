<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\AccountType;
use App\User;
use Illuminate\Support\Facades\DB;



class AccountTypeController extends Controller
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
     * Show user accounts in deposit page
     */
    
    public function deposit()
    {
        $userId = Auth::user()->id; // get user id
        $accounts = DB::table('accounts') // get list of user accounts
                        ->join('account_types', function($join) use ($userId){
                            $join->on('accounts.type_id', '=', 'account_types.id')
                                ->where('accounts.user_id', '=', $userId);
                        })
                        ->get();           
        return view('user/deposit', compact('accounts'));

    }

    /**
     * Show user accounts in widthraw page
     */
    public function withdraw()
    {
        $userId = Auth::user()->id;
        $accounts = DB::table('accounts') // get list of user accounts
                        ->join('account_types', function($join) use ($userId){
                            $join->on('accounts.type_id', '=', 'account_types.id')
                                ->where('accounts.user_id', '=', $userId);
                        })
                        ->get();
        return view('user/withdraw', compact('accounts'));
    }


    /**
     * Show user accounts in transfer page
     */
    public function transfer()
    {
        $userId = Auth::user()->id;
        $accounts = DB::table('accounts') // get list of user accounts
                        ->join('account_types', function($join) use ($userId){
                            $join->on('accounts.type_id', '=', 'account_types.id')
                                ->where('accounts.user_id', '=', $userId);
                        })
                        ->get();
        return view('user/transfer', compact('accounts'));
    }

    public function fetch(Request $request)
    {
        $userId = Auth::user()->id; // get user id
        $select = $request->get('select'); // get select sent from ajax in trannsfer page
        $value = $request->get('value'); // get value sent from ajax in trannsfer page
        $accounts = DB::table('accounts') // get list of dependent accounts 
                    ->join('account_types', function($join)use ($userId, $value){
                        $join->on('accounts.type_id', '=', 'account_types.id')
                             ->where([['accounts.user_id', '=', $userId], ['accounts.type_id', '!=', $value]]);
                    })
                    ->get();

        //// make account to select values
        $output = '<option value="">Choose account</option>';
        foreach($accounts as $account)
        {
            $output .= '<option value="'.$account->id.'">'.$account->name.'</option>';
        }
        echo $output;            

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
