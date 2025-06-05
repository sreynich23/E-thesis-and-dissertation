<div class="container mt-5">
    <div class="d-flex justify-content-end mb-4">
        <button class="absolute right-0 mr-4 bg-green-500 text-white px-6 py-2 rounded" onclick="openModals()">
            Add Admin
        </button>
    </div>
    <div class="d-flex justify-content-end mb-4">
        <button class="absolute right-0 mr-4 bg-green-500 text-white px-6 py-2 rounded" onclick="openModals()">
            Add Student
        </button>
    </div>
    <h2 class="text-center mb-4 text-4xl font-weight-bold">Student Management</h2>
    <div class="overflow-hidden shadow-lg bg-white">
        <table class="w-full border-collapse">
            <thead class="thead-light bg-primary text-white bg-green-500">
                <tr class="bg-green-500 text-white text-left border-gray-500 border">
                    <th>ID</th>
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->id_number }}</td>
                        <td class="d-flex justify-content-around">
                            <button
                                onclick="openEditModal({{ $student->id }}, '{{ $student->name }}', '{{ $student->id_number }}')"
                                class="btn btn-warning btn-sm shadow-sm" title="Edit Student">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Delete Student"
                                    onclick="return confirm('Are you sure you want to delete this student?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Student Modal -->
<div id="modal-containers" class="hidden fixed z-50 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4" id="modal-title">Add Student</h3>
        <form id="modal-forms" method="POST" action="{{ route('students.store') }}">
            @csrf
            <input type="text" name="name" id="name" placeholder="Enter Student Name"
                class="w-full p-2 border border-gray-300 rounded mt-1" required>
            <input type="text" name="id_number" id="id_number" placeholder="Enter Student ID"
                class="w-full p-2 border border-gray-300 rounded mt-1" required>
            <input type="password" name="password" id="password" placeholder="Enter Student Password"
                class="w-full p-2 border border-gray-300 rounded mt-1" required>
            <div class="flex justify-end space-x-4">
                <button type="button" class="text-gray-700" onclick="closeModal()">Cancel</button>
                <button type="submit" class="text-white bg-green-600 px-4 py-2 rounded-md">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Student Modal -->
<div id="edit-modal" class="hidden fixed z-50 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Student</h2>
        <form id="edit-form" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" id="edit-name"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-3">
                <label>ID Number</label>
                <input type="text" name="id_number" id="edit-id-number"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-3">
                <label>Password (Leave empty to keep existing)</label>
                <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" class="text-gray-700" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="text-white bg-blue-600 px-4 py-2 rounded-md">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModals() {
        const modal = document.getElementById('modal-containers');
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal-containers').classList.add('hidden');
    }

    function openEditModal(id, name, idNumber) {
        const modal = document.getElementById('edit-modal');
        const form = document.getElementById('edit-form');
        const nameInput = document.getElementById('edit-name');
        const idNumberInput = document.getElementById('edit-id-number');

        nameInput.value = name;
        idNumberInput.value = idNumber;
        form.action = `/students/${id}`;

        modal.classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
</script>
