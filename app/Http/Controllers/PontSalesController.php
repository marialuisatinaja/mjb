<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Services;
use Illuminate\Http\Request;

class PontSalesController extends Controller
{
    public function index()
    {
        $services = Services::all();
        $packages = Package::all();
        return view('pages.point.index', compact('services','packages'));
    }

    public function create()
    {
        $services = Services::all();
        $packages = Package::all();
        return view('pages.point.create', compact('services','packages'));
    }
}
