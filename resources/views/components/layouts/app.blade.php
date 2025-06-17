<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Men's Clothing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    @livewire('navbar')

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

 
</body>
</html>
