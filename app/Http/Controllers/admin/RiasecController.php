<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Riasec;
use Illuminate\Http\Request;

class RiasecController extends Controller
{
    public function RiasecPage()
    {
        $riasec = Riasec::all();
        return view('admin.riasec.riasec', compact('riasec'));
    }
}
