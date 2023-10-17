<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\ContentTypes\File;

class SupportController extends Controller
{
    public function index() {
        if (Auth::user() == null)
        {
            return redirect()->route('login');
        }
        $userId = Auth::id();

        $tickets = SupportTicket::where('email', '=', Auth::user()->email)->get();

  
        // if(!is_null($tickets))
        // {
        //     dd('working');
        // }
        // else
        // {
        //     dd('not working');
        // }

        return view('dashboard.support.support_tickets', compact('tickets'));
    }

    public function create_ticket() {
        if (Auth::user() == null)
        {
            return redirect()->route('login');
        }
        return view('dashboard.support.create_ticket');
    }

    public function store_ticket(Request $request) {

//        if($request->file())
//        {
//            $fileName = time() . '.' . $request->file->extension();
//            $request->file->storeAs('public/images', $fileName);
//
//        }


        $ticket = [
            'subject' => $request['subject'],
            'message' => $request['message'],
            'email' => Auth::user()->email
        ];


        if($file = $request->file('file')) {

            $file_name = time() . $file->getClientOriginalName();
            $file_name = $file->move('images', $file_name);
            $ticket['file'] = $file_name;
        }

        SupportTicket::create($ticket);
        return redirect('/dashboard/support');


//        $request->validate([
//            'subject' => 'required',
//            'message' => 'required'
//        ]);
//




        if (Auth::user() == null)
        {
            return redirect()->route('login');
        }
        return view('dashboard.support.support_tickets');
    }
}
