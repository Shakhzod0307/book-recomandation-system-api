<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->has('title')) {
            $books->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('author')) {
            $books->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->author . '%');
            });
        }
        if ($request->has('page')) {
            $books->where('page_number', 'like', '%' . $request->page . '%');
        }

        if ($request->has('genre')) {
            $books->whereHas('genre', function ($query) use ($request) {
                $query->where('category', 'like', '%' . $request->genre . '%');
            });
        }
        if ($request->has('rating')) {
            $books->whereHas('ratings', function ($query) use ($request) {
                $query->where('rating', 'like', '%' . $request->rating . '%');
            });
        }

        $filteredBooks = $books->get();
        return BookResource::collection($filteredBooks);
    }

    public function store(StoreBookRequest $request)
    {
//        if ($request->hasFile('image')) {
//            $image = $request->file('image');
//            $imagePath = $image->store('books', 'public');
//        }
//        dd($request->all());
        $genre = Genre::where('category',$request->genre)->first();
        Book::create([
            'user_id'=>auth()->user()->id,
            'genre_id' => $genre->id,
            'title' => $request->title,
            'image' =>  $request->image,
            'page_number' => $request->page_number,
            'description' => $request->description,
        ]);
        return response()->json(['message' => 'Book created successfully']);

    }

    public function show(string $id)
    {
        return new BookResource(Book::find($id));
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $genre = Genre::where('category',$request->genre)->first();
        $book = Book::find($id);
        $book->user_id = auth()->user()->id;
        $book->genre_id = $genre->id;
        $book->title = $request->title;
        $book->image = $request->image;
        $book->page_number = $request->page_number;
        $book->save();
        return response()->json(['message' =>'Book updated successfully!']);
    }

    public function destroy(string $id)
    {
        Book::destroy($id);
        return response()->json(['message'=>'Book deleted successfully!']);
    }
}
