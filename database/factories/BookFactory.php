<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Author, BookCategory};


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private array $authorIds;
    private array $categoryIds;

    public function definition(): array
    {
        // Lazy load all IDs once
        if (!isset($this->authorIds)) {
            $this->authorIds = Author::pluck('id')->toArray();
        }

        if (!isset($this->categoryIds)) {
            $this->categoryIds = BookCategory::pluck('id')->toArray();
        }

        return [
            'title' => 'The ' . ucfirst(fake()->word()) . ' of the ' . ucfirst(fake()->word()) . ' ' . fake()->numberBetween(1, 9999),
            'author_id' => $this->authorIds[array_rand($this->authorIds)],
            'book_category_id' => $this->categoryIds[array_rand($this->categoryIds)],
        ];
    }
}
