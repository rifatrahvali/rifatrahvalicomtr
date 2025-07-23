<?php

namespace App\Jobs;

use App\Models\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PublishScheduledPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Şu anki zamana kadar publish_at dolmuş ve status'u draft olan postları bul.
        $posts = BlogPost::where('status', 'draft')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->get();
        foreach ($posts as $post) {
            $post->status = 'published';
            $post->save();
            Log::info('Blog yazısı otomatik yayınlandı: ' . $post->id);
            // Türkçe yorum: Zamanı gelen yazı otomatik olarak yayınlanır ve loglanır.
        }
    }
} 