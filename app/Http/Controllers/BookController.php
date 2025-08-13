<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\StoreRatingJob;
use App\Models\{Book, Author, Rating};

class BookController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->has('show') && is_numeric($request->input('show'))
            ? (int) $request->input('show')
            : 10;

        $query = Book::with(['author', 'category'])
            ->select(
                'books.*',
                DB::raw('ROUND(AVG(ratings.score), 2) as average_rating'),
                DB::raw('COUNT(ratings.id) as voter_count')
            )
            ->join('ratings', 'books.id', '=', 'ratings.book_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('books.title', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('author', function ($qa) use ($search) {
                        $qa->where('name', 'LIKE', '%' . $search . '%');
                    });
            });
        }

        $books = $query
            ->groupBy('books.id')
            ->orderByDesc('average_rating')
            ->orderByDesc('voter_count')
            ->limit($limit)
            ->get();

        return view('index', compact('books'));
    }

    public function showFamousAuthor(){
        $authors = Author::withCount([
            'ratings as voter_count' => function ($query) {
                $query->where('score', '>', 5);
            }
        ])
        ->orderByDesc('voter_count')
        ->limit(10)
        ->get();

        return view('famous_authors', compact('authors'));
    }

    public function showInputRating(){
        $authors = Author::with('books')
						->select('authors.name', 'authors.id')
                        ->orderBy('authors.name')
                        ->get();

        return view('input_rating', compact('authors'));
    }

    public function storeInputRating(Request $request)
    {
        $validated = $request->validate([
            'author_id' => 'required|integer',
            'book_id' => 'required|integer',
            'score' => 'required|integer|min:1|max:10',
        ]);

        StoreRatingJob::dispatch(
            $validated['author_id'],
            $validated['book_id'],
            $validated['score']
        );

        return redirect()->route('home')->with('success', 'Rating submitted successfully!');
    }
}
