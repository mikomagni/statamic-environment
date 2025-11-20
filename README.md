# Statamic Environment Indicator

> **🚧 DEV BRANCH - Statamic 6 Alpha**
> This is the development branch for Statamic 6 compatibility. For production use with Statamic 5, please use the [main branch](../../tree/main) or install v1.x.

> Visual environment indicators for Statamic 6 control panel - helps you instantly identify which environment you're working in.

## Features

- **Visual Header Badge** - Displays environment name in the CP header (Local, Staging, Production)
- **Background Patterns** - Customizable header patterns (stripes, dots, checkerboard, solid)
- **Dashboard Widget** - Shows detailed environment information
- **Highly Configurable** - Custom environment types, colors, labels, and patterns
- **Translation Ready** - Full i18n support
- **Auto-Regenerating CSS** - Changes to config or CSS apply automatically


## Requirements

- **Statamic 6.0+** (alpha)
- **Laravel 12.0+**
- **PHP 8.3+**

> **Note:** For Statamic 5, use version 1.x from the main branch.

## Installation

### For Statamic 6 Alpha Testing

Install from the v6 branch:

```bash
composer require mikomagni/statamic-environment:dev-v6
```

Or add to your `composer.json`:

```json
{
    "require": {
        "mikomagni/statamic-environment": "dev-v6"
    }
}
```

### For Statamic 5 (Stable)

```bash
composer require mikomagni/statamic-environment:^1.0
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag=statamic-env-config
```

## Enable Widget

Add the widget to your control panel in `config/statamic/cp.php`:

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

All configuration is done in `config/statamic_environment.php`.

### Environment Types

Define which `APP_ENV` values map to which environment types:

```php
'environments' => [
    'local' => ['local'],
    'staging' => ['staging', 'dev'],
    'production' => ['production', 'prod', 'live'],
],
```

### Labels & Icons

Customize the display text and emojis:

```php
'labels' => [
    'local' => 'Local',
    'staging' => 'Staging',
    'production' => 'Live',
],

'icons' => [
    'local' => '👨‍💻',
    'staging' => '🔥',
    'production' => '🚀',
    'undefined' => '🚨',
],
```

### Badge Colors

Customize the header badge colors:

```php
'colors' => [
    'local' => [
        'background' => 'rgb(39, 145, 16)',
        'color' => 'white',
    ],
    'staging' => [
        'background' => 'rgb(153, 0, 0)',
        'color' => 'white',
    ],
    'production' => [
        'background' => 'rgb(43, 45, 48)',
        'color' => 'white',
        'border' => '1px solid white',
    ],
],
```

### Widget Details

Control when the widget shows detailed environment information:

```php
'widget' => [
    'show_details' => ['local', 'staging'], // Show for specific environments
    // 'show_details' => true,              // Always show
    // 'show_details' => false,             // Never show
],
```

**Options:**
- **Array** - Show details only for specified environment types: `['local', 'staging']`
- **`true`** - Always show details for all environments
- **`false`** - Never show details

### Background Patterns

Add visual patterns to the CP header for instant environment identification:

```php
'patterns' => [
    'local' => [
        'type' => 'stripes',
        'angle' => -55,
        'primary' => '#1a1a1a',
        'secondary' => 'rgba(41, 82, 32, 0.8)',
    ],
    'staging' => [
        'type' => 'stripes',
        'angle' => -55,
        'primary' => '#1a1a1a',
        'secondary' => 'rgba(82, 32, 32, 0.8)',
    ],
    'production' => [
        'type' => 'solid',
        'primary' => '#1a1a1a',
    ],
],
```

#### Pattern Types

**Stripes** (diagonal lines):
```php
'type' => 'stripes',
'angle' => -55,              // Angle in degrees
'primary' => '#1a1a1a',      // Background color
'secondary' => 'rgba(...)',  // Stripe color
```

**Dots** (polka dot pattern):
```php
'type' => 'dots',
'size' => '4px',             // Dot size
'spacing' => '20px',         // Space between dots
'primary' => '#1a1a1a',      // Background color
'secondary' => 'rgba(...)',  // Dot color
```

**Checkerboard**:
```php
'type' => 'checkerboard',
'size' => 20,                // Square size in pixels
'primary' => '#1a1a1a',      // Background color
'secondary' => 'rgba(...)',  // Checkerboard color
```

**Solid** (plain color):
```php
'type' => 'solid',
'primary' => '#1a1a1a',      // Background color
```

> **Note:** Statamic 6 CP header is always dark, so colors are defined directly with `primary` and `secondary` keys (no light/dark mode nesting needed).

## Custom Environment Types

You can completely customize environment type names:

```php
return [
    'environments' => [
        'development' => ['local', 'dev'],
        'testing' => ['test', 'qa', 'staging'],
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

    'patterns' => [
        'development' => [
            'type' => 'stripes',
            'angle' => -55,
            'primary' => '#1a1a1a',
            'secondary' => 'rgba(0, 123, 255, 0.3)',
        ],
        'testing' => [
            'type' => 'dots',
            'size' => '5px',
            'spacing' => '15px',
            'primary' => '#1a1a1a',
            'secondary' => 'rgba(255, 193, 7, 0.4)',
        ],
        'live' => [
            'type' => 'solid',
            'primary' => '#1a1a1a',
        ],
        'uat' => [
            'type' => 'checkerboard',
            'size' => 15,
            'primary' => '#1a1a1a',
            'secondary' => 'rgba(108, 117, 125, 0.3)',
        ],
    ],
];
```

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
