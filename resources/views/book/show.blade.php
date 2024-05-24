@extends('layout')

@section('content')
    <div class="mx-auto max-w-screen-lg overflow-hidden rounded-lg bg-white shadow">
        <div class="h-75 overflow-hidden flex items-center justify-center">
            <img style="width: 300px"
                 src="{{ Storage::url($book->image)}}"
                 class="w-full object-cover h-full"
                 alt="Book Cover"
            />
        </div>
        <div class="p-4">
            <p class="mb-1 text-lg text-center text-primary-500">
                <time class="font-bold text-blue-500"> Genre: {{$book->genre->category}}</time>
            </p>
            <p class="mb-1 text-lg text-center text-primary-500">
                <time class="font-bold text-red-500">Title: {{$book->title}}</time>
            </p>
            <p class="mb-1 text-lg text-primary-500">
                <time class="font-bold text-blue-500">Author: </time>{{$book->user->name}}<br>
                <time class="font-bold text-blue-500">Page number: </time>{{$book->page_number}}
            </p>
            <h3 class="text-xl font-medium text-gray-900">
                <time class="text-blue-500 font-bold">Description:</time>
                {{$book->description}}
            </h3>
            <div class="mt-4 flex gap-2">
                <div class="flex items-center flex-wrap">
                    <a href="{{route('books.edit',$book->id)}}" class="bg-gradient-to-r from-blue-400 to-blue-400 hover:scale-105 drop-shadow-md mr-2  shadow-cla-blue px-5 py-1 rounded-lg">Edit</a>
                    <form action="{{route('books.destroy',$book->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-gradient-to-r from-red-400 to-red-400 hover:scale-105 drop-shadow-md  shadow-cla-red px-4 py-1 rounded-lg">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Reviews Section --}}
        <div class="p-4 mt-4">
            <h3 class="text-xl text-center text-yellow-500 font-medium  mb-2">Reviews/Feedback</h3>
            @if ($book->ratings->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach ($book->ratings as $review)
                        <div class="flex bg-white shadow flex-col gap-3 mt-14">
                            <div class="flex flex-col gap-4 bg-white shadow p-4">
                                <!-- Profile and Rating -->
                                <div class="flex justify justify-between">
                                    <div class="flex gap-2 items-center">
                                        <div class="w-7 h-7 text-center rounded-full bg-red-500 text-white font-bold">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $review->user->name }}</span>
                                    </div>
                                    <div class="flex p-1 gap-1 text-orange-300">
                                        @foreach(range(1, $review->rating) as $rating)
                                            <ion-icon name="star"></ion-icon>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    <time class="text-blue-500">Take time:</time> {{$review->take_time}}
                                    <time class="text-blue-500">Type:</time> {{$review->type}}<br>
                                    <time class="text-blue-500">Comment: </time>{{$review->comment}}
                                </div>

                                <div class="flex justify-between">
                                    <span>{{$review->created_at}}</span>
{{--                                    <button class="p-1 px-2 bg-gray-900 hover:bg-gray-950 border border-gray-950 bg-opacity-60">--}}
{{--                                        <ion-icon name="share-outline"></ion-icon> Share</button>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            @else
                <p>No reviews yet.</p>
            @endif
        </div>
        {{-- End Reviews Section --}}

    </div>

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
@endsection
