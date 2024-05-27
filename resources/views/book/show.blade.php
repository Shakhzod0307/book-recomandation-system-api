@extends('layout')

@section('content')
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
                <time class="font-bold text-blue-500">Author: </time>
                @if($book->new_author !==null)
                    {{$book->new_author}}
                @else
                     {{$book->user->name}}
                @endif<br>
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
        <!-- component -->
        <div class="mx-auto max-w-screen-lg my-32 px-4 py-4 bg-white shadow-lg rounded-lg flex">
            <!-- Left Side: Review Summary -->
            <div class="border-2 w-1/2 px-4 py-4">
                <div class="mb-1 tracking-wide">
                    <h2 class="text-gray-800 font-semibold mt-1">{{$counts}} Users reviews</h2>
                    <div class="border-b -mx-8 px-8 pb-3">
                        <div class="flex items-center mt-1">
                            <div class=" w-1/5 text-indigo-500 tracking-tighter">
                                <span>5 star</span>
                            </div>
                            <div class="w-3/5">
                                <div class="bg-gray-300 w-full rounded-lg h-2">
                                    <div class="bg-indigo-600 rounded-lg h-2"  style="width: {{ $percent5 }}%;"></div>
                                </div>
                            </div>
                            <div class="w-1/5 text-gray-700 pl-3">
                                <span class="text-sm">{{$percent5}}%</span>
                            </div>
                        </div><!-- first -->
                        <div class="flex items-center mt-1">
                            <div class="w-1/5 text-indigo-500 tracking-tighter">
                                <span>4 star</span>
                            </div>
                            <div class="w-3/5">
                                <div class="bg-gray-300 w-full rounded-lg h-2">
                                    <div class="bg-indigo-600 rounded-lg h-2" style="width: {{ $percent4 }}%;"></div>
                                </div>
                            </div>
                            <div class="w-1/5 text-gray-700 pl-3">
                                <span class="text-sm">{{$percent4}}%</span>
                            </div>
                        </div><!-- second -->
                        <div class="flex items-center mt-1">
                            <div class="w-1/5 text-indigo-500 tracking-tighter">
                                <span>3 star</span>
                            </div>
                            <div class="w-3/5">
                                <div class="bg-gray-300 w-full rounded-lg h-2">
                                    <div class="bg-indigo-600 rounded-lg h-2" style="width: {{ $percent3 }}%;" ></div>
                                </div>
                            </div>
                            <div class="w-1/5 text-gray-700 pl-3">
                                <span class="text-sm">{{$percent3}}%</span>
                            </div>
                        </div><!-- third -->
                        <div class="flex items-center mt-1">
                            <div class=" w-1/5 text-indigo-500 tracking-tighter">
                                <span>2 star</span>
                            </div>
                            <div class="w-3/5">
                                <div class="bg-gray-300 w-full rounded-lg h-2">
                                    <div class="bg-indigo-600 rounded-lg h-2" style="width: {{ $percent2 }}%;"></div>
                                </div>
                            </div>
                            <div class="w-1/5 text-gray-700 pl-3">
                                <span class="text-sm">{{$percent2}}%</span>
                            </div>
                        </div><!-- fourth -->
                        <div class="flex items-center mt-1">
                            <div class="w-1/5 text-indigo-500 tracking-tighter">
                                <span>1 star</span>
                            </div>
                            <div class="w-3/5">
                                <div class="bg-gray-300 w-full rounded-lg h-2">
                                    <div class="bg-indigo-600 rounded-lg h-2" style="width: {{ $percent1 }}%;"></div>
                                </div>
                            </div>
                            <div class="w-1/5 text-gray-700 pl-3">
                                <span class="text-sm">{{$percent1}}%</span>
                            </div>
                        </div><!-- fifth -->
                    </div>
                </div>
            </div>

            <!-- Right Side: Review Form -->
            <div class="border-2 w-1/2 px-4 py-4">
                <h2 class="text-gray-800 font-semibold text-lg mb-4">Leave a Review</h2>
                <form action="{{ route('store.rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{$book->id}}">
                    <div class="mb-4">
                        <label for="rating" class="block text-gray-700">Rating</label>
                        <select name="rating" required id="rating" class="border text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full border-gray-300 rounded-lg">
                            <option value="5">5 star</option>
                            <option value="4">4 stars</option>
                            <option value="3">3 stars</option>
                            <option value="2">2 stars</option>
                            <option value="1">1 stars</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="take_time" class="block text-gray-700">Take Time</label>
                        <input type="text" name="take_time" id="take_time" class="title bg-gray-100 border  p-2 mb-4 outline-none  w-full border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700">Type</label>
                        <select name="type" required id="type" class="border text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full border-gray-300 rounded-lg">
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700">User</label>
                        <select name="user_id" required id="type" class="border text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full border-gray-300 rounded-lg">
                                <option value="{{auth()->id()}}">{{auth()->user()->name}}</option>
                        @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="comment" class="block text-gray-700">Feedback</label>
                        <textarea name="comment" id="comment" required rows="4" class="description bg-gray-100 sec p-3 h-25 outline-none w-full border-gray-300 rounded-lg"></textarea>
                    </div>

                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-lg">Submit Review</button>
                </form>
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
                                    @if($review->take_time)
                                        <time class="text-blue-500">Take time:</time> {{$review->take_time}}
                                    @endif
                                    @if($review->type)
                                        <time class="text-blue-500">Type:</time> {{$review->type}}<br>
                                    @endif
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
