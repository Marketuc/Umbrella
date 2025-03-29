<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     */
    public function index()
    {
        return view('dashboard', [
            'user' => Auth::user(), // Pass user details to the view
        ]);
    }
}