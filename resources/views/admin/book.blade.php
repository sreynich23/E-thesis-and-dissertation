<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Books List</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
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


    <table class="min-w-full bg-white shadow-md rounded-md">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="py-2 px-4 text-left">Title</th>
                <th class="py-2 px-4 text-left">Major ID</th>
                <th class="py-2 px-4 text-left">Generation</th>
                <th class="py-2 px-4 text-left">Year</th>
                <th class="py-2 px-4 text-left">Cover</th>
                <th class="py-2 px-4 text-left">PDF</th>
                <th class="py-2 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                @php
                    $major = App\Models\Major::find($book->id_majors);
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $book->title }}</td>
                    <td class="py-2 px-4">
                        {{ $major ? $major->major_name : 'Unknown Major' }} - {{ $major ? $major->khmer_name : 'Unknown Major' }}
                    </td>
                    <td class="py-2 px-4">{{ $book->generation }}</td>
                    <td class="py-2 px-4">{{ $book->year }}</td>
                    <td class="py-2 px-4">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="h-16 w-16 object-cover rounded">
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2 px-4">
                        @if ($book->path_file)
                            <a href="{{ asset('storage/' . $book->path_file) }}" target="_blank" class="text-blue-500 hover:underline">View PDF</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2 px-4">
                        <button onclick="openUpdateBookModal({{ $book->id }}, '{{ addslashes($book->title) }}', {{ $book->id_majors }}, '{{ $book->generation }}', {{ $book->year }}, '{{ $book->path_file ? asset('storage/' . $book->path_file) : '' }}')" class="text-blue-500 hover:underline">
                            Edit
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div id="modal-update-book" class="hidden fixed z-50 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96 relative">
            <button onclick="closeUpdateBookModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            <h3 class="text-lg font-semibold mb-4">Edit Book</h3>

            <form id="update-book-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title</label>
                    <input type="text" name="title" id="book_title" class="w-full p-2 border border-gray-300 rounded mt-1" required>

                    <label for="major" class="block text-gray-700 mt-2">Major</label>
                    <select name="id_majors" id="major" class="w-full p-2 border border-gray-300 rounded mt-1">
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}">{{ $major->major_name }} - {{ $major->khmer_name }}</option>
                        @endforeach
                    </select>

                    <label for="generation" class="block text-gray-700 mt-2">Generation</label>
                    <input type="text" name="generations" id="book_generation" class="w-full p-2 border border-gray-300 rounded mt-1">

                    <label for="year" class="block text-gray-700 mt-2">Year</label>
                    <input type="number" name="year" id="book_year" class="w-full p-2 border border-gray-300 rounded mt-1" required>

                    <label for="cover" class="block text-gray-700 mt-2">Cover Image (optional)</label>
                    <input type="file" name="cover" id="book_cover" accept="image/*" class="w-full p-2 border border-gray-300 rounded mt-1">

                    <label for="path_file" class="block text-gray-700 mt-2">PDF File (optional)</label>
                    <input type="file" name="path_file" id="book_file" accept="application/pdf" class="w-full p-2 border border-gray-300 rounded mt-1">

                    <div id="pdf-preview" class="mt-4 hidden">
                        <embed id="pdf-frame" src="" type="application/pdf" class="w-full h-60 border rounded" />
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeUpdateBookModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openUpdateBookModal(id, title, majorId, generation, year, pdfUrl) {
        const modal = document.getElementById('modal-update-book');
        const form = document.getElementById('update-book-form');
        const previewContainer = document.getElementById('pdf-preview');
        const iframe = document.getElementById('pdf-frame');

        form.action = `/books/update/${id}`;
        document.getElementById('book_title').value = title;
        document.getElementById('major').value = majorId;
        document.getElementById('book_generation').value = generation;
        document.getElementById('book_year').value = year;

        if (pdfUrl && pdfUrl.endsWith('.pdf')) {
            iframe.src = pdfUrl;
            previewContainer.classList.remove('hidden');
        } else {
            iframe.src = '';
            previewContainer.classList.add('hidden');
        }

        modal.classList.remove('hidden');
    }

    function closeUpdateBookModal() {
        document.getElementById('modal-update-book').classList.add('hidden');
        document.getElementById('pdf-frame').src = '';
    }

    document.getElementById('book_file').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('pdf-preview');
        const iframe = document.getElementById('pdf-frame');

        if (file && file.type === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            iframe.src = fileURL;
            previewContainer.classList.remove('hidden');
        } else {
            iframe.src = '';
            previewContainer.classList.add('hidden');
        }
    });
</script>
