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
        $users = User::paginate(5);

        // Hitung nomor urut
        $users->each(function ($category, $key) use ($users) {
            $category->index = ($users->currentPage() - 1) * $users->perPage() + $key + 1;
        });

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        // Assuming you want to pass users to the create view
        $users = User::all();
        return view('dashboard.users.create', compact('users'));
    }

    public function store(UserRequest $request)
    {
        // Validation logic handled by UserRequest

        User::create($request->validated());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        // Fetch all gallery for the user
        $gallery = $user->gallery;
        $userGalleries = $user->galleries()->paginate(10);

        return view('dashboard.users.show', compact('user', 'gallery', 'userGalleries'));
    }

    public function edit(User $user)
    {
        // You might need users for some reason in the edit view
        $users = User::all();
        return view('dashboard.users.edit', compact('user', 'users'));
    }


    public function update(Request $request, $id)
        {
            // Validasi input
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255|unique:users,email,' . $id,
                'username' => 'nullable|string|max:255|unique:users,username,' . $id,
                'password' => 'nullable|string|min:6',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'address' => 'nullable|string|max:255',
                'role' => 'nullable|string|in:admin,user',
            ]);

            // Temukan pengguna yang ingin diupdate
            $user = User::findOrFail($id);

            // Update atribut pengguna
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->address = $request->address;
            $user->role = $request->role;

            // Mengelola file gambar profil jika diunggah
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile_images'), $imageName);
                $user->profile_image = $imageName;
            }

            // Simpan perubahan
            $user->save();

            return redirect()->route('users.index')->with('success', 'User has been updated successfully!');
        }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
