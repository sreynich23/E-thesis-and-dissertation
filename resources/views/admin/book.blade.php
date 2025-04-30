<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Books List</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow-md rounded-md">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="py-2 px-4 text-left">Title</th>
                <th class="py-2 px-4 text-left">Major ID</th>
                <th class="py-2 px-4 text-left">Generation</th>
                <th class="py-2 px-4 text-left">Year</th>
                <th class="py-2 px-4 text-left">PDF</th>
                <th class="py-2 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $index => $book)
                @php
                    $major = App\Models\Major::find($book->id_majors);
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $book->title }}</td>
                    <td class="py-2 px-4">{{ $major ? $major->major_name : 'Unknown Major' }}-{{ $major ? $major->khmer_name : 'Unknown Major' }}</td>
                    <td class="py-2 px-4">{{ $book->generation }}</td>
                    <td class="py-2 px-4">{{ $book->year }}</td>
                    <td class="py-2 px-4">
                        @if ($book->path_file)
                            <a href="{{ asset('storage/' . $book->path_file) }}" class="text-blue-500 hover:underline"
                                target="_blank">View PDF</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2 px-4">
                        <button
                            onclick="openUpdateBookModal({{ $book->id }}, '{{ $book->title }}', {{ $book->id_majors }}, '{{ $book->generation }}', {{ $book->year }})"
                            class="text-blue-500 hover:underline">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="modal-update-book" class="hidden fixed z-50 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96 relative">
            <button onclick="closeUpdateBookModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            <h3 class="text-lg font-semibold mb-4" id="update-book-title">Edit Book</h3>
            <form id="update-book-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title</label>
                    <input type="text" name="title" id="book_title" placeholder="Enter Book Title"
                        class="w-full p-2 border border-gray-300 rounded mt-1" required>

                    <div class="mb-4">
                        <label for="major" class="block text-gray-700">Major</label>
                        <select name="id_majors" id="major" class="w-full p-2 border border-gray-300 rounded mt-1">
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->major_name }} - {{ $major->khmer_name }}</option>
                            @endforeach
                        </select>
                        @error('id_majors')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="generations" class="block text-gray-700 mt-2">Generation</label>
                    <input type="text" name="generations" id="book_generation" placeholder="Enter Generation"
                        class="w-full p-2 border border-gray-300 rounded mt-1" required disabled>

                    <label for="year" class="block text-gray-700 mt-2">Year</label>
                    <input type="number" name="year" id="book_year" placeholder="Enter Year"
                        class="w-full p-2 border border-gray-300 rounded mt-1" required>

                    <label for="path_file" class="block text-gray-700 mt-2">PDF File (optional)</label>
                    <input type="file" name="path_file" id="book_file"
                        class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="mr-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                        onclick="closeUpdateBookModal()">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function openUpdateBookModal(id, title, majorId, generation, year) {
        const modal = document.getElementById('modal-update-book');
        const form = document.getElementById('update-book-form');

        // Set the form action dynamically
        form.action = `/books/update/${id}`;

        // Populate the form fields
        document.getElementById('book_title').value = title;
        document.getElementById('major').value = majorId;
        document.getElementById('book_generation').value = generation;
        document.getElementById('book_year').value = year;

        // Show the modal
        modal.classList.remove('hidden');
    }

    function closeUpdateBookModal() {
        const modal = document.getElementById('modal-update-book');
        modal.classList.add('hidden');
    }
</script>
