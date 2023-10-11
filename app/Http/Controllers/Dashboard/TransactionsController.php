<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // Get the logged in user's ID
        $userId = Auth::id();

        // Fetch only transactions of the authenticated user
        $transactions = Transaction::where('user_id', $userId)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        return view('dashboard.transaction.transactions', compact('transactions'));
    }

    public function view_transaction($id) {
        // Fetch only transactions of the authenticated user
        $transaction = Transaction::where('transaction_id', '=', $id)
                          ->where('user_id', Auth::id())
                          ->first();

        if (!$transaction) {
            return redirect()->route('dashboard.transaction.transactions')
                             ->with('error', 'Transaction not found or not accessible.');
        }

        return view('dashboard.transaction.view_transaction', compact('transaction'));
    }
}
