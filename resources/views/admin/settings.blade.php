<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Admin Settings</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700">Update Settings</button>
    </form>
</div>
