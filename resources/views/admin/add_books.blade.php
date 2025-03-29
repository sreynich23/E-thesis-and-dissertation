<div class="ml-16 w-full lg:w-3/4 transition-all duration-200 ease-in-out">
    <h1 class="text-2xl font-bold mb-6">Upload Book</h1>
    <form action="{{ route('books.create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Major Selection -->
        <div class="mb-4">
            <label for="major" class="block text-gray-700">Major</label>
            <select name="id_majors" id="major" class="w-full p-2 border border-gray-300 rounded mt-1">
                @foreach ($majors as $major)
                    <option value="{{ $major->id }}">{{ $major->major_name }}-{{ $major->khmer_name }}</option>
                @endforeach
            </select>
            @error('id_majors')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Generation Input -->
        <div class="mb-4">
            <label for="generation" class="block text-gray-700">Generation</label>
            <input type="text" name="generations" id="generation" placeholder="Enter Generation"
                class="w-full p-2 border border-gray-300 rounded mt-1">
            @error('generations')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Year Input -->
        <div class="mb-4">
            <label for="year" class="block text-gray-700">Year</label>
            <input type="text" name="year" id="year" placeholder="Enter Year"
                class="w-full p-2 border border-gray-300 rounded mt-1">
            @error('year')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" placeholder="Enter Book Title"
                class="w-full p-2 border border-gray-300 rounded mt-1" required>
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- PDF File -->
        <div class="mb-4">
            <label for="path_file" class="block text-gray-700">File</label>
            <input type="file" name="path_file" id="path_file" accept="application/pdf"
                class="w-full p-2 border border-gray-300 rounded mt-1" onchange="previewPDF(event)">
            @error('path_file')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- PDF Preview -->
        <div id="pdf-preview" class="mb-4 border border-gray-300 rounded hidden">
            <iframe id="pdf-frame" type="application/pdf"
                class="w-full h-96 border-none justify-self-center bg-white"></iframe>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
        </div>
    </form>
</div>


<script>
    // Show Major list
    function showMajorList() {
        let input = document.getElementById('major');
        let list = document.getElementById('major-list');
        let filter = input.value.toLowerCase();

        if (filter) {
            list.classList.remove('hidden');
        } else {
            list.classList.add('hidden');
        }

        let items = list.getElementsByTagName('li');
        for (let i = 0; i < items.length; i++) {
            let text = items[i].textContent || items[i].innerText;
            if (text.toLowerCase().indexOf(filter) > -1) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }

    // Handle selection from any of the lists
    document.getElementById('major-list').addEventListener('click', function(event) {
        let selectedMajor = event.target;
        if (selectedMajor.tagName === 'LI') {
            let input = document.getElementById('major');
            input.value = selectedMajor.textContent;
        }
    });

    document.getElementById('generation-list').addEventListener('click', function(event) {
        let selectedGeneration = event.target;
        if (selectedGeneration.tagName === 'LI') {
            let input = document.getElementById('generation');
            input.value = selectedGeneration.textContent;
        }
    });

    document.getElementById('year-list').addEventListener('click', function(event) {
        let selectedYear = event.target;
        if (selectedYear.tagName === 'LI') {
            let input = document.getElementById('year');
            input.value = selectedYear.textContent;
        }
    });

    function previewPDF(event) {
    const file = event.target.files[0];
    if (file && file.type === "application/pdf") {
        const pdfFrame = document.getElementById('pdf-frame');
        const url = URL.createObjectURL(file);
        pdfFrame.src = url+ "#toolbar=0&zoom=100&page=1";
        document.getElementById('pdf-preview').classList.remove('hidden');

        // Release memory when done
        pdfFrame.onload = function() {
            URL.revokeObjectURL(url);
        };
    } else {
        alert("Please upload a valid PDF file.");
        document.getElementById('pdf-preview').classList.add('hidden');
    }
}

</script>
