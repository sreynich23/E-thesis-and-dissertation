<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Thesis&dissertation</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Khmer+OS+Siemreap&display=swap" rel="stylesheet">
</head>

<body x-data="{ Degree_level: 'Degree level', Major: 'Major', Generation: 'Generation', Year: 'Year', search: '', showProfile: false, @if (Auth::check()) studentName: '{{ Auth::user()->name }}',
        studentId: '{{ Auth::user()->id_number }}'
    @else
        studentName: 'Guest',studentId: 'N/A' @endif }" class="w-screen h-full">
    <nav class="border-b text-black sticky z-10">
        <div class="flex justify-between items-start">
            <img src="{{ asset('storage/logo/navbar.png') }}" class="w-full">
            <div class="space-x-4 flex items-center absolute top-1 lg:top-4 right-4 lg:right-12 transform">
                @if (Auth::check())
                    @if (Auth::guard('student')->check())
                        <button @click="showProfile = !showProfile">
                            <i class="fas fa-user text-white"></i>
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('books') }}"
                            class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg">Admin Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="lg:bg-green-500 hover:bg-green-600 text-white lg:p-2 lg:rounded-lg lg:text-base text-xs">Login</a>
                @endif
            </div>
        </div>
    </nav>
    <div class="space-y-4 w-full md:w-auto">
        <div class="flex items-center space-x-2 justify-center">
            <!-- Degree Level Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center text-xs md:text-sm lg:text-base bg-red-800 text-white p-1 lg:py-2 lg:px-4 lg:rounded-md rounded-sm">
                    <span x-text="Degree_level || 'Degree_level'"></span>
                    <span x-show="Degree_level" @click.stop="Degree_level = 'Degree level'"
                        class="ml-2 text-gray-300 hover:text-gray-500">✕</span>
                </button>
                <div x-cloak x-show="open" x-transition
                    class="absolute mt-2 w-72 bg-white rounded-md shadow-lg py-1 z-10 overflow-auto max-h-40">
                    <div class="space-y-1">
                        @foreach ($groupedMajors as $degreeLevel => $majors)
                            <a @click="Degree_level = '{{ $degreeLevel }}'; open = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ $degreeLevel }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Generation Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center text-xs md:text-sm lg:text-base bg-red-800 text-white p-1 lg:py-2 lg:px-4 lg:rounded-md rounded-sm">
                    <span x-text="Generation || 'Generation'"></span>
                    <span x-show="Generation" @click.stop="Generation = 'Generation'"
                        class="ml-2 text-gray-300 hover:text-gray-500">✕</span>
                </button>
                <div x-cloak x-show="open" x-transition
                    class="absolute mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 overflow-auto max-h-40">
                    <div class="space-y-1">
                        @foreach ($generations as $generation => $value)
                            <a @click="Generation = '{{ $generation }}'; open = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ $generation }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Major Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center text-xs md:text-sm lg:text-base bg-red-800 text-white p-1 lg:py-2 lg:px-4 lg:rounded-md rounded-sm">
                    <span x-text="Major || 'Major'"></span>
                    <span x-show="Major" @click.stop="Major = 'Major'"
                        class="ml-2 text-gray-300 hover:text-gray-500">✕</span>
                </button>
                @php
                    $majors = App\Models\Major::all();
                @endphp
                <div x-cloak x-show="open" x-transition
                    class="absolute mt-2 w-72 bg-white rounded-md shadow-lg py-1 z-10 overflow-auto max-h-40">
                    <div class="space-y-1">
                        @foreach ($majors as $major)
                            <a @click="Major = '{{ $major->major_name }}'; open = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ $major->major_name }} - {{ $major->khmer_name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Year Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center text-xs md:text-sm lg:text-base bg-red-800 text-white p-1 lg:py-2 lg:px-4 lg:rounded-md rounded-sm">
                    <span x-text="Year || 'Year'"></span>
                    <span x-show="Year" @click.stop="Year = 'Year'"
                        class="ml-2 text-gray-300 hover:text-gray-500">✕</span>
                </button>
                <div x-cloak x-show="open" x-transition
                    class="absolute mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 overflow-auto max-h-40">
                    <div class="space-y-1">
                        @foreach ($years as $year => $value)
                            <a @click="Year = '{{ $year }}'; open = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ $year }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Search Input -->
            <div class="relative">
                <input type="text" x-model="search" placeholder="Search..."
                    class="p-1 lg:py-2 lg:px-4 lg:rounded-md rounded-sm text-xs md:text-sm lg:text-base border-2 border-red-800 text-black w-full md:w-96 lg:w-96 pr-10">
                <!-- Clear button (X) -->
                <button x-show="search" @click="search = ''"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 text-xs md:text-sm lg:text-base">
                    ✕
                </button>
            </div>
        </div>
    </div>

    <div class="w-3/5 shadow-lg justify-self-center">
        <!-- Image Slider -->
        @if ($covers->isNotEmpty())
            <div class="w-full overflow-hidden relative flex items-center justify-center ">
                <div id="slider" class="slider flex transition-transform duration-300 ease-in-out">
                    @foreach ($covers as $cover)
                        <div class="w-full flex-shrink-0">
                            <img src="{{ asset('storage/' . $cover->image_path) }}" alt="Cover Image"
                                class="w-full h-auto">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
        @endif
    </div>
    <!-- Books Display -->
    <div class="w-full lg:w-full p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 p-4">
    <div class="bg-white rounded-xl shadow p-4 flex justify-between items-start">
        <div>
            <p class="text-sm font-semibold text-gray-600" style="font-family: 'Khmer OS Siemreap', sans-serif;">
                សៀវភៅសរុប
            </p>
            <h2 class="text-2xl font-bold text-gray-900 mt-2">{{ $bookCount }}</h2>
        </div>
        <div class="text-red-600 text-2xl">
            <i class="fas fa-book"></i> <!-- Font Awesome icon -->
        </div>
    </div>

    @foreach ($bookCountsByDegree as $item)
        <div class="bg-white rounded-xl shadow p-4 flex justify-between items-start">
            <div>
                <p class="text-sm font-semibold text-gray-600" style="font-family: 'Khmer OS Siemreap', sans-serif;">
                    {{ $item->degree_level }}
                </p>
                <h2 class="text-2xl font-bold text-gray-900 mt-2">{{ $item->total_books }}</h2>
            </div>
            <div class="text-blue-600 text-2xl">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
    @endforeach
</div>

        <div class="gap-2 overflow-x-auto flex space-x-1 pb-4" x-show="search.trim() !== ''">
            @foreach ($books as $book)
                <a href="{{ route('books.show', $book->id) }}" class="bg-white shadow-lg w-28 lg:w-40 flex-shrink-0"
                    x-show="'{{ strtolower($book->title) }}'.includes(search.toLowerCase())">
                    @if ($book->path_file && Storage::disk('public')->exists($book->path_file))
                        <img src="{{ asset('storage/' . $book->cover) }}"
                                            alt="Cover of {{ $book->title }}" class="w-full object-cover mb-4">
                                        <p class="font-medium text-xs md:text-sm lg:text-sm text-gray-800 p-1 overflow-hidden"
                                            style="font-family: 'Khmer OS Siemreap', sans-serif; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; line-height: 1.4em; max-height: 4.2em;">
                                            {{ $book->title }}
                                        </p>
                    @else
                        <p class="text-red-500">The requested resource was not found on this server.</p>
                    @endif
                    <p class="font-medium text-xs md:text-sm lg:text-sm text-gray-800 p-1 overflow-hidden text-ellipsis line-clamp-3"
                        style="font-family: 'Khmer OS Siemreap', sans-serif;">
                        {{ $book->title }}
                    </p>
                </a>
            @endforeach
        </div>
        @foreach ($groupedMajors as $degreeLevel => $majors)
            <div x-show="Degree_level === '{{ $degreeLevel }}' || Degree_level === 'Degree level'">
                <h2 class="text-lg font-bold text-blue-700 mt-6"
                    style="font-family: 'Khmer OS Siemreap', sans-serif;">
                    {{ $degreeLevel }}
                </h2>

                @foreach ($majors as $major)
                    @php
                        $booksForMajor = $books->where('id_majors', $major->id);
                    @endphp

                    @if ($booksForMajor->count())
                        <div x-show="Major === '{{ $major->major_name }}' || Major === 'Major'">
                            <div class="flex items-center justify-between">
                                <h1 class="text-base md:text-xl lg:text-2xl font-bold text-cyan-500 mb-6"
                                    style="font-family: 'Khmer OS Siemreap', sans-serif;">
                                    {{ $major->major_name }} - {{ $major->khmer_name }}
                                </h1>
                                <a href="{{ route('books.showMajor', $major->id) }}" class="text-red-800">see
                                    more</a>
                            </div>
                            <div class="flex gap-2 space-x-1 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
    @foreach ($booksForMajor as $book)
        <a href="{{ route('books.show', $book->id) }}"
            class="bg-white shadow-lg w-28 lg:w-40 flex-shrink-0"
            x-show="(Generation === '{{ $book->generation }}' || Generation === 'Generation') &&
                     (Year === '{{ $book->year }}' || Year === 'Year')">
            <img src="{{ asset('storage/' . $book->cover) }}"
                alt="Cover of {{ $book->title }}" class="w-full object-cover mb-4">
            <p class="font-medium text-xs md:text-sm lg:text-sm text-gray-800 p-1 overflow-hidden"
                style="font-family: 'Khmer OS Siemreap', sans-serif; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3; line-height: 1.4em; max-height: 4.2em;">
                {{ $book->title }}
            </p>
        </a>
    @endforeach
</div>

                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

</body>
<script>
    const slider = document.getElementById('slider');
    if (slider) {
        const slides = slider.children;
        let currentIndex = 0;

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        setInterval(showNextSlide, 5000);
    }
</script>

</html>
