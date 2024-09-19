<?php

namespace App\Jobs;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadBookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookData;
    /**
     * Create a new job instance.
     */
    public function __construct(array $bookData)
    {
        $this->bookData = $bookData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->bookData;
//        $imagePath = Storage::put('public', $data['image']);
//        $filePath = Storage::put('public', $data['file_path']);



        $book = new Book();
        if ($data->author){
            $book->user_id = $data['author'];
        }elseif ($data->new_author){
            $book->user_id = auth()->id();
            $book->new_author = $data['new_author'];
        }
        else{
            $book->user_id = auth()->id();
        }
        if ($data->genre){
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

        $book->save();
    }
}
