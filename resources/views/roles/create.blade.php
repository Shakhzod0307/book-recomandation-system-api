@extends('layout')
@section('content')
    <form action="{{route('roles.store')}}" method="POST" class=" bg-white shadow  p-4 py-40" >
        @csrf
        <div class=" heading text-center font-bold text-2xl m-5 text-gray-800 bg-white">New Role</div>
        @if(session('success'))
            <div class="mb-4 text-green-600 text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 text-red-500 text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
            <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" name="name" placeholder="Role Name" type="text" required>
            <div class="buttons flex justify-end">
                <button class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">Post</button>
            </div>
        </div>
    </form>
@endsection
