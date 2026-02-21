## [Unreleased](https://github.com/faissaloux/pest-plugin-inside/compare/v1.10.0...main)

## v0.1.0 - 2026-02-21
### Added
Add expectations by [@faissaloux](https://github.com/faissaloux).
* `expect()->driver->toBe('mysql')`
* `expect()->database->toBe('database')`
* `expect()->database->toContainTables(['users', 'posts'])`
* `expect()->database->toContainTablesCount(9)`
