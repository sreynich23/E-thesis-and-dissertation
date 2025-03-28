<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Thesis&dissertation</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.3/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="border-b text-black py-2 sticky bg-green-700">
        <div class="flex justify-between items-start px-6 pt-3">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="" class="w-36">
            <div class="space-y-4">
                <h1 class="text-xl font-bold text-white">NUBB-THESIS & DISSERTATION DIGITAL CENTER</h1>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>

    </nav>
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="w-16 h-screen transition-all duration-200 ease-in-out bg-white">
            <div class="p-2 space-y-4">
                <button id="menu-button" onclick="expandSidebar()"
                    class="px-3 flex items-center space-x-4 text-gray-950">
                    <i class="fas fa-bars text-green-950"></i>
                </button>
                <!-- Sidebar Items -->
                <button class="px-3 flex items-center space-x-4 text-gray-950"
                    onclick="highlightSidebarItem(this,'home')">
                    <i class="fas fa-home"></i><span class="opacity-0">Home</span>
                </button>
                <button class="px-3 flex items-center space-x-4 text-gray-950"
                    onclick="highlightSidebarItem(this,'add_books')">
                    <i class="fas fa-book"></i><span class="opacity-0">Add Book</span>
                </button>
                <button class="px-3 flex items-center space-x-4 text-gray-950"
                    onclick="highlightSidebarItem(this,'add_major')">
                    <i class="fas fa-plus"></i><span class="opacity-0">Add Major</span>
                </button>
                <button class="px-3 flex items-center space-x-4 text-gray-950"
                    onclick="highlightSidebarItem(this,'student')">
                    <i class="fas fa-user"></i><span class="opacity-0">Student</span>
                </button>
            </div>
        </div>
        <!-- Main Content -->
        <div id="content" class="p-1 w-5/6">
            <div id="home" class="page">
                @include('admin.home')
            </div>
            <div id="add_books" class="page hidden">
                @include('admin.add_books')
            </div>
            <div id="add_major" class="page hidden h-screen">
                @include('admin.add_major')
            </div>
            <div id="student" class="page hidden">
                @include('admin.student')
            </div>
        </div>
    </div>
    <script>
        function expandSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const isExpanded = sidebar.style.width === '16rem';

            sidebar.style.width = isExpanded ? '4rem' : '16rem';
            content.style.marginLeft = isExpanded ? '1rem' : '2rem';

            sidebar.querySelectorAll('span').forEach(span => span.classList.toggle('opacity-0', isExpanded));
        }

        function highlightSidebarItem(element, screenId) {
            document.querySelectorAll("#sidebar button").forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-cyan-400', 'to-cyan-500', 'text-gray-950');
                btn.firstChild.nextSibling?.classList.remove('text-green-800');
            });
            element.firstChild.nextSibling?.classList.add('text-green-800');

            // Toggle visibility of screens
            document.querySelectorAll('.page').forEach(page => page.classList.add('hidden'));
            document.getElementById(screenId).classList.remove('hidden');
        }
    </script>
</body>

</html>
