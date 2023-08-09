<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonthlyInterest;
use Illuminate\Support\Facades\Auth;

class DashboardHomeController extends Controller
{
    public function home() {
        if (Auth::user() == null)
        {
            return redirect()->route('login');
        }
        $monthly_interest = MonthlyInterest::where('month', '=', 'june')->first();
        return view('dashboard.home', compact('monthly_interest'));
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

}
