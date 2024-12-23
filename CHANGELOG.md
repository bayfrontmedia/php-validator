# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

- `Added` for new features.
- `Changed` for changes in existing functionality.
- `Deprecated` for soon-to-be removed features.
- `Removed` for now removed features.
- `Fixed` for any bug fixes.
- `Security` in case of vulnerabilities

## [4.0.2] - 2024.12.23

### Added

- Tested up to PHP v8.4.
- Updated GitHub issue templates.

## [4.0.1] - 2024.10.31

### Fixed

- Fixed bug in `Validator` class which was attempting to validate non-required fields.

### [4.0.0] - 2024.09.09

### Changed

- Rewrote entire library to utilize a `ValidationRuleInterface` rather than static methods. 
This update is not backwards compatible.

## [3.0.0] - 2023.05.14

### Changed

- Changed `as` method to return `bool` instead of throwing an exception.

## [2.2.0] - 2023.05.11

### Added

- Added `$require_existing` to `as` method.

## [2.1.0] - 2023.05.03

### Added

- Added `uuid` and `uuidv4` methods.

## [2.0.0] - 2023.01.26

### Added

- Added support for PHP 8.

## [1.3.0] - 2021.02.05

### Added

- Added the ability to specify multiple rules using the `as` method.

## [1.2.0] - 2021.01.27

### Added

- Added the `array` rule to the `as` method.

## [1.1.0] - 2021.01.13

### Added

- Added the following methods:
    - `null`
    - `numeric`
    - `date`
    - `as`

## [1.0.1] - 2020.09.14

### Fixed

- Updated accuracy of the `json` method.

## [1.0.0] - 2020.07.27

### Added

- Initial release.