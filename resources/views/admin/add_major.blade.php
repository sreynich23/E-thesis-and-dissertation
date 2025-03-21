<div class="relative h-screen bg-gray-100 p-6 ">
    <h2 class="text-center mb-4 text-4xl font-weight-bold">Major Management</h2>
    <div class="flex justify-end mb-4">
        <button class="bg-green-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-600 transition"
            onclick="openModalsMajor()">
            + Add Major
        </button>
    </div>
    <div class="overflow-hidden shadow-lg bg-white overflow-y-auto h-5/6">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-green-500 text-white text-left border-gray-500 border">
                    <th class="px-6 border-gray-500 border">Major Name</th>
                    <th class="px-6 border-gray-500 border">Degree Levels</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($groupedMajors as $degree => $majors)
                    @foreach ($majors as $major)
                        <tr class="hover:bg-gray-50 transition border-gray-500 border">
                            <td class="px-6 border-gray-500 border">{{ $major->major_name }}-{{ $major->khmer_name}}</td>
                            <td class="px-6 border-gray-500 border">{{ $degree }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="modal-container" class="hidden fixed z-50 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4" id="modal-titles">Add Student</h3>
        <form id="modal-form" action="{{ route('majors.create') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="major_name" class="block text-gray-700">Major Name</label>
                <input type="text" name="major_name" id="major_name" placeholder="Enter Major Name English"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
                <input type="text" name="khmer_name" id="khmer_name" placeholder="Enter Major Name Khmer"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
                <input type="text" name="major_name" id="major_name" placeholder="Enter Degree Level"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('major_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <button type="button" class="text-gray-700" onclick="closeModalMajor()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Major</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openModalsMajor() {
        const modal = document.getElementById('modal-container');
        const modalForm = document.getElementById('modal-form');
        const modalTitles = document.getElementById('modal-titles');
        const modalFields = document.getElementById('modal-field');
        modal.classList.remove('hidden');
    }

    function closeModalMajor() {
        document.getElementById('modal-container').classList.add('hidden');
    }
</script>
