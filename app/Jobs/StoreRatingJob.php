<?php

namespace App\Jobs;

use App\Models\Rating;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreRatingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $author_id;
    public int $book_id;
    public int $score;

    public function __construct(int $author_id, int $book_id, int $score)
    {
        $this->author_id = $author_id;
        $this->book_id = $book_id;
        $this->score = $score;
    }

    public function handle(): void
    {
        Rating::create([
            'author_id' => $this->author_id,
            'book_id' => $this->book_id,
            'score' => $this->score,
        ]);
    }
}
