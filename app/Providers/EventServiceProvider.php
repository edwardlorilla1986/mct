<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
         parent::boot();

    // Listen for when a job is processed (finished successfully)
    Event::listen(JobProcessed::class, function (JobProcessed $event) {
        // Check if the processed job is GenerateSitemap
        if ($event->job->resolveName() === \App\Jobs\GenerateSitemap::class) {
            // Log or perform any actions when the job is completed
            \Log::info('Sitemap generation completed.');
        }
    });

    // Listen for when a job fails
    Event::listen(JobFailed::class, function (JobFailed $event) {
        // Check if the failed job is GenerateSitemap
        if ($event->job->resolveName() === \App\Jobs\GenerateSitemap::class) {
            // Log or perform any actions when the job fails
            \Log::error('Sitemap generation failed.');
        }
    });
    }
}
