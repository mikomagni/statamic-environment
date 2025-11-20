# Changelog

All notable changes to Statamic Environment Indicator will be documented in this file.

## [Unreleased] - 2.0.0 (Statamic 6 Alpha - Not yet on Marketplace)

> **Note:** This version is for Statamic 6 alpha testing only. Install from GitHub using:
> ```bash
> composer require mikomagni/statamic-environment:dev-v6
> ```
> This will be released to the Statamic Marketplace as v2.0.0 when Statamic 6 is officially released.

### Changed
- **BREAKING**: Updated for Statamic 6 compatibility
- **BREAKING**: Minimum PHP version increased from 8.1 to 8.3
- **BREAKING**: Updated dependency: `statamic/cms` from ^5.0 to ^6.0
- **BREAKING**: Minimum Laravel version increased to 12.0+
- Widget now uses Statamic 6 UI components (`<ui-card>`, `<ui-table>`, `<ui-code>`, etc.)
- Updated CSS selectors for new Statamic 6 header structure
- Simplified widget configuration with single `show_details` option (replaced `always_show_details` and `never_show_details`)
- Simplified pattern configuration - colors now defined directly with `primary` and `secondary` keys (removed `dark_mode`/`light_mode` nesting as Statamic 6 CP is always dark)

### Added
- Auto-regenerating CSS on config file changes
- Backward compatibility with old `dark_mode`/`light_mode` pattern configs
- Added `STATAMIC_STATIC_CACHING_STRATEGY` to widget display
- Added `DEBUGBAR_ENABLED` to widget display

### Migration from 1.x
- Requires PHP 8.3 or higher
- Requires Statamic 6.x
- Requires Laravel 12.x
- All functionality remains identical - only framework compatibility updated
- Pattern configuration can be simplified (remove `dark_mode`/`light_mode` nesting) but old format still works
- Widget configuration can use single `show_details` option instead of separate `always_show_details`/`never_show_details` flags
- Run `composer update` to install updated dependencies

---

## Statamic 5.x Releases (Available on Marketplace)

---

## [1.0.0] - 2025-01-20

### Added
- Initial release for Statamic 5
- Visual header badge showing environment name (Local, Staging, Production)
- Customizable background patterns (stripes, dots, checkerboard, solid)
- Dashboard widget with detailed environment information
- Highly configurable environment types, colors, labels, and patterns
- Translation support with publishable language files
- Body class injection via middleware
- Auto-publishing CSS assets
- Support for custom environment type names
- Widget display control (show details for specific environments, always, or never)

[1.0.0]: https://github.com/mikomagni/statamic-environment/releases/tag/v1.0.0
