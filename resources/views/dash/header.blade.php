<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="Identity // Revise">
    <title>Dashboard - @yield('title') | Identity // Revise</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-300 h-screen text-gray-600 flex flex-col">
    <header class="bg-white">
        <div class="container mx-auto py-5 px-5 flex justify-between items-center">
            <h1 class="font-semibold text-2xl text-gray-800">Dashboard - Identity Management</h1>
            <h1 class="text-xl text-gray-800">Welcome, {{ auth()->user()->fname }}</h1>
        </div>
    </header>

    <div class="flex flex-1">
        <x-sidebar />
        @yield('content')
    </div>
</body>
</html>