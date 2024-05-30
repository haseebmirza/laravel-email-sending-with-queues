<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center">
        @if (session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 text-red-600">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="text-4xl font-bold">Welcome to {{ config('app.name') }}</h1>
        <div class="mt-6">
            <a href="/register" class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Register</a>
        </div>
    </div>
</body>
</html>
