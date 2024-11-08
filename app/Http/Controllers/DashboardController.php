<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Middleware to ensure only authenticated users can access
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        return view('dashboard', [
            'user' => $user
        ]);
    }
}