<?php

namespace App\Http\Controllers\DataCollection;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Department;
use App\Models\NewTicket;
use Illuminate\Http\Request;

class AllComplaintsController extends Controller
{
    public function index (){
        return view('information/all-complaints');
    }

    public function all_complaints_datatable(){
        $complaints = NewTicket::all();

        // Get department and branch names
        function getLocationName($type, $id){
            if($type === 'department'){
                $record = Department::find($id);
                return $record ? $record->departmentName : 'N/A';
            } else {
            $record = Branches::find($id);
                return $record ? $record->branchName : 'N/A';
            }
        }
        return response()->json([
            'data' => $complaints->map(function($complaint){
                return [
                    'ticketID'=> $complaint-> ticketID,
                    'ticketStatus'=> $complaint-> ticketStatus,
                    'staffEmail'=> $complaint-> staffEmail,
                    'acctNum'=> $complaint-> acctNum,
                    'cardNum'=> $complaint-> cardNum,
                    'custName'=> $complaint-> custName,
                    'contactNum'=> $complaint-> contactNum,
                    'origin'=> getLocationName($complaint-> origin_type, $complaint->origin_id),
                    'destination'=> getLocationName($complaint->destination_type, $complaint->destination_id),
                    'complaintSubject'=> $complaint-> complaintSubject,
                    'complaintType'=> $complaint-> complaintType,
                    'complaintSubType'=> $complaint-> complaintSubType,
                    'created_at'=> $complaint-> created_at,
                    'actions'=> '
                    <button data-id="'.$complaint->id.'" 
                            data-name="'.$complaint->ticketID.'" 
                            class="button info outline editBtn">Edit</button>
                '                   
                ];
            })
        ]);
    }
}
