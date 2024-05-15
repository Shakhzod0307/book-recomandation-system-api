<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = [
            "Fiction",
            "Non-fiction",
            "Mystery",
            "Thriller",
            "Romance",
            "Science Fiction",
            "Fantasy",
            "Horror",
            "Historical Fiction",
            "Biography",
            "Autobiography",
            "Memoir",
            "Self-help",
            "Travel",
            "Cooking",
            "Poetry",
            "Drama",
            "Comedy",
            "Adventure",
            "Crime",
            "Young Adult (YA)",
            "Children's",
            "Graphic Novel",
            "Satire",
            "Religious/Spiritual",
            "Business/Finance",
            "Science",
            "Art/Photography",
            "Music",
            "Philosophy",
            "Psychology",
            "Health/Fitness",
            "Technology",
            "Nature/Environment",
            "Sports",
            "Education",
            "Political",
            "Cultural",
            "Erotica",
            "Dystopian",
            "Utopian",
            "Western",
            "Experimental",
            "Legal/Thriller",
            "Military/War",
            "Post-Apocalyptic",
            "Steampunk",
            "Cyberpunk",
            "Magical Realism",
            "Realistic Fiction",
        ];

        foreach ($lists as $list){
            Genre::create([
                'category'=>$list
            ]);
        }
    }
}
