<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body >
    <!-- Main content slot -->
    {{ $slot }}


</body>
</html>