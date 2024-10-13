<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PontSalesController extends Controller
{
    public function index()
    {
        return view('pages.point.index');
    }
}
