<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\Category;
use App\Models\Department;
use App\Models\NewTicket;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewTicketController extends Controller
{
     // Fetch Departments - New Ticket
    public function index(){
         $departments=Department::all();
         $branches = Branches::all();
         $ticketID = NewTicket::generateTicketID();
         $category = Category::all();
         $subCategory= SubCategory::all();
         
        return view('information/new_ticket', compact('departments', 'branches', 'ticketID','category', 'subCategory'));
    }

    // Fetch SubCategories
    public function get_subcategories($category_id){
        $subCategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subCategories);
    }
    

    // Stores Registered Users form info
    public function ticket_store(Request $request){
        $request->validate([
            'ticketID'=>'required|string|max:20|unique:new_tickets,ticketID',
            'date'=> 'required|date',
            'ticketStatus'=> 'nullable|string|max:100',
            'staffEmail'=> 'required|email',
            'acctNum'=> 'required|numeric|digits:13',
            'cardNum'=> 'required|numeric|digits:16',
            'custName'=>'required|string|max:500',
            'ageRange'=> 'required',
            'custEmail'=> 'nullable',
            'contactNum'=> 'required|regex:/^[0-9+\-\s()]{9,15}$/',
            'channel'=> 'required',
            'origin'=> 'required',
            'destination'=> 'required',
            'complaintSubject'=> 'required|string|max:250',
            'complaintType'=> 'required',
            'complaintSubType'=> 'required',
            'complaintDescription'=> 'required|string|max:5000'
        ]);

        // Parsing the origin and destination fields (since two tables are being pulled into one field)
       $originValue = $request->origin; // e.g 'dept_1' or 'branch_2'
        $destinationValue = $request->destination;

        // ✅ parse origin
        if(str_starts_with($originValue, 'dept_')){
            $originId = str_replace('dept_', '', $originValue);
            $originType = 'department';
        } else {
            $originId = str_replace('branch_', '', $originValue);
            $originType = 'branch';
        }

        // ✅ parse destination
        if(str_starts_with($destinationValue, 'dept_')){
            $destinationId = str_replace('dept_', '', $destinationValue);
            $destinationType = 'department';
        } else {
            $destinationId = str_replace('branch_', '', $destinationValue);
            $destinationType = 'branch';
        }

        NewTicket::create([
            'ticketID' => NewTicket::generateTicketID(),
            'date' => $request->date,
            'ticketStatus' => $request->ticketStatus ?? 'open', // ✅ default to open
            'staffEmail' => Auth::user()->email,
            'acctNum' => $request->acctNum,
            'cardNum' => $request->cardNum,
            'custName' => $request->custName,
            'ageRange' => $request->ageRange,
            'custEmail' => $request->custEmail,
            'contactNum' => $request->contactNum,
            'channel' => $request->channel,
            'origin_id' => $originId,
            'origin_type' => $originType,
            'destination_id' => $destinationId,
            'destination_type' => $destinationType,
            'complaintSubject' => $request->complaintSubject,
            'complaintType' => $request->complaintType,
            'complaintSubType' => $request->complaintSubType,
            'complaintDescription' => $request->complaintDescription,
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Ticket Submitted Successfully!'
        ]);
    }
}
