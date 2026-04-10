<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\Models\NewTicket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TicketsExport implements FromCollection, WithHeadings 
// WithMapping
{
    /*
    protected $data;
    protected $type;

    public function __construct($data = [], $type = 'all')
    {
        $this->data = $data;
        $this->type = $type;
    }*/

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        /* Method 1
        // To get all columns
         return NewTicket::all();*/

         /* Method 2
        //  To get column
        return NewTicket::select('ticketID', 'date','ticketStatus', 'staffEmail', 'acctNum', 'cardNum', 'custName','ageRange','custEmail', 'contactNum','channel','origin_id','origin_type','destination_id','destination_type', 'complaintSubject','complaintType', 'complaintSubType','complaintDescription')->get();
        */

        // Method 3
        /*
        if($this->type === 'selected'){
            // Export selected records by ticketID
            return NewTicket::with(['complaintCategory', 'complaintSubCategory'])->whereIn('ticketID', $this->data)->get();
        }elseif($this->type === 'filtered'){
            // Export filtered records
            $query = NewTicket::with(['complaintCategory', 'complaintSubCategory']);
        }

        // Apply data filters
        if(!empty($this->data['dateStart'])){
            $query->whereDate('created_at', '>=', $this->data['dateStart']);
        }
        if(!empty($this->data['dataEnd'])){
            $query->whereData('created_at', '<=', $this->data['dateEnd']);
        }*/


        $tickets = NewTicket::with(['complaintCategory', 'complaintSubCategory'])->get();

        return $tickets->map(function($ticket){
            return [
                $ticket->ticketID,
                $ticket->date,
                $ticket->ticketStatus,
                $ticket->staffEmail,
                $ticket->acctNum,
                $ticket->cardNum,
                $ticket->custName,
                $ticket->ageRange,
                $ticket->custEmail,
                $ticket->contactNum,
                $ticket->channel,
                Helper::getLocationName($ticket->origin_type, $ticket->origin_id),
                Helper::getLocationName($ticket->destination_type, $ticket->destination_id),
                $ticket->complaintSubject,
                $ticket->complaintCategory ?-> categoryName ?? 'N/A',
                $ticket->complaintSubCategory ?-> subCategoryName ?? 'N/A',
                $ticket->complaintDescription
            ];
        });

        }

    public function headings(): array
    {
        return [
            'Ticket ID',
            'Submitted Date',
            'Ticket Status', 
            'Staff Email',
            'Account Number',
            'Card Number',
            'Customer Name',
            'Age Range',
            'Customer Email',
            'Contact Number',
            'Channel',
            'Origin',
            // 'Origin_type',
            'Destination',
            // 'Destination_type' ,
            'Complaint Subject',
            'Complaint Type',
            'Complaint Sub-Type',
            'Complaint Description'
        ];
    }
}
