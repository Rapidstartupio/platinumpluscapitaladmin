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



use App\Models\Transaction;



use App\Models\Balance;

if (!function_exists('getRandomNumber')) {
  function getRandomNumber() {
      return mt_rand(1000000000, 99999999999);
  }
}


Route::get('cron', function(){

  $startDate = Carbon::create(2023, 10, 1);
  $endDate = Carbon::create(2023, 10, 11);

  $users = User::with('balance')->whereHas('balance')->latest()->get();

  foreach ($users as $user) {
      $balance = $user->balance()->first();
      if (!$balance) {
          continue; // Skip users without balance
      }

      for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
          // Check if the log already exists for this day to avoid duplication
          $existingLog = InterestLog::whereUserId($user->id)->whereDate('created_at', $date)->first();
          if ($existingLog) {
              continue; // Skip this day if log already exists
          }

          // Create interest logs for each day of the specified period
          $interest = new InterestLog;
          $interest->user_id = $user->id;
          $interest->forex_amount = $balance->balance_in_forex;
          $interest->crypto_amount = $balance->balance_in_crypto;
          $interest->created_at = $date; // Set the created_at date to the looping date
          $interest->save();
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
