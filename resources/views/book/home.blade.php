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

<body x-data="{ Major: 'Major', Generation: 'Generation', Year: 'Year', search: '', showProfile: false, @if (Auth::check()) studentName: '{{ Auth::user()->name }}',
        studentId: '{{ Auth::user()->id_number }}'
    @else
        studentName: 'Guest',studentId: 'N/A' @endif }" class="w-screen h-full">

    <nav class="border-b text-black sticky z-10">
        <div class="flex justify-between items-start h-20 lg:h-80" style="background-image: url('{{ asset('storage/logo/navbar.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="space-y-4 absolute bottom-0 lg:bottom-4 left-1/2 transform -translate-x-1/2">
                <div class="flex items-center space-x-4 justify-self-center">
                    <!-- Generation Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="nav-link flex items-center text-xs md:text-sm lg:text-base bg-white lg:py-2 lg:px-3 rounded-md lg:w-36 justify-between">
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
                            class="nav-link flex items-center text-xs md:text-sm lg:text-base bg-white p-1 lg:py-2 lg:px-3 rounded-md lg:w-36 justify-between">
                            <span x-text="Major"></span>
                            <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 lg:mt-2 lg:w-64 bg-white rounded-md shadow-lg py-1 z-10 overflow-y-auto min-h-full max-h-min h-64">
                            <div class="space-y-1">
                                @foreach ($majors as $major)
                                    <a @click="Major = '{{ $major->major_name }}'; open = false"
                                        class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 rounded-md">
                                        {{ $major->major_name }}-{{ $major->khmer_name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Year Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="nav-link flex items-center text-xs md:text-sm lg:text-base bg-white lg:py-2 lg:px-3 rounded-md lg:w-36 justify-between">
                            <span x-text="Year"></span>
                            <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 lg:mt-2 lg:w-48 bg-white rounded-md shadow-lg py-1 z-10 overflow-y-auto min-h-full max-h-min h-40 ">
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
                </div>
                <!-- Search Input -->
                <input type="text" x-model="search" placeholder="🔍Search..."
                    class="px-4 py-2 border rounded-md text-black w-full">
            </div>
            <div class="space-x-4 flex items-center absolute top-1 lg:top-4 right-4 lg:right-12 transform">
                @if (Auth::check())
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
                    <a href="{{ route('login') }}"
                        class="lg:bg-green-500 hover:bg-green-600 text-white lg:p-2 lg:rounded-lg lg:text-base text-xs">Login</a>
                @endif
            </div>
        </div>
    </nav>

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
            <p class="text-center text-gray-500">No images uploaded yet.</p>
        @endif
    </div>
    <!-- Books Display -->
    <div class="w-full lg:w-full p-6">
        @foreach ($groupedBooks as $id_majors => $books)
            @php
                $major = App\Models\Major::find($id_majors);
            @endphp

            <!-- Show only books matching the selected Major -->
            <div x-show="Major === '{{ $major ? $major->major_name : 'Unknown Major' }}' || Major === 'Major'">
                <h1 class="text-3xl font-bold text-cyan-500 mb-6">{{ $major ? $major->major_name : 'Unknown Major' }}
                </h1>
                <div class="gap-2 overflow-x-auto flex space-x-1 pb-4">
                    @foreach ($books as $book)
                        <a href="{{ route('books.show', $book->id) }}"
                            class="bg-white shadow-lg w-28 lg:w-40 flex-shrink-0"
                            x-show="(Generation === '{{ $book->generation }}' || Generation === 'Generation') &&
                                (Year === '{{ $book->year }}' || Year === 'Year')
&&
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
