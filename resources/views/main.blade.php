<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Identity | Revise">
    <title>Identity | Revise</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
    <header class="shadow bg-white">
        <div class="container mx-auto py-5 px-5 text-center">
            <h1 class="font-semibold text-2xl text-gray-800">Identity // Revise</h1>
        </div>
    </header>

    <main class="container bg-white max-w-md mx-auto my-10 p-5 rounded">
        <h2 class="uppercase text-gray-700 font-bold text-lg text-center mb-4">sign in</h2>

        <form action="{{ route('Login') }}" method="post" class="flex flex-col justify-center items-center">
            <div class="my-3 w-3/4 flex flex-col justify-between">
                <label for="email" class="mb-2">Email</label>
                <input type="text" name="email" placeholder="admin@revise.com" class="p-2 text-gray-800 border border-gray-400 rounded-sm" />
            </div>

            <div class="my-3 w-3/4 flex flex-col justify-between">
                <label for="password" class="mb-2">Password</label>
                <input type="password" name="password" class="p-2 border border-gray-400 rounded-sm" />
            </div>

            <div class="my-3 w-3/4 flex justify-center items-center">
                <input type="submit" name="login" value="Login" class="w-32 p-2 bg-blue-600 text-white font-semibold uppercase cursor-pointer rounded-sm" />
            </div>
        </form>
    </main>
</body>
</html>