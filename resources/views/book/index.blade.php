@extends('layout')
@section('content')

    <section class="h-full  bg-gradient-to-br from-pink-50 to-indigo-100 p-8">
        @if(session('success'))
            <div class="mb-4 text-green-600 text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 text-red-600 text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif
        <div class="grid justify-center md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7 ">
            @foreach($books as $book)
                <div class="bg-white rounded-lg border shadow-md max-w-xs md:max-w-none overflow-hidden">
                    <img class="h-56 lg:h-60 w-full object-cover" src="{{ Storage::url($book->image)}}" alt="" />
                    <div class="p-3">
                        <span class="text-sm font-bold text-blue-500 text-primary">Genre:  {{$book->genre->category}}</span>
                        <h3 class="font-semibold text-xl leading-6 text-red-500 my-2">
                            {{$book->title}}
                        </h3>
                        <p class="paragraph-normal text-gray-600 font-bold">
                            @if($book->new_author !==null)
                                Author: {{$book->new_author}}
                            @else
                            Author: {{$book->user->name}}
                            @endif

                        </p>
                        <a class="mt-3 block" href="{{route('books.show',$book->id)}}">Read More >></a>
                    </div>
                </div>
            @endforeach
        </div>
            <div class="mt-4">
                {{ $books->links('vendor.pagination.tailwind') }}
            </div>
    </section>
@endsection
