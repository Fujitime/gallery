<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="dark:text-white text-black border border-black dark:border-white rounded-2xl text-sm px-3 pb-3 text-center inline-flex items-center focus:outline-none " type="button">
                    <span class="text-3xl" >...</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            @include('layouts.partials.download-img')
                        </li>
                        <li>
                            <a class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center">
                            <svg class="w-6 h-6 fill-current text-green-600 dark:text-green-500 hover:underline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                                <span class="ml-2">Add To Album</span>
                            </a>
                        </li>
                        <li>
                        @if(optional(Auth::user())->id == optional($gallery->user)->id || optional(Auth::user())->role === 'admin')
                            <li>
                                <a href="{{ route('galleries.edit', $gallery->id) }}" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-blue-600 dark:text-blue-500 hover:underline" viewBox="0 0 576 512">
                                        <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                                    </svg>
                                    <span class="ml-2">Edit</span>
                                </a>
                            </li>
                            <li>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-red-600 dark:text-red-500 hover:underline" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                    <span class="ml-2">Delete</span>
                                </button>
                            </form>
                        </li>

                        @endif
                    </ul>
                </div>
