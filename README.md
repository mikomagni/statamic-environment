# Statamic Environment Indicator

> Statamic Environment Indicator is a Statamic addon that provides visual indicators and a widget to help identify your current environment (local, development, production).

## Features

This addon does:

- Displays a visual indicator in the CP header showing your current environment
- Provides a dashboard widget with environment details
- Helps prevent accidents by making the environment clearly visible
- Supports local, development, staging, and production environments
- Configurable environment names and labels


## How to Install

You can install this addon via Composer:

``` bash
composer require mikomagni/statamic-environment
```

run

``` bash
php artisan vendor:publish --tag=statamic-env-config
php artisan vendor:publish --tag=statamic-env-lang  # Optional: for custom translations
```

## Enable Widget

Add the widget to your control panel configuration in `config/statamic/cp.php` file:

```php
'widgets' => [
    [
        'type' => 'statamic_env',
        'width' => 100,
    ],
    // ... other widgets
],
```

## Configuration

After publishing the config file, you can customize the environment mappings in `config/statamic_environment.php`:

### Standard Configuration
```php
return [
    'environments' => [
        'local' => ['local'],
        'staging' => ['staging', 'dev'],
        'production' => ['production', 'prod', 'live'],
    ],
    'labels' => [
        'local' => 'Local',
        'staging' => 'Staging',
        'production' => 'Live',
    ],
    // ... icons and colors
];
```

### Custom Environment Types
You can define completely custom environment type names instead of the standard `local`, `staging`, `production`:

```php
return [
    'environments' => [
        'development' => ['local', 'dev'],
        'testing' => ['test', 'staging', 'qa'],
        'live' => ['production', 'prod'],
        'uat' => ['uat', 'acceptance'],
    ],
    'labels' => [
        'development' => 'Dev',
        'testing' => 'Test',
        'live' => 'Production',
        'uat' => 'UAT',
    ],
    'icons' => [
        'development' => '🛠️',
        'testing' => '🧪',
        'live' => '🚀',
        'uat' => '✅',
        'undefined' => '🚨',
    ],
    'colors' => [
        'development' => [
            'background' => 'rgb(0, 123, 255)',
            'color' => 'white',
        ],
        'testing' => [
            'background' => 'rgb(255, 193, 7)',
            'color' => 'black',
        ],
        'live' => [
            'background' => 'rgb(40, 167, 69)',
            'color' => 'white',
        ],
        'uat' => [
            'background' => 'rgb(108, 117, 125)',
            'color' => 'white',
        ],
    ],
];
```

### Widget Display Options
You can control when the widget shows additional environment details:

```php
'widget' => [
    'show_details' => ['local', 'staging'], // Environment types that show additional info
    'always_show_details' => false,         // Set to true to always show details regardless of environment
    'never_show_details' => false,          // Set to true to never show details regardless of environment
],
```

**Options:**
- `show_details`: Array of environment types that should display the detailed information table
- `always_show_details`: When `true`, always shows details regardless of environment type
- `never_show_details`: When `true`, never shows details regardless of environment type

This allows you to:
- **Define custom environment type names** - Replace `local`, `staging`, `production` with your own naming convention
- **Map multiple APP_ENV values** to each environment type
- **Customize display labels** for each environment type (both in widget and header badges)
- **Change emoji icons** used in the widget
- **Customize badge colors** for each environment type in the header
- **Configure background patterns** for visual environment identification

## Translation Support

The widget includes built-in translation support. All text is translatable and follows Laravel's localization conventions.

### Publishing Language Files

To customize translations, publish the language files:

```bash
php artisan vendor:publish --tag=statamic-env-lang
```

This creates language files in `resources/lang/vendor/statamic-environment/` where you can:
- Translate the widget to other languages by creating language folders (e.g., `es`, `fr`, `de`)
- Customize the English text by editing `en/widget.php`

### Available Translation Keys

- `environment` - "Environment" heading
- `viewing_version` - Main status message
- `unusual_env_detected` - Warning for unknown environments
- Various environment variable labels (`app_name`, `app_env`, etc.)
- Boolean values (`true`, `false`)

## Background Patterns

Configure visual header patterns for each environment to make them easily distinguishable:

### Pattern Types

The addon supports several pattern types:

- **`stripes`** - Diagonal repeating stripes (default for local/staging)
- **`solid`** - Solid color background (default for production)
- **`dots`** - Repeating dot pattern
- **`checkerboard`** - Checkerboard pattern

### Pattern Configuration

Add pattern configuration to your `config/statamic_environment.php`:

```php
'patterns' => [
    'local' => [
        'type' => 'stripes',
        'angle' => -55,
        'size' => 10, // stripe width in pixels
        'light_mode' => [
            'primary' => '#ffffff',
            'secondary' => 'rgba(211, 255, 201, 0.8)',
        ],
        'dark_mode' => [
            'primary' => '#1a1a1a',
            'secondary' => 'rgba(41, 82, 32, 0.8)',
        ],
    ],
    'custom_env' => [
        'type' => 'dots',
        'size' => '4px',       // dot size
        'spacing' => '20px',   // space between dots
        'light_mode' => [
            'primary' => '#ffffff',    // background color
            'secondary' => '#ff6b6b',  // dot color
        ],
        'dark_mode' => [
            'primary' => '#1a1a1a',
            'secondary' => '#ff4757',
        ],
    ],
    'another_custom_env' => [
        'type' => 'checkerboard',
        'size' => 20,          // checkerboard square size in pixels
        'light_mode' => [
            'primary' => '#ffffff',    // background color
            'secondary' => '#ffc107',  // checkerboard color
        ],
        'dark_mode' => [
            'primary' => '#1a1a1a',
            'secondary' => '#ff9800',
        ],
    ],
],
```

### Pattern Options

Each pattern type supports different configuration options:

**Stripes:**
- `angle`: Stripe angle in degrees (default: -55)
- `size`: Stripe width in pixels (default: 10)

**Dots:**
- `size`: Dot size (default: "4px")
- `spacing`: Space between dots (default: "20px")

**Checkerboard:**
- `size`: Size of checkerboard squares in pixels (default: 20)

**Solid:**
- Only requires `primary` color
