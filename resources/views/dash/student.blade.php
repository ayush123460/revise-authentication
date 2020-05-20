@extends('dash.header')

@section('title', 'Students')

@section('content')

<div class="py-6 px-4 flex-1">

    <h1 class="container mx-auto text-xl font-semibold text-gray-900 flex justify-between items-center">
        Students
        <a href="{{ route('dashboard.student.create') }}" class="block w-32 p-2 font-normal text-center bg-blue-600 hover:bg-blue-400 active:border text-white cursor-pointer rounded">
            + Add new
        </a>
    </h1>

    <div class="container mt-5 bg-white mx-auto py-3 px-6 rounded text-gray-900">

        @isset($err)
        <div class="my-3 py-2 px-4 bg-red-300 border-2 border-red-400">
            {{ $err }}
        </div>
        @endisset

        @isset($msg)
        <div class="my-3 py-2 px-4 bg-green-300 border-2 border-green-400">
            {{ $msg }}
        </div>
        @endisset

        @if($s->count() > 0)

        <table class="table-fixed">
            <thead>
                <tr>
                    <th class="w-1/4 px py-2">Name</th>
                    <th class="w-2/5 px py-2">Email</th>
                    <th class="w-1/4 px py-2">Registration No.</th>
                    <th class="w-1/4 px py-2">Update/Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($s as $admin)
                <tr>
                    <td class="border px-4 py-2">{{ $admin->user->fname . " " . $admin->user->lname }}</td>
                    <td class="border px-4 py-2">{{ $admin->user->email }}</td>
                    <td class="border px-4 py-2">{{ $admin->regno }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('dashboard.student.update', $admin->regno) }}" class="block p-2 text-center bg-green-600 hover:bg-green-400 active:border text-white cursor-pointer rounded">Update</a>
                        <a href="{{ route('dashboard.student.delete', $admin->regno) }}" class="block p-2 text-center bg-red-600 hover:bg-red-400 active:border text-white cursor-pointer rounded">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else

        <p>There are no students.</p>

        @endif

    </div>

</div>

@endsection