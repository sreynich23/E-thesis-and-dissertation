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
    <div class="p-6">
        @foreach ($groupedBooks as $id_majors => $books)
            @php
                $major = App\Models\Major::find($id_majors);
            @endphp
            <h1 class="text-3xl font-bold text-cyan-500 mb-6">{{ $major ? $major->major_name : 'Unknown Major' }}</h1>
            <div class="gap-2 overflow-x-auto flex space-x-1 pb-4">
                @foreach ($books as $book)
                    <div class="bg-white shadow-lg w-28 lg:w-40 flex-shrink-0">
                        @if ($book->path_file && Storage::disk('public')->exists($book->path_file))
                                <div style="overflow: hidden;">
                                    <embed
                                        src="{{ asset('storage/' . $book->path_file) }}#toolbar=0&navpanes=0&scrollbar=0&view=FitV&page=1"
                                        type="application/pdf"
                                        class="h-60 border-none justify-self-center bg-white"
                                        style="pointer-events: none;" />
                                </div>
                            @else
                                <p class="text-red-500">The requested resource was not found on this server.</p>
                            @endif

                            <p class="font-medium text-xs md:text-sm lg:text-sm text-gray-800 p-1 overflow-hidden text-ellipsis line-clamp-3" style="font-family: 'Khmer OS Siemreap', sans-serif;">
                                {{ $book->title }}
                            </p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
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
