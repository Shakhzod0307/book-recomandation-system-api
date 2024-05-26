@extends('layout')
@section('content')
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow p-4 py-8" x-data="{ images: [] }">
        @csrf
        <div class="heading text-center font-bold text-2xl m-5 text-gray-800 bg-white">New Book</div>
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
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
            <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" name="title" placeholder="Title" type="text" required>
            <div class="relative inline-flex mb-4">
                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                <select name="genre" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                    <option value="" disabled selected>Choose a genre</option>
                    @foreach($genres as $genre)
                        <option  value="{{ $genre->id }}"  >{{ $genre->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative inline-flex mb-4">
                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                <select name="genre" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                    <option value="" disabled selected>Choose a author</option>
                    @foreach($authors as $author)
                        <option  value="{{ $author->id }}"  >{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" name="page_number" placeholder="Page number" type="text" required>
            <textarea class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" name="description" required placeholder="Describe full description about this book here"></textarea>
            <div class="icons flex text-gray-500 m-2">
                <label id="select-image">
                    <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    <input required name="image" hidden type="file" @change="images = Array.from($event.target.files).map(file => ({url: URL.createObjectURL(file), name: file.name, preview: ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop().toLowerCase()), size: file.size > 1024 ? file.size > 1048576 ? Math.round(file.size / 1048576) + 'mb' : Math.round(file.size / 1024) + 'kb' : file.size + 'b'}))" x-ref="fileInput">
                </label>
            </div>
            <div id="preview" class="my-4 flex">
                <template x-for="(image, index) in images.slice(0, 1)" :key="index">
                    <div class="relative w-32 h-32 object-cover rounded ">
                        <div x-show="image.preview" class="relative w-32 h-32 object-cover rounded">
                            <img :src="image.url" class="w-32 h-32 object-cover rounded">
                            <button @click="images.splice(index, 1)" class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span class="mx-auto">×</span></button>
                            <div x-text="image.size" class="text-xs text-center p-2"></div>
                        </div>
                        <div x-show="!image.preview" class="relative w-32 h-32 object-cover rounded">
                            <svg class="fill-current w-32 h-32 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                            </svg>
                            <button @click="images.splice(index, 1)" class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span class="mx-auto">×</span></button>
                            <div x-text="image.size" class="text-xs text-center p-2"></div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="buttons flex justify-end">
                <button class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">Post</button>
            </div>
        </div>
    </form>
@endsection
