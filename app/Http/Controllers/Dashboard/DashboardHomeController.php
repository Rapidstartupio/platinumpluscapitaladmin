<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonthlyInterest;
use App\Models\User;
use App\Models\Balance;
use Illuminate\Support\Facades\Auth;

class DashboardHomeController extends Controller
{
  public function home() {
    if (Auth::user() == null) {
        return redirect()->route('login');
    }

    $user_balances = Balance::where('user_id', '=', Auth::user()->id)->orderBy('date', 'desc')->get();

    $months = array();
    $forex_balances = array();
    $crypto_balances = array();
    foreach ($user_balances as $key => $user_balance) {
        $month_name = date("F", mktime(null, null, null, substr($user_balance->date, 5, 2), 1));
        array_push($months, $month_name);

        $balance_in_forex = $user_balance->balance_in_forex;
        array_push($forex_balances, $balance_in_forex);

        $balance_in_crypto = $user_balance->balance_in_crypto;
        array_push($crypto_balances, $balance_in_crypto);
    }

    // Helping function
    function sum_arrays($array1, $array2) {
        $array = array();
        foreach($array1 as $index => $value) {
            $array[$index] = isset($array2[$index]) ? $array2[$index] + $value : $value;
        }
        return $array;
    }
    // ------------------- //

    $total_balances = sum_arrays($forex_balances, $crypto_balances);

    $monthly_interest = MonthlyInterest::where('month', '=', 'june')->first();

    // Retrieve the latest balance for the user
    $latest_balance = $user_balances->first();
    if (!$latest_balance) {
        $user_forex_balance = 0;
        $user_crypto_balance = 0;
    } else {
        $user_forex_balance = $latest_balance->balance_in_forex;
        $user_crypto_balance = $latest_balance->balance_in_crypto;
    }

    $months = array_reverse($months);
    $total_balances = array_reverse($total_balances);

    return view('dashboard.home', compact('monthly_interest', 'user_forex_balance', 'user_crypto_balance', 'total_balances', 'months'));
}


    public function store(Request $request) {
        dd($request->all());
        if (Auth::user() == null)
        {
            return redirect()->route('login');
        }
        $monthly_interest = MonthlyInterest::where('month', '=', 'june')->first();
        return view('dashboard.home', compact('monthly_interest'));
    }


    // Temporary function for the new menu of 'Set Goal Value' to show the seperate page.
    // Afterwards we need to make a seperate controller for that.
    public function setGoalValuePage() {
        if (Auth::user() == null)
        {
            return redirect()->route('login');
        }
        $user_balance = Auth::user()->balance;
        $monthly_interest = MonthlyInterest::where('month', '=', 'june')->first();
        //return view('dashboard.set_goal_value.index', compact('monthly_interest', 'user_balance'));
    }


}
