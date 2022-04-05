<?php

namespace Juzaweb\CMS\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Juzaweb\CMS\Events\EmailHook;
use Juzaweb\CMS\Backend\Events\PostViewed;
use Juzaweb\CMS\Backend\Listeners\CountViewPost;
use Juzaweb\CMS\Listeners\SendEmailHook;
use Juzaweb\CMS\Backend\Listeners\SendMailRegisterSuccessful;
use Juzaweb\CMS\Backend\Events\RegisterSuccessful;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EmailHook::class => [
            SendEmailHook::class,
        ],
        RegisterSuccessful::class => [
            SendMailRegisterSuccessful::class,
        ],
        PostViewed::class => [
            CountViewPost::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
