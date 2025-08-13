<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChunkedFactorySeederJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public string $factoryClass;
    public int $count;

    public function __construct(string $factoryClass, int $count)
    {
        $this->factoryClass = $factoryClass;
        $this->count = $count;
    }

    public function handle(): void
    {
        /** @var Factory $factory */
        $factory = new $this->factoryClass;

        DB::transaction(function () use ($factory) {
            $factory->count($this->count)->create();
        });
    }
}
