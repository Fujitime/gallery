<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Add logic to fetch dashboard data if needed
        return view('dashboard.dashboard');
    }
}
