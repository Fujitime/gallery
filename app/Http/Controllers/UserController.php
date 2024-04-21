<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('admin')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        try {
            $users = User::paginate(5);

            // Hitung nomor urut
            $users->each(function ($category, $key) use ($users) {
                $category->index = ($users->currentPage() - 1) * $users->perPage() + $key + 1;
            });

            return view('dashboard.users.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load user data. Please try again later.');
        }
    }

    public function create()
    {
        try {
            // Assuming you want to pass users to the create view
            $users = User::all();
            return view('dashboard.users.create', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load users data for creating new user. Please try again later.');
        }
    }

    public function store(UserRequest $request)
    {
        try {
            // Validation logic handled by UserRequest
            User::create($request->validated());

            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create user. Please try again later.');
        }
    }

    public function show(User $user)
    {
        try {
            // Fetch all galleries for the user
            $gallery = $user->gallery;
            $userGalleries = $user->galleries()->paginate(10);

            return view('dashboard.users.show', compact('user', 'gallery', 'userGalleries'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load user galleries. Please try again later.');
        }
    }

    public function edit(User $user)
    {
        try {
            // You might need users for some reason in the edit view
            $users = User::all();
            return view('dashboard.users.edit', compact('user', 'users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load user data for editing. Please try again later.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validation rules
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255|unique:users,email,' . $id,
                'username' => 'nullable|string|max:255|unique:users,username,' . $id,
                'password' => 'nullable|string|min:6',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'address' => 'nullable|string|max:255',
                'role' => 'nullable|string|in:admin,user',
            ]);

            // Find the user to update
            $user = User::findOrFail($id);

            // Update user attributes
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->address = $request->address;
            $user->role = $request->role;

            // Manage profile image file if uploaded
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile_images'), $imageName);
                $user->profile_image = $imageName;
            }

            // Save the changes
            $user->save();

            return redirect()->route('users.index')->with('success', 'User has been updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user. Please try again later.');
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user. Please try again later.');
        }
    }
}
