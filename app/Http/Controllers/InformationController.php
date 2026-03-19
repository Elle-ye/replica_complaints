<?php

namespace App\Http\Controllers;

// use App\Models\Post;
// use App\Models\RegisterUser;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    // Fetch Registered User
    // public function index(){
    //     $users = RegisterUser::latest()->paginate(10);
    //     return view('information/info', compact('users'));
    // }

    // New Ticket
    public function ticket_create(){
        return view('information/new_ticket');
    }

    // Stores Registered Users form info
    public function ticket_store(Request $request){
        $request->validate([
            'ticketID'=>'required|string|max:20',
            'date'=> 'required|string|max:20',
            'ticketStatus'=> 'nullable|string|max:100',
            'staffEmail'=> 'required|email|unique:new_ticket,email',
            'acctNum'=> 'required|max:13|min:13',
            'cardNum'=> 'required|numeric|min:13|max:13',
            'custName'=>'required|string|max:500',
            'ageRange'=> 'required',
            'custEmail'=> 'nullable',
            'contactNum'=> 'required|numeric|digits_between:9,15',
            'channel'=> 'required',
            'origin'=> 'required',
            'destination'=> 'required',
            'complaintSubject'=> 'required|string|max:250',
            'complaintType'=> 'required',
            'complaintSubType'=> 'required',
            'complaintDescription'=> 'required|string|max:500'


        ]);
        // RegisterUser::create($request->all());

        // $.ajax([

        // ]);

        return redirect()->route('registered.users');
    }

    // Fetch Registered Users
    // public function registered_users(){
    //     $users = RegisterUser::latest()->paginate(10);
    //     return view('information/info', compact('users'));
    // }

    public function download_table(Request $req){
    //    
    }
}
