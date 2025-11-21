<?php

namespace MikoMagni\StatamicEnvironment\Http;

class CssAsset
{
    public static function generateDynamicCss()
    {
        $config = config('statamic_environment', []);

        // Ensure config is an array
        if (!is_array($config)) {
            $config = [];
        }

        $labels = $config['labels'] ?? [
            'local' => 'Local',
            'staging' => 'Staging',
            'production' => 'Live'
        ];

        // Ensure labels is an array
        if (!is_array($labels)) {
            $labels = [
                'local' => 'Local',
                'staging' => 'Staging',
                'production' => 'Live'
            ];
        }

        $environments = $config['environments'] ?? [
            'local' => ['local'],
            'staging' => ['staging', 'dev'],
            'production' => ['production', 'prod', 'live'],
        ];

        // Ensure environments is an array
        if (!is_array($environments)) {
            $environments = [
                'local' => ['local'],
                'staging' => ['staging', 'dev'],
                'production' => ['production', 'prod', 'live'],
            ];
        }

        $configColors = $config['colors'] ?? [];

        // Ensure colors is an array
        if (!is_array($configColors)) {
            $configColors = [];
        }

        $css = '';

        // Generate header background patterns
        $css .= self::generatePatternCss($config);

        foreach ($labels as $type => $label) {
            // Ensure $label is a string
            if (!is_string($label)) {
                continue;
            }

            $envNames = $environments[$type] ?? [];

            // Ensure $envNames is an array
            if (!is_array($envNames)) {
                $envNames = [];
            }

            // Statamic 6 header badge - appears after "Breach Tools" link
            $selectors = [
                "body.env_type_{$type} header a[href*='/cp/'].text-white\\/85::after"
            ];

            foreach ($envNames as $envName) {
                $selectors[] = "body.env_{$envName} header a[href*='/cp/'].text-white\\/85::after";
            }

            $selectorString = implode(",\n", $selectors);

            $colors = $configColors[$type] ?? self::getDefaultColors($type);

            $css .= "/* {$label} Environment Badge */\n";
            $css .= "{$selectorString} {\n";
            $css .= "    content: '{$label}';\n";
            $css .= "    display: inline-flex;\n";
            $css .= "    align-items: center;\n";
            $css .= "    justify-content: center;\n";
            $css .= "    margin-left: 0.5rem;\n";
            $css .= "    font-weight: 600;\n";
            $css .= "    font-size: 0.625rem;\n";
            $css .= "    line-height: 1;\n";
            $css .= "    text-transform: uppercase;\n";
            $css .= "    letter-spacing: 0.025em;\n";
            $css .= "    background: {$colors['background']};\n";
            $css .= "    color: {$colors['color']};\n";
            $css .= "    padding: 0.18rem 0.5rem;\n";
            $css .= "    border-radius: 0.375rem;\n";
            $css .= "    white-space: nowrap;\n";
            $css .= "    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);\n";

            if (isset($colors['border'])) {
                $css .= "    border: {$colors['border']};\n";
            }

            $css .= "}\n\n";
        }

        return $css;
    }

    private static function getDefaultColors($type)
    {
        $colors = [
            'local' => [
                'background' => 'rgb(39, 145, 16)',
                'color' => 'white'
            ],
            'staging' => [
                'background' => 'rgb(153, 0, 0)',
                'color' => 'white'
            ],
            'production' => [
                'background' => 'rgb(43, 45, 48)',
                'color' => 'white',
                'border' => '1px solid white'
            ],
        ];

        return $colors[$type] ?? $colors['production'];
    }

    // private static function generateGlobalStyles()
    // {
    //     return "/* Statamic Environment Indicator - Global Styles */\n" .
    //            "/* Fix for global search background in both light and dark modes (Statamic 6) */\n" .
    //            "header button[aria-label*='Search'] .group,\n" .
    //            "header [data-global-search] {\n" .
    //            "    background: black/40;\n" .
    //            "}\n\n" .
    //            "html.dark header button[aria-label*='Search'] .group,\n" .
    //            "html.dark header [data-global-search] {\n" .
    //            "    background: black/40 !important;\n" .
    //            "}\n\n";
    // }

    private static function generatePatternCss($config)
    {
        $patterns = $config['patterns'] ?? [];
        $environments = $config['environments'] ?? [];
        $css = '';

        foreach ($patterns as $type => $pattern) {
            if (!is_array($pattern)) {
                continue;
            }

            $envNames = $environments[$type] ?? [];

            // Ensure $envNames is an array
            if (!is_array($envNames)) {
                $envNames = [];
            }

            $css .= self::generatePatternForType($type, $envNames, $pattern);
        }

        return $css;
    }

    private static function generatePatternForType($type, $envNames, $pattern)
    {
        $css = '';
        $patternType = $pattern['type'] ?? 'solid';

        // Statamic 6 header selector - targets fixed header with bg-global-header-bg class
        $selectors = ["body.env_type_{$type} header.bg-global-header-bg.fixed"];

        foreach ($envNames as $envName) {
            $selectors[] = "body.env_{$envName} header.bg-global-header-bg.fixed";
        }

        // Single pattern for dark header
        $selectorString = implode(",\n", $selectors);
        $css .= "/* " . ucfirst($type) . " Environment Header Pattern */\n";
        $css .= "{$selectorString} {\n";

        // Use colors - support both old nested structure and new flat structure
        // New format: primary/secondary directly in $pattern
        // Old format: nested under 'colors', 'dark_mode', or 'light_mode'
        if (isset($pattern['primary'])) {
            $colors = [
                'primary' => $pattern['primary'],
                'secondary' => $pattern['secondary'] ?? null,
            ];
        } else {
            $colors = $pattern['colors'] ?? $pattern['dark_mode'] ?? $pattern['light_mode'] ?? [];
        }
        $css .= self::generatePatternBackground($patternType, $colors, $pattern);
        $css .= "    background-attachment: fixed !important;\n";
        $css .= "}\n\n";

        return $css;
    }

    private static function generatePatternBackground($type, $colors, $options = [])
    {
        switch ($type) {
            case 'stripes':
                return self::generateStripesPattern($colors, $options);
            case 'dots':
                return self::generateDotsPattern($colors, $options);
            case 'checkerboard':
                return self::generateCheckerboardPattern($colors, $options);
            case 'solid':
            default:
                return self::generateSolidPattern($colors);
        }
    }

    private static function generateStripesPattern($colors, $options)
    {
        $primary = $colors['primary'] ?? '#ffffff';
        $secondary = $colors['secondary'] ?? '#f0f0f0';
        $angle = $options['angle'] ?? -55;
        $size = $options['size'] ?? 10; // Use numeric value for calculations

        return "    background: repeating-linear-gradient(\n" .
               "        {$angle}deg,\n" .
               "        {$primary},\n" .
               "        {$primary} {$size}px,\n" .
               "        {$secondary} {$size}px,\n" .
               "        {$secondary} " . ($size * 2) . "px\n" .
               "    ) !important;\n";
    }

    private static function generateDotsPattern($colors, $options)
    {
        $primary = $colors['primary'] ?? '#ffffff';
        $secondary = $colors['secondary'] ?? '#f0f0f0';
        $size = $options['size'] ?? '4px';
        $spacing = $options['spacing'] ?? '20px';

        return "    background-color: {$primary};\n" .
               "    background-image: radial-gradient(circle, {$secondary} {$size}, transparent {$size});\n" .
               "    background-size: {$spacing} {$spacing};\n";
    }

    private static function generateCheckerboardPattern($colors, $options)
    {
        $primary = $colors['primary'] ?? '#ffffff';
        $secondary = $colors['secondary'] ?? '#f0f0f0';
        $size = $options['size'] ?? 20;

        return "    background-color: {$primary};\n" .
               "    background-image: \n" .
               "        linear-gradient(45deg, {$secondary} 25%, transparent 25%), \n" .
               "        linear-gradient(-45deg, {$secondary} 25%, transparent 25%), \n" .
               "        linear-gradient(45deg, transparent 75%, {$secondary} 75%), \n" .
               "        linear-gradient(-45deg, transparent 75%, {$secondary} 75%);\n" .
               "    background-size: {$size}px {$size}px;\n" .
               "    background-position: 0 0, 0 " . ($size/2) . "px, " . ($size/2) . "px -" . ($size/2) . "px, -" . ($size/2) . "px 0px;\n";
    }

    private static function generateSolidPattern($colors)
    {
        $primary = $colors['primary'] ?? '#ffffff';
        return "    background: {$primary} !important;\n";
    }
}
