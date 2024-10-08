<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
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
        $authors = User::where('role_id',3)->get();
        return view('book.create',compact('genres','authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
//        dd($data);
        $imagePath = $request->file('image')->store('public');
        $file_path = $request->file('file_path')->store('public');
        $data['image'] = $imagePath;
        $data['file_path'] = $file_path;
        $book = new Book();
        if ($request->author){
            $book->user_id = $data['author'];
        }elseif ($request->new_author){
            $book->user_id = auth()->id();
            $book->new_author = $data['new_author'];
        }
        else{
            $book->user_id = auth()->id();
        }
        if ($request->genre){
            $book->genre_id = $data['genre'];
        }else {
            $new_genre = Genre::create([
                'category'=>$data['new_genre']
            ]);
            $book->genre_id = $new_genre->id;
        }
        $book->title = $data['title'];
        $book->image = $data['image'];
        $book->file_path = $data['file_path'];
        $book->page_number = $data['page_number'];
//        $book->publication_date = now();
        $book->description = $data['description'];
        if ($book->save()){
            return back()->with('success','New Book created successfully!');
        }
        return back()->with('error','Oops, Something went wrong!');
    }

    public function show(string $id)
    {
        $book = Book::with(['genre','user','ratings'])->find($id);
        $users = User::all();
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
        return view('book.show',compact('book','users','counts','percent1','percent2','percent3','percent4','percent5'));
    }

    public function edit(string $id)
    {
        $book = Book::with(['genre','user'])->find($id);
        $genres = Genre::all();
        return view('book.edit',compact('book','genres'));
    }


    public function update(UpdateBookRequest $request, string $id)
    {
        if ($request->validated()){
            $data = $request->validated();
            $book = Book::find($id);
            $book->genre_id = $request['genre'];
            $book->title = $data['title'];
            $book->page_number = $data['page_number'];
            $book->description = $data['description'];
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public');
                $book->image = $path;
            }
            $book->save();
            return back()->with('success', 'Book updated successfully!');
        }
        return back()->with('error', 'Oops, Something went wrong!');

    }


    public function destroy(string $id)
    {
        Book::destroy($id);
        return redirect()->route('books.index')->with('success','Book deleted successfully!');
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);
        $filePath = storage_path('app/' . $book->file_path);
        return response()->download($filePath, $book->title . '.pdf');
    }
}
