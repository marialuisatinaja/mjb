<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function printPdfCertificate($id)
    {
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true); // Enable remote content
        $pdf = new \Dompdf\Dompdf($options); // Create a new instance of Dompdf
            

        $certificate = Certificate::findOrFail($id); // Fetch the agency by ID


        $pdf->loadHtml(view('pages.templates.certificate', compact('certificate'))->render());
 
        $pdf->setPaper('legal', 'portrait');

    
        // Render the PDF
        $pdf->render();
    
        // Set headers to display PDF in the browser
        return response($pdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="request.pdf"');
    }

    public function index()
    {
        $certificates = Certificate::all();
        return view('pages.certificates.index',compact('certificates'));
    }  

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'amenities' => 'required|string|max:255',
        ]);

        // Create the user
        $certificate = new Certificate();
        $certificate->name = $request->input('name');
        $certificate->amenities = $request->input('amenities');
        $certificate->save();

        return response()->json([
            'message' => 'Certificate saved successfully.',
            'redirectUrl' => route('certificate.index'), // Example redirect
        ]);

    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $certificate = Certificate::findOrFail($id); // Fetch the agency by ID
        $certificate->delete();
        return redirect()->route('certificate.index')->with('success', 'Certficate deleted successfully.');
    }

}
