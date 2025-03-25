<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();
        
        return view('dashborde.layouts.dashbord', compact('adminCount', 'userCount'));
    }
}