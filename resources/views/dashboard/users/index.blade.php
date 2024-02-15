@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">
        <h2 class="text-2xl font-bold mb-4">User List</h2>

        <!-- Tambahkan tautan ke halaman create -->
        <a href="{{ route('users.create') }}" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-200 mb-4 inline-block">Create User</a>

        <!-- Display User List -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th> <!-- Added role column -->
                    <!-- Add more columns if needed -->
                    @if(auth()->user()->role == 'admin')
                        <th class="py-2 px-4 border-b">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->role }}</td> <!-- Displaying user role -->
                        <!-- Add more columns if needed -->
                        @if(auth()->user()->role == 'admin')
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="ml-2 text-green-500 hover:text-green-700">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
