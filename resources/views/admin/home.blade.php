<div class="w-full lg:w-full">
    <div class="w-3/5 bg-white p-6 rounded-lg shadow-lg justify-self-center">
        <h1 class="text-xl font-bold mb-4">Upload Images</h1>

        <!-- Upload Form -->
        <form action="{{ route('covers.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
            @csrf
            <input type="file" name="images[]" multiple accept="image/*" class="w-full p-2 border rounded mb-4"
                required>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Upload</button>
        </form>

        <!-- Image Slider -->
        @if ($covers->isNotEmpty())
            <div class="w-full overflow-hidden relative flex items-center justify-center ">
                <div id="slider" class="slider flex transition-transform duration-300 ease-in-out">
                    @foreach ($covers as $cover)
                        <div class="w-full flex-shrink-0">
                            <form action="{{ route('covers.destroy', $cover->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
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

    @foreach ($majorsWithCounts as $major)
    @php
        $books = $groupedBooks[$major->id] ?? collect();
    @endphp

    @if ($books->isNotEmpty())
        <h1 class="text-3xl font-bold text-cyan-500 mb-6" style="font-family: 'Khmer OS Siemreap', sans-serif;">
            {{ $major->major_name }}
        </h1>

        <div class="gap-2 overflow-x-auto flex space-x-1 pb-4">
            @foreach ($books as $book)
                <div class="bg-white shadow-lg w-28 lg:w-40 flex-shrink-0">
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
                </div>
            @endforeach
        </div>
    @endif
@endforeach

</div>
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
