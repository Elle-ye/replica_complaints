<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewTicket extends Model
{
    protected $fillable = [
        'ticketID',
        'date',
        'ticketStatus',
        'staffEmail',
        'acctNum',
        'cardNum',
        'custName',
        'ageRange',
        'custEmail',
        'contactNum',
        'channel',
        'origin_id',        
        'origin_type',     
        'destination_id',   
        'destination_type',
        'complaintSubject',
        'complaintType',
        'complaintSubType',
        'complaintDescription'
    ];
    
     // ✅ generate unique ticket ID
    public static function generateTicketID(){
        do {
            $ticketID = 'TKT-' . strtoupper(Str::random(8)); // e.g TKT-A1B2C3D4
        } while(self::where('ticketID', $ticketID)->exists()); // ✅ ensure uniqueness

        return $ticketID;
    }
}
