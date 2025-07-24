<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\PublishScheduledPosts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Jobs\TestFailingJob;

class QueueJobOptimizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function job_high_priority_queueya_gonderilebilir()
    {
        // Türkçe: Kuyruğa job gönderimini fake'liyoruz
        Queue::fake();
        PublishScheduledPosts::dispatchToHighPriority();
        Queue::assertPushedOn('high', PublishScheduledPosts::class);
        // Türkçe: Job'ın doğru kuyruğa gönderildiği test edilir
    }

    /** @test */
    public function job_default_queueya_gonderilebilir()
    {
        Queue::fake();
        PublishScheduledPosts::dispatch()->onQueue('default');
        Queue::assertPushedOn('default', PublishScheduledPosts::class);
        // Türkçe: Job'ın default kuyruğa gönderildiği test edilir
    }

    /** @test */
    public function job_basarisiz_oldugunda_failed_jobs_tablosuna_yazilir()
    {
        // Türkçe: Job'ın başarısız olması simüle edilir
        $this->artisan('queue:table');
        $this->artisan('migrate');
        $job = new TestFailingJob();
        Queue::push($job);
        try {
            $this->artisan('queue:work --once');
        } catch (\Exception $e) {
            // Türkçe: Hata bekleniyor, testin devam etmesi için yakalanıyor
        }
        $this->assertDatabaseCount('failed_jobs', 1);
        // Türkçe: Başarısız job'ın failed_jobs tablosuna yazıldığı test edilir
    }
} 