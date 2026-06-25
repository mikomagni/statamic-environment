# Changelog

All notable changes to Statamic Environment Indicator will be documented in this file.

## [2.0.0] - 2026-06-25

The first release for **Statamic 6**. This is now the actively maintained line; the 1.x line for Statamic 5 is in maintenance mode.

### Changed
- **BREAKING:** Now requires Statamic 6 (`statamic/cms ^6.0`).
- **BREAKING:** Minimum PHP version raised from 8.1 to 8.3.
- **BREAKING:** Minimum Laravel version raised to 12.0.
- **BREAKING:** Widget display config simplified to a single `show_details` option. The `always_show_details` and `never_show_details` flags are removed — use `'show_details' => true` or `'show_details' => false` instead.
- Dashboard widget rebuilt with native Statamic 6 UI components (`<ui-widget>`, `<ui-table>`, …) for full dark-mode support.
- Updated CSS selectors for the new Statamic 6 header structure.
- Pattern colors are now defined directly with `primary`/`secondary` keys; the `light_mode`/`dark_mode` nesting is no longer needed because the Statamic 6 CP header is always dark.
- Widget now reads configuration via `config()` so it survives `config:cache`.

### Added
- Dynamic CSS regenerates automatically when the config file changes — no build step.
- Backward compatibility for the old `light_mode`/`dark_mode` pattern format from 1.x.
- `STATAMIC_STATIC_CACHING_STRATEGY` row added to the widget detail table.
- `DEBUGBAR_ENABLED` row added to the widget detail table.

### Fixed
- Widget no longer leaves a tall empty area when environment details are hidden — the card now collapses to the single status line.

### Upgrading from 1.x
- Require Statamic 6, PHP 8.3+, and Laravel 12+.
- Replace `always_show_details` / `never_show_details` with `'show_details' => true | false`.
- Optionally flatten pattern configs by removing the `light_mode`/`dark_mode` nesting (the old format still works).
- Run `composer update mikomagni/statamic-environment`.
- Staying on Statamic 5? Pin to `^1.0`.

---

## [1.0.0] - 2025-01-20

### Added
- Initial release for Statamic 5.
- Visual header badge showing the environment name (Local, Staging, Production).
- Customizable background patterns (stripes, dots, checkerboard, solid).
- Dashboard widget with detailed environment information.
- Highly configurable environment types, colors, labels, and patterns.
- Translation support with publishable language files.
- Body class injection via middleware.
- Auto-publishing CSS assets.
- Support for custom environment type names.
- Widget display control (show details for specific environments, always, or never).

[2.0.0]: https://github.com/mikomagni/statamic-environment/releases/tag/v2.0.0
[1.0.0]: https://github.com/mikomagni/statamic-environment/releases/tag/v1.0.0
