<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::with(['user','genre'])->paginate(50);
        return view('book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('book.create',compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $imagePath = $request->file('image')->store('books','public');
        $data['image'] = $imagePath;
        $book = new Book();
        $book->user_id = auth()->id();
        $book->genre_id = $data['genre'];
        $book->title = $data['title'];
        $book->image = $data['image'];
        $book->page_number = $data['page_number'];
        $book->publication_date = now();
        $book->description = $data['description'];
        if ($book->save()){
            return back()->with('success','New Book created successfully!');
        }
        return back()->with('error','Oops, Something went wrong!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['genre','user','ratings'])->find($id);
        $counts =$book->ratings->count();
        if ($counts>0) {
            $rating5 = $book->ratings->where('rating', 5)->count();
            $percent5 = (int)($rating5 / $counts * 100);
            $rating4 = $book->ratings->where('rating', 4)->count();
            $percent4 = (int)($rating4 / $counts * 100);
            $rating3 = $book->ratings->where('rating', 3)->count();
            $percent3 = (int)($rating3 / $counts * 100);
            $rating2 = $book->ratings->where('rating', 2)->count();
            $percent2 = (int)($rating2 / $counts * 100);
            $rating1 = $book->ratings->where('rating', 1)->count();
            $percent1 = (int)($rating1 / $counts * 100);
        }else{
            $percent5 =0;
            $percent4 =0;
            $percent3 =0;
            $percent2 =0;
            $percent1 =0;
        }
//        dd($counts,$rating5,$percent5,$rating4,$percent4,$rating3,$percent3,$rating2,$percent2,$rating1,$percent1);
        return view('book.show',compact('book','counts','percent1','percent2','percent3','percent4','percent5'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validated();
        $product = Book::find($id);
        $product->category_id = $request['category_id'];
        $product->name = $data['name'];
        $product->short_description = $data['description'];
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('public');
            $product->picture = $path;
        }
        $product->save();
        return back()->with('success','Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::destroy($id);
        return redirect()->route('books.index')->with('success','Book deleted successfully!');
    }
}
