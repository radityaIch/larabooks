<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Author, Book};


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private array $bookIds;
    private array $authorIds;

    public function definition(): array
    {
        // lazy load all IDs once
        if (!isset($this->bookIds)) {
            $this->bookIds = Book::pluck('id')->toArray();
        }
        if (!isset($this->authorIds)) {
            $this->authorIds = Author::pluck('id')->toArray();
        }

        return [
            'book_id' => $this->bookIds[array_rand($this->bookIds)],
            'author_id' => $this->authorIds[array_rand($this->authorIds)],
            'score' => $this->faker->numberBetween(1, 10),
        ];
    }
}
