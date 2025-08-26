<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\NoCaptcha;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\ContactForm;
use App\Models\DesignGallery;
use App\Observers\IndexNowObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register model observers
        Blog::observe(IndexNowObserver::class);
        CaseStudy::observe(IndexNowObserver::class);
        DesignGallery::observe(IndexNowObserver::class);

        // Register captcha validation rule (only if not auto-registered by the package)
        Validator::extendImplicit('captcha', function ($attribute, $value, $parameters, $validator) {
            $captcha = new NoCaptcha(
                config('captcha.secret'),
                config('captcha.sitekey')
            );

            return $captcha->verifyResponse(
                request()->get('g-recaptcha-response'),
                request()->ip()
            );
        });
    }
}
