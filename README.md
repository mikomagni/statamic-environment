# Statamic Environment Indicator

> Visual environment indicators for the Statamic control panel — instantly see whether you're working in Local, Staging, or Production.

The addon adds a colored badge and background pattern to the CP header, plus a dashboard widget with environment details, so you never push the wrong button in the wrong environment again.

## Features

- **Header Badge** — Shows the current environment name in the CP header (Local, Staging, Production, …)
- **Header Background Patterns** — Distinct header patterns per environment (stripes, dots, checkerboard, solid)
- **Dashboard Widget** — Built with native Statamic UI components, with full dark-mode support
- **Highly Configurable** — Custom environment types, labels, icons, colors, and patterns
- **Translation Ready** — Full i18n support with publishable language files
- **Auto-Regenerating CSS** — Edits to the config apply automatically, no build step

## Compatibility

| Addon version | Statamic | PHP    | Laravel |
|---------------|----------|--------|---------|
| **2.x** (this version) | 6.0+ | 8.3+ | 12.0+ |
| 1.x           | 5.0+     | 8.1+   | 10 / 11 |

> Installing on **Statamic 5**? Require `^1.0` instead — see [Upgrading from 1.x](#upgrading-from-1x).

## Installation

Install via Composer:

```bash
composer require mikomagni/statamic-environment
```

Composer automatically resolves the correct release for your Statamic version (2.x for Statamic 6, 1.x for Statamic 5).

The config file is published automatically on install. To (re)publish it manually:

```bash
php artisan vendor:publish --tag=statamic-env-config
```

## Enable the Widget

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

All configuration lives in `config/statamic_environment.php`.

### Environment Types

Map your `APP_ENV` values to environment types. The keys are your type names; the arrays list the `APP_ENV` values that resolve to each type:

```php
'environments' => [
    'local' => ['local'],
    'staging' => ['staging', 'dev'],
    'production' => ['production', 'prod', 'live'],
],
```

An `APP_ENV` that doesn't match any type resolves to `undefined`, which triggers a warning in the widget and the `undefined` icon.

### Labels & Icons

Customize the display text and emoji per type:

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

Style the header badge per type. `border` is optional:

```php
'colors' => [
    'local' => [
        'background' => 'rgba(39, 145, 16, 0.6)',
        'color' => 'white',
        'border' => '1px solid rgba(39, 145, 16, 1)',
    ],
    'staging' => [
        'background' => 'rgba(153, 0, 0, 0.6)',
        'color' => 'white',
        'border' => '1px solid rgba(153, 0, 0, 1)',
    ],
    'production' => [
        'background' => 'transparent',
        'color' => 'white',
        'border' => '1px solid rgba(255, 255, 255, 0.5)',
    ],
],
```

### Widget Details

Control when the widget shows the detailed environment table:

```php
'widget' => [
    'show_details' => ['local', 'staging'], // Show only for these types
    // 'show_details' => true,              // Always show
    // 'show_details' => false,             // Never show
],
```

**Accepted values:**
- **Array** — show details only for the listed environment types, e.g. `['local', 'staging']`
- **`true`** — always show details
- **`false`** — never show details

When enabled, the table reports: `APP_NAME`, `APP_ENV`, `APP_DEBUG`, `APP_URL`, `MAIL_MAILER`, `MAIL_FROM_ADDRESS`, `STATAMIC_GIT_ENABLED`, `STATAMIC_GIT_PUSH`, `STATAMIC_STATIC_CACHING_STRATEGY`, and `DEBUGBAR_ENABLED`.

### Background Patterns

Give each environment a distinct CP header pattern. Colors are defined directly with `primary` and `secondary` keys:

```php
'patterns' => [
    'local' => [
        'type' => 'stripes',
        'angle' => -45,
        'primary' => 'transparent',
        'secondary' => 'rgba(0, 0, 0, 0.6)',
    ],
    'staging' => [
        'type' => 'stripes',
        'angle' => -45,
        'primary' => 'transparent',
        'secondary' => 'rgba(255, 112, 163, 0.2)',
    ],
    'production' => [
        'type' => 'solid',
        'primary' => 'transparent',
    ],
],
```

> **Note:** The Statamic 6 CP header is always dark, so patterns use flat `primary`/`secondary` keys — no `light_mode`/`dark_mode` nesting. The old nested format from 1.x is still read for backward compatibility, but the simplified format is recommended.

#### Pattern Types

**Stripes** — diagonal repeating lines:
```php
'type' => 'stripes',
'angle' => -45,             // Angle in degrees (default: -55)
'size' => 10,              // Stripe width in pixels (default: 10)
'primary' => 'transparent', // Background color
'secondary' => 'rgba(0, 0, 0, 0.6)', // Stripe color
```

**Dots** — polka-dot pattern:
```php
'type' => 'dots',
'size' => '4px',            // Dot size (default: 4px)
'spacing' => '20px',        // Space between dots (default: 20px)
'primary' => '#1a1a1a',     // Background color
'secondary' => '#ff4757',   // Dot color
```

**Checkerboard:**
```php
'type' => 'checkerboard',
'size' => 20,               // Square size in pixels (default: 20)
'primary' => '#1a1a1a',     // Background color
'secondary' => '#ffab00',   // Checkerboard color
```

**Solid** — plain color (only needs `primary`):
```php
'type' => 'solid',
'primary' => 'transparent',
```

## Custom Environment Types

Type names are fully customizable — you're not limited to `local`/`staging`/`production`. Define your own and provide matching `labels`, `icons`, `colors`, and `patterns`:

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

## How It Works

- A CP middleware adds `env_{APP_ENV}` and `env_type_{type}` classes to the `<body>` tag.
- The addon generates a dynamic stylesheet from your config and registers it with the CP. The header badge and background patterns are pure CSS keyed off those body classes.
- The CSS is regenerated automatically whenever the config file changes — no asset compilation or `npm` step required.

## Translation Support

All widget text is translatable and follows Laravel's localization conventions. To customize translations, publish the language files:

```bash
php artisan vendor:publish --tag=statamic-env-lang
```

This copies the files to `resources/lang/vendor/statamic-environment/`, where you can:
- Add new languages by creating a locale folder (e.g. `es`, `fr`, `de`)
- Edit the English strings in `en/widget.php`

### Available Translation Keys

- `viewing_version` — main status message shown in the widget
- `unusual_env_detected` — warning for unrecognized environments
- `app_name`, `app_env`, `app_debug`, `app_url`, `mail_mailer`, `mail_from_address`, `statamic_git_enabled`, `statamic_git_push` — detail table labels
- `true`, `false` — boolean values

## Upgrading from 1.x

Version 2.0 targets Statamic 6 and raises the minimum platform requirements:

- **Statamic 6.0+**, **PHP 8.3+**, **Laravel 12.0+**
- The dashboard widget was rebuilt with native Statamic 6 UI components (full dark-mode support).
- Widget configuration is simplified to a single `show_details` option. The old `always_show_details` / `never_show_details` flags are removed — use `'show_details' => true` or `false` instead.
- Pattern colors use flat `primary`/`secondary` keys instead of `light_mode`/`dark_mode` nesting (the old format still works, but updating is recommended).

To upgrade, require the new version and run `composer update`:

```bash
composer require mikomagni/statamic-environment:^2.0
composer update mikomagni/statamic-environment
```

Staying on Statamic 5? Pin to the 1.x line — it remains installable but is no longer actively maintained:

```bash
composer require mikomagni/statamic-environment:^1.0
```

## License

This addon is open-sourced software licensed under the [MIT license](LICENSE).
