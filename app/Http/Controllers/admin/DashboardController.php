<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function AdminDashboardPage()
    {
        return view('admin.dashboard.admin_dashboard');
    }
}
