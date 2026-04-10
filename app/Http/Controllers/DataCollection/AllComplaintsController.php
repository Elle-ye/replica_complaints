<?php

namespace App\Http\Controllers\DataCollection;

use App\Exports\TicketsExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Category;
use App\Models\Department;
use App\Models\NewTicket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AllComplaintsController extends Controller
{
    public function index (){
         $categories = Category::with(['subCategory'])->get();
         $departments=Department::all();
         $branches = Branches::all();

        return view('information/all-complaints', compact('categories','departments', 'branches'));
    }

    public function all_complaints_datatable(Request $request){
        // $complaints = NewTicket::all();

        $query = NewTicket::with(['complaintCategory', 'complaintSubCategory']);

        //  date range filter
        if ($request->filled('dateStart')) {
            $query->whereDate('created_at', '>=', $request->dateStart);
        }
    
        if ($request->filled('dateEnd')) {
            $query->whereDate('created_at', '<=', $request->dateEnd);
        }

         // Complaint Type filter (using ID from dropdown)
        if ($request->filled('complaintType')) {
            $query->where('complaintType', $request->complaintType);
        }
    
        // Complaint Sub Type filter (using ID from dropdown)
        if ($request->filled('complaintSubType')) {
            $query->where('complaintSubType', $request->complaintSubType);
        }

        if($request->filled('originValue')){
           $originValue = $request->originValue;

            if (str_starts_with($originValue, 'dept_')){
                $originId = str_replace('dept_', '', $originValue);
                $originType = 'department';
                $query->where('origin_id', $originId)
                    ->where('origin_type', $originType);
            } elseif(str_starts_with($originValue, 'branch_')){
                $originId = str_replace('branch_','',$originValue);
                $originType = 'branch';
                $query->where('origin_id', $originId)
                    ->where('origin_type', $originType);
            }
        }

        if($request->filled('destinationValue')){
            $destinationValue = $request->destinationValue;

            if(str_starts_with($destinationValue, 'dept_')){
                $destinationId = str_replace('dept_', '', $destinationValue);
                $destinationType = 'department';
                $query->where('destination_id', $destinationId)
                    ->where('destination_type', $destinationType);
            }elseif(str_starts_with($destinationValue, 'branch_')){
                $destinationId = str_replace('branch_', '', $destinationValue);
                $destinationType = 'branch';
                $query->where('destination_id', $destinationId)
                    ->where('destination_type', $destinationType);
            }
        }
    
        $complaints = $query->get();

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
                    // 'origin'=> getLocationName($complaint-> origin_type, $complaint->origin_id),
                    // 'destination'=> getLocationName($complaint->destination_type, $complaint->destination_id),
                    'origin' => Helper::getLocationName($complaint->origin_type, $complaint->origin_id),
                    'destination' => Helper::getLocationName($complaint->destination_type, $complaint->destination_id),
                    'complaintSubject'=> $complaint-> complaintSubject,
                    // 'complaintType'=> $complaint-> complaintType,
                    // 'complaintSubType'=> $complaint-> complaintSubType,
                    'complaintType' => $complaint->complaintCategory?->categoryName ?? 'N/A',
                    'complaintSubType' => $complaint->complaintSubCategory?->subCategoryName ?? 'N/A',
                    'created_at'=> $complaint-> created_at->format('d/m/Y g:ia'),
                    'actions'=> '
                    <button data-id="'.$complaint->id.'" 
                            data-name="'.$complaint->ticketID.'" 
                            class="button info outline editBtn">Edit</button>
                '                   
                ];
            })
        ]);
    }

    public function exportCSV(){

        // MaatWebsite
        return Excel::download(new TicketsExport, 'tickets-' . date('Y-m-d') . '.xlsx');

        
    }
}
