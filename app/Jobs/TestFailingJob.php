<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestFailingJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function handle()
    {
        // Türkçe: Bu job her zaman hata fırlatır, failed_jobs tablosunu test etmek için kullanılır.
        throw new \Exception('Test amaçlı hata!');
    }
} 