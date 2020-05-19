@extends('dash.header')

@section('title', 'Profile')

@section('content')

<div class="py-6 px-4 flex-1">

    <h1 class="text-xl font-semibold text-gray-900">Your Profile</h1>

    <div class="container mt-5 bg-white mx-auto py-3 px-6 rounded text-gray-900">

        @isset($msg)
        <div class="my-3 py-2 px-4 bg-green-300 border-2 border-green-400">
            {{ $msg }}
        </div>
        @endisset

        @isset($err)
        <div class="my-3 py-2 px-4 bg-red-300 border-2 border-red-400">
            {{ $err }}
        </div>
        @endisset

        <form action="{{ route('dashboard.profile.update') }}" method="POST" class="flex flex-col">

            @csrf

            <div class="item-group">
                <label for="fname">First Name:</label>
                <input class="input" name="fname" type="text" value="{{ $u->fname }}">
            </div>

            <div class="item-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" class="input" value="{{ $u->lname }}">
            </div>

            <div class="item-group">
                <label for="email">Email:</label>
                @if($u->role != 'admin')
                <input type="email" name="email" class="input" value="{{ $u->email }}" disabled>
                @else
                <input type="email" name="email" class="input" value="{{ $u->email }}">
                @endif
            </div>

            @if($u->role == 'admin')

            <div class="item-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" class="input">
            </div>

            <div class="item-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpassword" class="input">
            </div>

            <x-admin-profile :admin="$d" />

            @endif

            <div class="item-group">
                <input type="submit" value="Update" class="w-32 p-2 bg-blue-600 hover:bg-blue-800 active:border text-white font-semibold uppercase cursor-pointer rounded">
            </div>

        </form>
    </div>

</div>

@endsection