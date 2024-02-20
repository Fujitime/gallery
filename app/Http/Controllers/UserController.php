<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    public function store(Request $request)
    {
        // Validation logic goes here

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // You might need users for some reason in the edit view
        $users = User::all();
        return view('dashboard.users.edit', compact('user', 'users'));
    }

    public function update(Request $request, User $user)
    {
        // Validation logic goes here

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
