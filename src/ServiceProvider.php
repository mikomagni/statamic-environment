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

    protected $middlewareGroups = [
        'statamic.cp' => [
            \MikoMagni\StatamicEnvironment\Http\Middleware\AddEnvironmentClass::class
        ]
    ];

    protected $publishAfterInstall = true;

    public function bootAddon()
    {
        // Register stylesheet only if it exists
        if (file_exists(public_path('vendor/statamic-environment/css/dynamic.css'))) {
            $this->stylesheets = [
                '/vendor/statamic-environment/css/dynamic.css'
            ];
        }
        $this->publishes([
            __DIR__ . '/../config/statamic_environment.php' => config_path('statamic_environment.php'),
        ], 'statamic-env-config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => $this->app->langPath('vendor/statamic-environment'),
        ], 'statamic-env-lang');

        $this->mergeConfigFrom(__DIR__ . '/../config/statamic_environment.php', 'statamic_environment');

        // Generate dynamic CSS on every request (not in console)
        if (!$this->app->runningInConsole()) {
            try {
                $this->generateDynamicCss();
            } catch (\Exception $e) {
                if (function_exists('logger')) {
                    logger()->warning('Failed to generate Statamic Environment Indicator CSS: ' . $e->getMessage());
                }
            }
        }

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
        $cssAssetPath = __DIR__ . '/Http/CssAsset.php';

        if (File::exists($cssPath)) {
            $cssTime = File::lastModified($cssPath);

            // Check if config file was modified
            if (File::exists($configPath)) {
                $configTime = File::lastModified($configPath);
                if ($configTime > $cssTime) {
                    // Config changed, regenerate
                    File::delete($cssPath);
                }
            }

            // Check if CssAsset.php was modified
            if (File::exists($cssAssetPath)) {
                $assetTime = File::lastModified($cssAssetPath);
                if ($assetTime > $cssTime) {
                    // CssAsset.php changed, regenerate
                    File::delete($cssPath);
                }
            }

            // If CSS still exists, it's up to date
            if (File::exists($cssPath)) {
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
