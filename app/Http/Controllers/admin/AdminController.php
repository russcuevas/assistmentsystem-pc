<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function AdminManagementPage()
    {
        $admins = Admin::all();
        return view('admin.admin_management.admin_management', compact('admins'));
    }


    public function AddAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'nullable|image',
            'fullname' => 'required|string',
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.admin.management.page')->withErrors($validator)->withInput();
        }

        $profile_picture_path = $request->file('profile_picture')->store('admin/profile', 'public');

        Admin::create([
            'profile_picture' => $profile_picture_path,
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('admin.admin.management.page')->with('success', 'Admin added successfully');
    }

    public function EditAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin_management.admin_edit', compact('admin'));
    }

    public function UpdateAdmin(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'nullable|image',
            'fullname' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.edit.admin', $id)->withErrors($validator)->withInput();
        }

        $admin = Admin::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            if ($admin->profile_picture) {
                Storage::disk('public')->delete($admin->profile_picture);
            }
            $admin->profile_picture = $request->file('profile_picture')->store('admin/profile', 'public');
        }

        $admin->fullname = $request->input('fullname');
        $admin->email = $request->input('email');

        if ($request->input('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        return redirect()->route('admin.admin.management.page')->with('success', 'Admin updated successfully');
    }


    public function DeleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->profile_picture) {
            Storage::disk('public')->delete($admin->profile_picture);
        }

        $admin->delete();

        return redirect()->route('admin.admin.management.page')->with('success', 'Admin deleted successfully');
    }
}
