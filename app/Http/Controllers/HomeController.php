<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getDashboard()
    {
        $roleAdmin = Auth::user()->hasRole('super_admin');
        return view('admin.layouts.dashboard', compact('roleAdmin'));
    }
}
