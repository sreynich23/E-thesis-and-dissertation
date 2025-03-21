<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white p-8 shadow-lg rounded-lg w-96">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        @if(session('success'))
            <p class="bg-green-100 text-green-700 p-2 rounded mb-4 text-sm">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <p class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">{{ $errors->first() }}</p>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-600 font-medium">Email or ID:</label>
                <input type="text" name="email" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
            </div>

            <div>
                <label class="block text-gray-600 font-medium">Password:</label>
                <input type="password" name="password" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
            </div>

            <button type="submit"
                class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                Login
            </button>
        </form>
    </div>

</body>
</html>
