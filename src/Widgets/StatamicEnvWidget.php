<?php

namespace MikoMagni\StatamicEnvironment\Widgets;

use Statamic\Widgets\Widget;
use MikoMagni\StatamicEnvironment\ServiceProvider;

class StatamicEnvWidget extends Widget
{
    /**
     * The widget's handle.
     *
     * @var string
     */
    protected static $handle = 'statamic_env';

    /**
     * The HTML that should be shown in the widget.
     *
     * @return \Illuminate\View\View
     */
    public function html()
    {
        $env = config('app.env', 'production');
        $envType = ServiceProvider::getEnvironmentType($env);

        $config = config('statamic_environment', []);

        // Ensure config is an array
        if (!is_array($config)) {
            $config = [];
        }

        $labels = $config['labels'] ?? ['local' => 'Local', 'staging' => 'Staging', 'production' => 'Live'];
        $icons = $config['icons'] ?? ['local' => '👨‍💻', 'staging' => '🔥', 'production' => '🚀', 'undefined' => '🚨'];

        // Ensure labels and icons are arrays
        if (!is_array($labels)) {
            $labels = ['local' => 'Local', 'staging' => 'Staging', 'production' => 'Live'];
        }
        if (!is_array($icons)) {
            $icons = ['local' => '👨‍💻', 'staging' => '🔥', 'production' => '🚀', 'undefined' => '🚨'];
        }

        // Determine if we should show additional details
        $widgetConfig = $config['widget'] ?? [];
        if (!is_array($widgetConfig)) {
            $widgetConfig = [];
        }
        $showDetails = $this->shouldShowDetails($envType, $widgetConfig);

        return view('statamic_environment::widgets.statamic-env', [
            'env' => $env,
            'env_type' => $envType,
            'env_label' => $labels[$envType] ?? 'Unknown',
            'env_icon' => $icons[$envType] ?? $icons['undefined'],
            'show_details' => $showDetails,
            'app_name' => config('app.name'),
            'app_url' => config('app.url'),
            'app_debug' => (bool) config('app.debug'),
            'mail_mailer' => config('mail.default'),
            'mail_from_address' => config('mail.from.address'),
            'git_enabled' => (bool) config('statamic.git.enabled'),
            'git_push' => (bool) config('statamic.git.push'),
            'static_caching_strategy' => config('statamic.static_caching.strategy'),
            'debugbar_enabled' => (bool) config('debugbar.enabled'),
        ]);
    }

    /**
     * Determine if additional details should be shown based on configuration
     *
     * @param string $envType
     * @param array $widgetConfig
     * @return bool
     */
    private function shouldShowDetails($envType, $widgetConfig)
    {
        $showDetails = $widgetConfig['show_details'] ?? ['local', 'staging'];

        // If show_details is a boolean, return it directly
        if (is_bool($showDetails)) {
            return $showDetails;
        }

        // If show_details is an array, check if current environment type is in it
        if (is_array($showDetails)) {
            return in_array($envType, $showDetails);
        }

        // Default to false if invalid value
        return false;
    }
}
