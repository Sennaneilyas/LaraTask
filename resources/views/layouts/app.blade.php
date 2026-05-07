<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
    <title>{{ $title ?? 'LaraTask' }}</title>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <x-layout.header title="LaraTask" />
    <main class="pt-20 min-h-screen">
        @yield('content')
    </main>
</body>

</html>