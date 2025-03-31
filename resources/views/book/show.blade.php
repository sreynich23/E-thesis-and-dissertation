<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-thesis and dissertation</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Khmer+OS+Siemreap&display=swap" rel="stylesheet">
</head>

<body x-data="{ Major: 'Major', Generation: 'Generation', Year: 'Year', search: '', showProfile: false }">
    <nav class="border-b text-black sticky">
        <img src="{{ asset('storage/logo/navbar.jpg') }}" class="w-full">
    </nav>
    <button onclick="window.location.href='{{ url('/') }}'" class="text-blue-500 p-5">
        ⇽ Back Home
    </button>


    <div class="flex">
        <div class="container mx-auto p-6 h-screen w-4/6">
            <div class="lg:flex justify-between items-center mb-4 bg-white">
                <h1 class="text-base md:text-xl lg:text-2xl font-bold text-cyan-500 mb-4"style="font-family: 'Khmer OS Siemreap', sans-serif;">{{ $book->title }}</h1>
                @if (Auth::check())
                    <a href="{{ route('books.download', $book->id) }}" class="pr-20">
                        <button class="bg-blue-500 text-white lg:px-4 lg:py-2 px-2 py-1 rounded-md text-xs md:text-sm lg:text-lg">
                            Download
                        </button>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="pr-20">
                        <button class="bg-blue-500 text-white lg:px-4 lg:py-2 px-2 py-1 rounded-md text-xs md:text-sm lg:text-lg">
                            Download
                        </button>
                    </a>
                @endif
            </div>

            @if ($book->path_file && Storage::disk('public')->exists($book->path_file))
            <embed src="{{ asset('storage/' . $book->path_file) }}#toolbar=0&scrollbar=0&view=FitV&page=1" type="application/pdf"
                class="h-96 lg:w-full lg:h-full border-none justify-self-center bg-white" />
            @else
                <p class="text-red-500">The requested resource was not found on this server.</p>
            @endif
        </div>
    </div>
    </div>
</body>

</html>
