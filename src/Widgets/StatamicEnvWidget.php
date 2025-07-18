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
        $env = env('APP_ENV', 'production');
        $envType = ServiceProvider::getEnvironmentType($env);
        
        $config = config('statamic_environment', []);
        $labels = $config['labels'] ?? ['local' => 'Local', 'staging' => 'Staging', 'production' => 'Live'];
        $icons = $config['icons'] ?? ['local' => '👨‍💻', 'staging' => '🔥', 'production' => '🚀', 'undefined' => '🚨'];
        
        // Determine if we should show additional details
        $widgetConfig = $config['widget'] ?? [];
        $showDetails = $this->shouldShowDetails($envType, $widgetConfig);

        return view('statamic_environment::widgets.statamic-env', [
            'env' => $env,
            'env_type' => $envType,
            'env_label' => $labels[$envType] ?? 'Unknown',
            'env_icon' => $icons[$envType] ?? $icons['undefined'],
            'show_details' => $showDetails,
            'app_name' => env('APP_NAME'),
            'app_url' => env('APP_URL'),
            'mail_from_address' => env('MAIL_FROM_ADDRESS'),
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
        // If never_show_details is true, never show details
        if ($widgetConfig['never_show_details'] ?? false) {
            return false;
        }

        // If always_show_details is true, always show details
        if ($widgetConfig['always_show_details'] ?? false) {
            return true;
        }

        // Otherwise, check if current environment type is in the show_details array
        $showForTypes = $widgetConfig['show_details'] ?? ['local', 'staging'];
        return in_array($envType, $showForTypes);
    }
}
