<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $user = Auth::user();
            $userGalleries = $user->galleries()->paginate(10);

            return view('dashboard.profiles.index', compact('user', 'userGalleries'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load user profile data. Please try again later.');
        }
    }

    public function updateProfilePhoto(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'profile_image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif,webp',
                    'max:5120', // Increased to 5MB (5 * 1024 = 5120 KB)
                    'dimensions:max_width=3000,max_height=3000',
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');

                // Generate a unique file name
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Store the image
                $image->storeAs('public/profiles', $imageName);

                // Update the user's profile image
                $user->profile_image = $imageName;
                $user->save();
            }

            return redirect()->back()->with('success', 'Profile photo updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile photo. Please try again later.');
        }
    }

    public function update(Request $request)
    {
        try {
            // Validation rules
            $request->validate([
                'name' => 'required|string|max:25',
                'username' => 'nullable|string|max:25',
                'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
                'current_password' => 'nullable|required_with:new_password',
                'new_password' => 'nullable|min:8|max:12|required_with:current_password',
                'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
            ]);

            // Get the authenticated user
            $user = Auth::user();

            // Update user information
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');

            // Update password if provided
            if (!is_null($request->input('current_password'))) {
                if (Hash::check($request->input('current_password'), $user->password)) {
                    $user->password = Hash::make($request->input('new_password'));
                } else {
                    return redirect()->back()->withInput()->withErrors(['current_password' => 'Current password is incorrect']);
                }
            }

            // Save the changes
            $user->save();

            return redirect()->route('profile')->withSuccess('Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile. Please try again later.');
        }
    }
}
