<?php

namespace App\Http\Controllers;

use App\Models\NewTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function exportCSV()
{
    $tickets = NewTicket::all(); // Get all your data
    
    $filename = "tickets.csv";
    
    $handle = fopen('php://output', 'w');
    
    // Add headers (column names)
    fputcsv($handle, ['ID', 'Complaint Type', 'Complaint Sub-Type', 'Created At']);
    
    // Add data rows
    foreach($tickets as $ticket) {
        fputcsv($handle, [
            $ticket->id,
            $ticket->complaintType,
            $ticket->complaintSubType,
            $ticket->created_at
        ]);
    }
    
    fclose($handle);
    
    return Response::stream(function() use ($handle) {
        // Stream the file
    }, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
}
}
