<?php

namespace MikoMagni\StatamicEnvironment\Http;

class CssAsset
{
    public static function generateDynamicCss()
    {
        $config = config('statamic_environment', []);
        $labels = $config['labels'] ?? [
            'local' => 'Local',
            'staging' => 'Staging',
            'production' => 'Live'
        ];

        $environments = $config['environments'] ?? [
            'local' => ['local'],
            'staging' => ['staging', 'dev'],
            'production' => ['production', 'prod', 'live'],
        ];

        $configColors = $config['colors'] ?? [];

        $css = '';

        $css .= self::generateGlobalStyles();

        $css .= self::generatePatternCss($config);

        foreach ($labels as $type => $label) {
            $envNames = $environments[$type] ?? [];

            $selectors = ["body.env_type_{$type} .global-header .hidden.md\\:block.shrink-0.v-popper--has-tooltip::after"];

            foreach ($envNames as $envName) {
                $selectors[] = "body.env_{$envName} .global-header .hidden.md\\:block.shrink-0.v-popper--has-tooltip::after";
            }

            $selectorString = implode(",\n", $selectors);

            $colors = $configColors[$type] ?? self::getDefaultColors($type);

            $css .= "/* {$label} Environment Badge */\n";
            $css .= "{$selectorString} {\n";
            $css .= "    content: '{$label}';\n";
            $css .= "    position: relative;\n";
            $css .= "    right: -11px;\n";
            $css .= "    top: -3.5px;\n";
            $css .= "    font-weight: 600;\n";
            $css .= "    font-size: 9px;\n";
            $css .= "    text-transform: uppercase;\n";
            $css .= "    background: {$colors['background']};\n";
            $css .= "    color: {$colors['color']};\n";
            $css .= "    padding: 2px 10px;\n";
            $css .= "    border-radius: 100px;\n";
            $css .= "    z-index: 50;\n";

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

    private static function generateGlobalStyles()
    {
        return "/* Statamic Environment Indicator - Global Styles */\n" .
               "/* Fix for global search background in both light and dark modes */\n" .
               ".global-search {\n" .
               "    background: white;\n" .
               "}\n\n" .
               "html.dark .global-search {\n" .
               "    background: #2B2D30 !important;\n" .
               "}\n\n";
    }

    private static function generatePatternCss($config)
    {
        $patterns = $config['patterns'] ?? [];
        $environments = $config['environments'] ?? [];
        $css = '';

        foreach ($patterns as $type => $pattern) {
            $envNames = $environments[$type] ?? [];
            $css .= self::generatePatternForType($type, $envNames, $pattern);
        }

        return $css;
    }

    private static function generatePatternForType($type, $envNames, $pattern)
    {
        $css = '';
        $patternType = $pattern['type'] ?? 'solid';

        $selectors = ["body.env_type_{$type} .global-header"];
        foreach ($envNames as $envName) {
            $selectors[] = "body.env_{$envName} .global-header";
        }

        // Light mode
        $lightSelectors = implode(",\n", $selectors);
        $css .= "/* Light Mode - " . ucfirst($type) . " Environment */\n";
        $css .= "{$lightSelectors} {\n";
        $css .= self::generatePatternBackground($patternType, $pattern['light_mode'] ?? [], $pattern);
        $css .= "}\n\n";

        // Dark mode
        $darkSelectors = implode(",\nhtml.dark ", array_map(fn($s) => "html.dark {$s}", $selectors));
        $css .= "/* Dark Mode - " . ucfirst($type) . " Environment */\n";
        $css .= "{$darkSelectors} {\n";
        $css .= self::generatePatternBackground($patternType, $pattern['dark_mode'] ?? [], $pattern);
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
               "    );\n";
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
        return "    background: {$primary};\n";
    }
}
