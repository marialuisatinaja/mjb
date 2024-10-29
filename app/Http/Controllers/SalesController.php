<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BusinessDetails;
use App\Models\Certificate;
use App\Models\Reservation;
use Illuminate\Http\Request;

class SalesController extends Controller
{



    public function printPdfRequest(Request $request)
    {
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true); // Enable remote content
        $pdf = new \Dompdf\Dompdf($options); // Create a new instance of Dompdf
            
        $a = 'a';
        $type = $request->query('type');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

      $reservations = BusinessDetails::with('services')
            ->where('status', '!=', 'Pending'); // Modify this as per your status logic

        // Filter by type if provided
 

        // Filter by start date if provided
        if ($startDate) {
            $reservations->where('date', '>=', $startDate);
        }

        // Filter by end date if provided
        if ($endDate) {
            $reservations->where('date', '<=', $endDate);
        }

        echo 'a';
        // Execute the query and get the results
        $reservations = $reservations->get();

        $pdf->loadHtml(view('pages.templates.report', compact('startDate','endDate','type','reservations'))->render());
 
        $pdf->setPaper('legal', 'portrait');

    
        // Render the PDF
        $pdf->render();
    
        // Set headers to display PDF in the browser
        return response($pdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="request.pdf"');
    }

public function index(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $type = $request->input('type'); // Get the type filter from request

    // Start building the query
    $reservations = BusinessDetails::with('services')
        ->where('status', '!=', 'Pending'); // Modify this as per your status logic

    // Apply the type filtering logic
    if ($type == 'walkin') {
        // If the type is 'walkin', apply the specific query
        $reservations->where('offers_type', 'walkin');
    } elseif ($type == 'reserved') {
        // If the type is 'reserved', apply the other query logic
        $reservations->where('offers_type', '<>', 'walkin'); // Assuming reserved means anything other than 'walkin'
    }

    // Apply date filtering if dates are provided
    if ($startDate) {
        $reservations->whereDate('date', '>=', $startDate);
    }
    if ($endDate) {
        $reservations->whereDate('date', '<=', $endDate);
    }

    // Fetch the filtered reservations
    $reservations = $reservations->get();

    return view('pages.sales.index', compact('reservations'));
}

}
