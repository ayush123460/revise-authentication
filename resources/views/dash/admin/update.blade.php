@extends('dash.header')

@section('title', 'Add Administrator')

@section('content')

<div class="py-6 px-4 flex-1">

    <h1 class="text-xl font-semibold text-gray-900">Update Administrator</h1>

    <div class="container mt-5 bg-white mx-auto py-3 px-6 rounded text-gray-900">

        @isset($err)
        <div class="my-3 py-2 px-4 bg-red-300 border-2 border-red-400">
            {{ $err }}
        </div>
        @endisset

        <form action="{{ route('dashboard.admin.update', $a->empno) }}" method="POST" class="flex flex-col">

            @csrf

            <div class="item-group">
                <label for="fname">First Name:</label>
                <input class="input" name="fname" type="text" value="{{ $a->user->fname }}">
            </div>

            <div class="item-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" class="input" value="{{ $a->user->lname }}">
            </div>

            <div class="item-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="input" value="{{ $a->user->email }}">
            </div>

            <div class="item-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" class="input">
            </div>

            <div class="item-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpassword" class="input">
            </div>

            <div class="item-group">
                <label for="empno">Employee Number:</label>
                <input type="text" name="empno" class="input" value="{{ $a->empno }}">
            </div>

            <input type="hidden" name="emp" value="{{ $a->empno }}">

            <div class="item-group">
                <input type="submit" value="Update" class="w-32 p-2 bg-blue-600 hover:bg-blue-800 active:border text-white font-semibold uppercase cursor-pointer rounded">
            </div>

        </form>
    </div>

</div>

@endsection