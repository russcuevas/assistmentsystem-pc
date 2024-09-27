<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function ExamineesInformationPage()
    {
        return view('users.information.information');
    }
}
