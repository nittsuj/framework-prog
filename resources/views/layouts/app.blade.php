<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Saya')</title>
    <!-- Menggunakan Tailwind CSS untuk estetika UI yang bersih dan rapi -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
    
    <!-- Navigasi -->
    <nav class="bg-indigo-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex space-x-4 items-center">
                    <a href="{{ route('home') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'bg-indigo-800' : 'hover:bg-indigo-700' }} transition">Home</a>
                    <a href="{{ route('about') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('about') ? 'bg-indigo-800' : 'hover:bg-indigo-700' }} transition">About</a>
                    <a href="{{ route('project') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('project') ? 'bg-indigo-800' : 'hover:bg-indigo-700' }} transition">Project Idea</a>
                    <a href="{{ route('calculator') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('calculator', 'calculation') ? 'bg-indigo-800' : 'hover:bg-indigo-700' }} transition">Kalkulator</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 md:p-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Aplikasi Tugas PBKK.
        </div>
    </footer>

</body>
</html>
