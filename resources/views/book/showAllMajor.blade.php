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
        <img src="{{ asset('storage/logo/navbar.png') }}" class="w-full">
    </nav>
    <button onclick="window.location.href='{{ url('/') }}'" class="text-blue-500 p-5">
        ⇽ Back Home
    </button>
    <div class="w-full p-6">
        @if ($major->books->isEmpty())
            <p>No books found for this major.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                @foreach ($major->books as $book)
                    <a href="{{ route('books.show', $book->id) }}"
                        class="bg-white shadow-lg rounded-md overflow-hidden hover:shadow-xl transition-shadow duration-200">
                        @if ($book->path_file && Storage::disk('public')->exists($book->path_file))
                            <div class="h-48 lg:h-60 overflow-hidden">
                                <object
                                    data="{{ asset('storage/' . $book->path_file) }}#toolbar=0&navpanes=0&scrollbar=0&view=FitV&page=1"
                                    type="application/pdf" class="w-full h-full pointer-events-none">
                                    <p class="text-xs text-gray-500">PDF preview not available.</p>
                                </object>
                            </div>
                        @else
                            <div
                                class="h-48 lg:h-60 flex items-center justify-center bg-gray-100 text-red-500 text-sm p-2 text-center">
                                The requested resource was not found.
                            </div>
                        @endif
                        <p class="font-medium text-xs md:text-sm lg:text-sm text-gray-800 p-2 truncate"
                            style="font-family: 'Khmer OS Siemreap', sans-serif;">
                            {{ $book->title }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
