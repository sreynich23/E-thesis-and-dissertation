<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUBB Finish The Dissertation</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body x-data="{ Major: 'Major', Generation: 'Generation', Year: 'Year', search: '', showProfile: false }">
    <nav class="border-b text-black py-2 sticky bg-green-700">
        <div class="flex justify-between items-start px-6 pt-3">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="" class="w-36">
            <div class="space-y-4">
                <h1 class="text-xl font-bold text-white">NUBB-THESIS & DISSERTATION DIGITAL CENTER</h1>
                <div class="flex items-center space-x-4">
                    <!-- Generation Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="nav-link flex items-center text-xs md:text-sm lg:text-base bg-white lg:py-2 lg:px-3 rounded-md">
                            <span x-text="Generation"></span>
                            <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 lg:mt-2 lg:w-48 bg-white rounded-md shadow-lg py-1 z-10 overflow-y-auto min-h-full max-h-min h-40">
                            <div class="space-y-1">
                                @foreach ($generations as $generation => $value)
                                    <a @click="Generation = '{{ $generation }}'; open = false"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                        {{ $generation }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Major Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="nav-link flex items-center text-xs md:text-sm lg:text-base bg-white lg:py-2 lg:px-3 rounded-md">
                            <span x-text="Major"></span>
                            <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 lg:mt-2 lg:w-48 bg-white rounded-md shadow-lg py-1 z-10 overflow-y-auto min-h-full max-h-min h-40">
                            <div class="space-y-1">
                                @foreach ($majors as $major)
                                    <a @click="Major = '{{ $major->major_name }}'; open = false"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                        {{ $major->major_name }}-{{ $major->khmer_name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Year Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="nav-link flex items-center text-xs md:text-sm lg:text-base bg-white lg:py-2 lg:px-3 rounded-md">
                            <span x-text="Year"></span>
                            <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 lg:mt-2 lg:w-48 bg-white rounded-md shadow-lg py-1 z-10 overflow-y-auto h-40">
                            <div class="space-y-1">
                                @foreach ($years as $year => $value)
                                    <a @click="Year = '{{ $year }}'; open = false"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                        {{ $year }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <input type="text" x-model="search" placeholder="Search..."
                        class="px-4 py-2 border rounded-md text-black">
                </div>
            </div>
            <div class="space-x-4 flex items-center">
                @if (Auth::check())
                    <!-- Profile Icon -->
                    <button @click="showProfile = !showProfile">
                        <i class="fas fa-user text-white"></i>
                    </button>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg">Login</a>
                @endif

            </div>
        </div>
    </nav>
    <button onclick="window.location.href='{{ url('/') }}'" class="text-blue-500 p-5">
        ⇽ Back Home
    </button>


    <div class="flex">
        <div class="container mx-auto p-6 h-screen w-4/6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-cyan-500 mb-4">{{ $book->title }}</h1>
                @if (Auth::check())
                    <a href="{{ route('books.download', $book->id) }}" class="pr-20">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            Download
                        </button>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="pr-20">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            Download
                        </button>
                    </a>
                @endif

            </div>

            @if ($book->path_file && Storage::disk('public')->exists($book->path_file))
                <embed src="{{ asset('storage/' . $book->path_file) }}#toolbar=0" type="application/pdf"
                    class="w-3/5 h-full border-none justify-self-center bg-white p-4" />
            @else
                <p class="text-red-500">The requested resource was not found on this server.</p>
            @endif
        </div>
        <div class="w-2/6">
            <input type="text" x-model="search" placeholder="Search..."
                class="px-4 py-2 border rounded-md text-black mb-4 w-full">

            @foreach ($groupedBooks as $id_majors => $books)
                @php
                    $major = App\Models\Major::find($id_majors);
                @endphp
                <div x-show="Major === '{{ $major ? $major->major_name : 'Unknown Major' }}' || Major === 'Major'">
                    <h1 class="text-3xl font-bold text-cyan-500 mb-6">
                        {{ $major ? $major->major_name : 'Unknown Major' }}
                    </h1>
                    <div class="gap-2 grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($books as $book)
                            <a href="{{ route('books.show', $book->id) }}"
                                class="bg-white shadow-lg w-10 lg:w-20 flex-shrink-0"
                                x-show="(Generation === '{{ $book->generation }}' || Generation === 'Generation') &&
                                        (Year === '{{ $book->year }}' || Year === 'Year') &&
                                        (search === '' || '{{ strtolower($book->title) }}'.includes(search.toLowerCase()))">
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover of {{ $book->title }}"
                                    class="w-full object-cover mb-4">
                                <h2 class="font-semibold text-lg text-gray-800 p-1">{{ $book->title }}</h2>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
