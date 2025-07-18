<?php

namespace MikoMagni\StatamicEnvironment;

use Statamic\Providers\AddonServiceProvider;
use MikoMagni\StatamicEnvironment\Widgets\StatamicEnvWidget;
use MikoMagni\StatamicEnvironment\Http\CssAsset;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class ServiceProvider extends AddonServiceProvider
{
    protected $widgets = [
        StatamicEnvWidget::class
    ];

    protected $stylesheets = [];

    protected $middlewareGroups = [
        'statamic.cp' => [
            \MikoMagni\StatamicEnvironment\Http\Middleware\AddEnvironmentClass::class
        ]
    ];

    protected $publishAfterBoot = true;

    protected function bootAddonStyles()
    {
        // Only add stylesheet after publishing
        if ($this->app->runningInConsole()) {
            return [];
        }

        return [
            'vendor/statamic-environment/css/dynamic.css'
        ];
    }

    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__ . '/../config/statamic_environment.php' => config_path('statamic_environment.php'),
        ], 'statamic-env-config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => $this->app->langPath('vendor/statamic-environment'),
        ], 'statamic-env-lang');

        $this->mergeConfigFrom(__DIR__ . '/../config/statamic_environment.php', 'statamic_environment');

        if (!$this->app->runningInConsole()) {
            try {
                $this->generateDynamicCss();
            } catch (\Exception $e) {
                if (function_exists('logger')) {
                    logger()->warning('Failed to generate Statamic Environment Indicator CSS: ' . $e->getMessage());
                }
            }
        }

        $this->stylesheets = $this->bootAddonStyles();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'statamic_environment');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'statamic_environment');

        if (!$this->app->routesAreCached()) {
            $this->registerRoutes();
        }
    }


    public static function getEnvironmentType($env = null)
    {
        $env = $env ?: env('APP_ENV', 'production');
        $environments = config('statamic_environment.environments', [
            'local' => ['local'],
            'staging' => ['staging', 'dev'],
            'production' => ['production', 'prod', 'live'],
        ]);

        foreach ($environments as $type => $names) {
            if (in_array($env, $names)) {
                return $type;
            }
        }

        return 'undefined';
    }

    protected function generateDynamicCss()
    {
        $cssPath = public_path('vendor/statamic-environment/css/dynamic.css');
        $cssDir = dirname($cssPath);
        $configPath = config_path('statamic_environment.php');

        if (File::exists($cssPath) && File::exists($configPath)) {
            $cssTime = File::lastModified($cssPath);
            $configTime = File::lastModified($configPath);

            if ($cssTime >= $configTime) {
                return;
            }
        }

        if (!File::exists($cssDir)) {
            File::makeDirectory($cssDir, 0755, true);
        }

        $css = CssAsset::generateDynamicCss();

        File::put($cssPath, $css);
    }

    protected function registerRoutes()
    {
        Route::middleware('web')
            ->get('statamic-env/dynamic.css', function () {
                $css = \MikoMagni\StatamicEnvironment\Http\CssAsset::generateDynamicCss();

                return response($css, 200, [
                    'Content-Type' => 'text/css',
                    'Cache-Control' => 'public, max-age=3600',
                ]);
            })
            ->name('statamic-env.dynamic-css');
    }

}
