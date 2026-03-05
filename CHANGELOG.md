## [Unreleased](https://github.com/faissaloux/pest-plugin-database/compare/v0.2.0...main)

## [v0.2.0](https://github.com/faissaloux/pest-plugin-inside/compare/v0.1.0...v0.2.0) - 2026-03-05
### Added
* Support Postgresql by @faissaloux in https://github.com/faissaloux/pest-plugin-database/pull/1
### Changed
* `->tables->...` by @faissaloux in https://github.com/faissaloux/pest-plugin-database/pull/2

## v0.1.0 - 2026-02-21
### Added
Add expectations by [@faissaloux](https://github.com/faissaloux).
* `expect()->driver->toBe('mysql')`
* `expect()->database->toBe('database')`
* `expect()->database->toContainTables(['users', 'posts'])`
* `expect()->database->toContainTablesCount(9)`
