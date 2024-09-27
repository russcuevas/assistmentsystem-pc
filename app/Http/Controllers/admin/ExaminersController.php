<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExaminersController extends Controller
{
    public function ExaminersPage()
    {
        $default_id = User::pluck('default_id')->toArray();
        $next_id = !empty($default_id) ? max($default_id) + 1 : 1;

        return view('admin.examiners.examiners', compact('default_id', 'next_id'));
    }

    public function ExaminersAccountAdd(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:1',
            'default_id' => 'required|integer',
        ]);

        $count = (int) $request->input('count');
        $starting_id = (int) $request->input('default_id');
        $created_id = [];

        for ($i = 0; $i < $count; $i++) {
            $newId = $starting_id + $i;

            if (User::where('default_id', $newId)->exists()) {
                return redirect()->back()->withErrors(['default_id' => "Default ID $newId already exists. Please choose a different starting ID."]);
            }

            User::create([
                'default_id' => $newId,
                'password' => Hash::make('ub1234')
            ]);

            $created_id[] = $newId;
        }

        return redirect()->route('admin.examiners.page')->with('success', 'Default IDs added successfully: ' . implode(', ', $created_id));
    }
}
