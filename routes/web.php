<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great.
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use Wave\Facades\Wave;
use App\Http\Controllers\Dashboard\DashboardHomeController;
use App\Http\Controllers\Dashboard\TransactionsController;
use App\Http\Controllers\Dashboard\WalletController;
use App\Http\Controllers\Dashboard\SupportController;
use App\Models\MonthlyInterest;
use App\Models\InterestLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response; // Import the Response class


use Illuminate\Support\Facades\Log;
use App\Models\Transaction;

use App\Models\Balance;

if (!function_exists('getRandomNumber')) {
  function getRandomNumber() {
      return mt_rand(1000000000, 99999999999);
  }
}


/*

Route::get('cron', function(){
    $last_day = Carbon::now()->endOfMonth()->format('d');
    $today = Carbon::now()->format('d');
    $month = lcfirst(Carbon::now()->format('F'));
    $year = Carbon::now()->format('Y');
    $rate = MonthlyInterest::where('month', $month)->where('year', $year)->first();

    $users = User::with('balance')->whereHas('balance')->latest()->get();

    foreach($users as $user) {
        $balance = $user->balance()->first();
        if($balance) {
           // update this to check day and month and year ..
            $check = InterestLog::whereUserId($user->id)->whereDay('created_at', now()->day)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->first();



            Log::info($check);
            Log::info(  now()->day);


            if(!$check) {
                $interest = new InterestLog;
                $interest->user_id = $user->id;
                $interest->forex_amount = $balance->balance_in_forex;
                $interest->crypto_amount = $balance->balance_in_crypto;
                $interest->save();
            }
        }
    }

    if($today == $last_day && $rate ) {
        foreach($users as $user) {
            $balance = $user->balance()->first();
            if($balance) {
                // Get all records for the user for the current month
                $interestLogs = InterestLog::whereUserId($user->id)->whereMonth('created_at', now()->month)->get();

                $forex_total_interest = 0;
                $crypto_total_interest = 0;

                foreach($interestLogs as $log) {
                    $forex_total_interest += ($log->forex_amount * $rate->interest_type_forex / 100) / 30;
                    $crypto_total_interest += ($log->crypto_amount * $rate->interest_type_crypto / 100) / 30;
                }

                // Create new balance record with updated balance amounts
                $newBalance = new Balance;
                $newBalance->user_id = $user->id;
                $newBalance->balance_in_forex = $balance->balance_in_forex + $forex_total_interest;
                $newBalance->balance_in_crypto = $balance->balance_in_crypto + $crypto_total_interest;
                $newBalance->date = now();
                $newBalance->save();

                // Create forex transaction if forex_total_interest is > 0
                if ($forex_total_interest > 0) {
                    $forexTransaction = new Transaction;
                    $forexTransaction->user_id = $user->id;
                    $forexTransaction->transaction_id = randomNumber();
                    $forexTransaction->amount = $forex_total_interest;
                    $forexTransaction->description = 'interest';
                    $forexTransaction->balance_type = 'forex';
                    $forexTransaction->type = 'interest';
                    $forexTransaction->created_at = Carbon::now()->endOfMonth();
                    $forexTransaction->updated_at = Carbon::now()->endOfMonth();
                    $forexTransaction->save();
                }

                // Create crypto transaction if crypto_total_interest is > 0
                if ($crypto_total_interest > 0) {
                    $cryptoTransaction = new Transaction;
                    $cryptoTransaction->user_id = $user->id;
                    $cryptoTransaction->transaction_id = randomNumber();
                    $cryptoTransaction->amount = $crypto_total_interest;
                    $cryptoTransaction->description = 'interest';
                    $cryptoTransaction->balance_type = 'crypto';
                    $cryptoTransaction->type = 'interest';
                    $cryptoTransaction->created_at = Carbon::now()->endOfMonth();
                    $cryptoTransaction->updated_at = Carbon::now()->endOfMonth();
                    $cryptoTransaction->save();
                }

                // Update InterestLog entries to indicate that they have been processed
                foreach($interestLogs as $interest) {
                    $interest->status = 1;
                    $interest->save();
                }
            }
        }
    }

    return "200 ok";
});


*/

Route::get('cron', function(){
  $last_day = Carbon::now()->endOfMonth()->format('d');
  $today = Carbon::now()->format('d');
  $month = lcfirst(Carbon::now()->format('F'));
  $year = Carbon::now()->format('Y');
  $rate = MonthlyInterest::where('month', 'october')->where('year', $year)->first();

  $users = User::with('balance')->whereHas('balance')->latest()->get();

  foreach($users as $user) {
      $balance = $user->balance()->first();
      if($balance) {
         // update this to check day and month and year ..
          $check = InterestLog::whereUserId($user->id)->whereDay('created_at', now()->day)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->first();



          Log::info($check);
          Log::info(  now()->day);


          if(!$check) {
              $interest = new InterestLog;
              $interest->user_id = $user->id;
              $interest->forex_amount = $balance->balance_in_forex;
              $interest->crypto_amount = $balance->balance_in_crypto;
              $interest->save();
          }
      }
  }

  if($rate) {
      foreach($users as $user) {
          $balance = $user->balance()->first();
          if($balance) {
              // Get all records for the user for the current month
              $interestLogs = InterestLog::whereUserId($user->id)->whereMonth('created_at', 10)->get();

              $forex_total_interest = 0;
              $crypto_total_interest = 0;

              foreach($interestLogs as $log) {
                  $forex_total_interest += ($log->forex_amount * $rate->interest_type_forex / 100) / 30;
                  $crypto_total_interest += ($log->crypto_amount * $rate->interest_type_crypto / 100) / 30;
              }

              // Create new balance record with updated balance amounts
              $newBalance = new Balance;
              $newBalance->user_id = $user->id;
              $newBalance->balance_in_forex = $balance->balance_in_forex + $forex_total_interest;
              $newBalance->balance_in_crypto = $balance->balance_in_crypto + $crypto_total_interest;
              $newBalance->date = now();
              $newBalance->save();

              // Create forex transaction if forex_total_interest is > 0
              if ($forex_total_interest > 0) {
                  $forexTransaction = new Transaction;
                  $forexTransaction->user_id = $user->id;
                  $forexTransaction->transaction_id = randomNumber();
                  $forexTransaction->amount = $forex_total_interest;
                  $forexTransaction->description = 'interest';
                  $forexTransaction->balance_type = 'forex';
                  $forexTransaction->type = 'interest';
                  $forexTransaction->created_at = Carbon::now()->endOfMonth();
                  $forexTransaction->updated_at = Carbon::now()->endOfMonth();
                  $forexTransaction->save();
              }

              // Create crypto transaction if crypto_total_interest is > 0
              if ($crypto_total_interest > 0) {
                  $cryptoTransaction = new Transaction;
                  $cryptoTransaction->user_id = $user->id;
                  $cryptoTransaction->transaction_id = randomNumber();
                  $cryptoTransaction->amount = $crypto_total_interest;
                  $cryptoTransaction->description = 'interest';
                  $cryptoTransaction->balance_type = 'crypto';
                  $cryptoTransaction->type = 'interest';
                  $cryptoTransaction->created_at = Carbon::now()->endOfMonth();
                  $cryptoTransaction->updated_at = Carbon::now()->endOfMonth();
                  $cryptoTransaction->save();
              }

              // Update InterestLog entries to indicate that they have been processed
              foreach($interestLogs as $interest) {
                  $interest->status = 1;
                  $interest->save();
              }
          }
      }
  }

  return "200 ok";
});



// Authentication routes
Auth::routes();

// Voyager Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    $namespacePrefix = '\\'.config('voyager.controllers.namespace').'\\';
    Route::get('interest/transactions', ['uses' => $namespacePrefix.'VoyagerController@interestTransactions',   'as' => 'admin.interest.transactions']);
});


Route::get('dashboard/home', [DashboardHomeController::class, 'home'])->name('dashboard.home');
Route::get('dashboard/set-goal-value', [DashboardHomeController::class, 'setGoalValuePage'])->name('dashboard.set_goal_value');
Route::post('dashboard/setGoal', [DashboardHomeController::class, 'store'])->name('dashboard.setGoal');
Route::get('dashboard/transactions', [TransactionsController::class, 'index'])->name('dashboard.transactions');
Route::get('dashboard/transaction/{id}', [TransactionsController::class, 'view_transaction'])->name('view.transaction');

Route::get('dashboard/wallet', [WalletController::class, 'index'])->name('dashboard.wallet');

Route::get('dashboard/support', [SupportController::class, 'index'])->name('dashboard.support_tickets');
Route::get('dashboard/support/create-ticket', [SupportController::class, 'create_ticket'])->name('dashboard.create_ticket');
Route::post('dashboard/support/store-ticket', [SupportController::class, 'store_ticket'])->name('dashboard.store_ticket');

// Wave routes
Wave::routes();
