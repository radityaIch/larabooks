<?php

namespace Database\Seeders;

use App\Models\{Author, BookCategory, Book, Rating};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ChunkedFactorySeederJob;
use Database\Factories\BookFactory;
use Database\Factories\RatingFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::factory(1000)->create();
        BookCategory::factory(3000)->create();
        $this->batchSeed(BookFactory::class, 100000, 2500, 'Books');
        $this->batchSeed(RatingFactory::class, 500000, 2500, 'Ratings');
    }

    private function batchSeed(string $factoryClass, int $total, int $chunkSize, string $label): void
    {
        $jobs = [];
        $remaining = $total;

        while ($remaining > 0) {
            $currentChunk = min($chunkSize, $remaining);
            $jobs[] = new ChunkedFactorySeederJob($factoryClass, $currentChunk);
            $remaining -= $currentChunk;
        }

        Bus::batch($jobs)
            ->name("Seeding $label")
            ->then(fn($batch) => info("✅ [$label] Seeding complete"))
            ->catch(fn($batch, \Throwable $e) => info("❌ [$label] Batch failed: {$e->getMessage()}"))
            ->finally(fn($batch) => info("ℹ️ [$label] Batch finished. Press CTRL + C to stop the seeder."))
            ->dispatch();
    }

}
