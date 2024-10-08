<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->has('title')) {
            $books->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('new_author')) {
            $books->where('new_author', 'like', '%' . $request->new_author . '%');
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
        return  BookResource::collection($filteredBooks)->all();
//        $booksArray = $filteredBooks->all();
//
//        return $booksArray;

    }

    public function store(StoreBookRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('books', 'public');
        }

//        dd($request->all());
        $genre = Genre::where('category',$request->genre)->first();
        $book = Book::create([
            'user_id'=>auth()->user()->id,
            'genre_id' => $genre->id,
            'title' => $request->title,
            'image' =>  $imagePath,
            'page_number' => $request->page_number,
            'description' => $request->description,
        ]);
        return response()->json([
            'message' => 'Book created successfully',
            'new book'=>$book
        ]);

    }

    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            // Handle case where book is not found (e.g., return 404 Not Found)
            return abort(404);
        }

        $bookResource = new BookResource($book);
        $bookArray = $bookResource->toArray(Request::capture());

        return $bookArray;
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
