@extends('dashboard.layout')
@section('content')
<div class="lg:ml-64 p-5 mt-20">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-4">User List</h2>
            <a href="{{ route('users.create') }}" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-200 mb-4 inline-block">Add New User</a>
    </div>

    <div class="overflow-auto relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
            <tr>
            <td class="px-6 py-4"> {{ $user->index }} </td>
            <td class="px-6 py-4"> {{ $user->name }} </td>
            <td class="px-6 py-4"> {{ $user->email }} </td>
                <td class="px-6 py-4"> {{ $user->role }} </td>
                <td class="px-6 py-4 flex gap-2">
                <a href="{{  route('users.edit', $user->id)}}">
                  <button type="button" class="flex items-center space-x-2 text-blue-600 dark:text-blue-500 hover:underline">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 576 512">
                          <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                      </svg>
                  </button>
                </a>
                <a href="{{  route('users.show', $user->id)}}">
                  <button type="button" class="flex items-center space-x-2 text-blue-600 dark:text-blue-500 hover:underline">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 576 512">
                          <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                      </svg>
                  </button>
                </a>

                <form action="{{  route('users.destroy', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center space-x-2 text-red-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 448 512">
                            <path fill="currentColor" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                        </svg>
                    </button>
                </form>
            </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-center">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
        </table>
        <!-- Pagination -->
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

@push("script")
<script>
    console.log(1)
</script>
@endpush
@endsection
