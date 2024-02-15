<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Menambahkan impor namespace User
use Illuminate\Support\Facades\Hash; // Menambahkan impor namespace Hash

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profiles.index', compact('user'));
    }

    public function updateProfilePhoto(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'profile_image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120', // Increased to 5MB (5 * 1024 = 5120 KB)
                'dimensions:max_width=3000,max_height=3000',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');

            // Check if the uploaded file is unique (avoiding duplicates)
            $existingPhoto = $user->profile_image;
            if ($existingPhoto && Storage::exists('public/profiles/' . $existingPhoto)) {
                Storage::delete('public/profiles/' . $existingPhoto);
            }

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profiles', $imageName);

            $user->profile_image = $imageName;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile photo updated successfully');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255', // Ubah menjadi nullable jika username opsional
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Pastikan untuk memberikan nilai untuk username jika diisi dalam form
        if (!is_null($request->input('username'))) {
            $user->username = $request->input('username');
        }

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }

}
