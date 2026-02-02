# Changelog

All notable changes to `golchha21/resmushit` will be documented in this file

## 1.3.4 - 2026-02-03

### Fixed
- Prevented fatal errors when the reSmush.it API is unreachable or returns invalid responses
- Restored file size validation to reject oversized images before upload
- Gracefully handle cURL, SSL, and JSON decoding failures

### Improved
- Image optimization now always returns a structured array instead of triggering runtime errors
- Batch optimization (`paths()`) no longer fails entirely if a single file cannot be optimized
- Internal request flow refactored to improve reliability and testability

### Tests
- Added unit test to validate file size rejection behavior
- Strengthened test coverage around error handling paths

### Documentation
- Updated README with explicit error handling and return value guarantees
- Added a dedicated Troubleshooting guide for SSL certificate issues

## 1.3.3 - 2026-02-03

### Fixed
- Prevented fatal errors when the reSmush.it API is unreachable or returns invalid responses
- Gracefully handle cURL and JSON decoding failures

### Improved
- Image optimization now always returns a structured array instead of triggering runtime errors
- Batch optimization (`paths()`) no longer fails entirely if a single file cannot be optimized
- Internal HTTP call extracted to improve testability and reliability

### Internal
- Refactored optimization flow to make the package fully testable with PHPUnit
- Added comprehensive unit and feature test coverage

## 1.3.2 - 2025-04-13

- Added Laravel 12 support
- Version bump

## 1.3.1 - 2024-06-29

- Added Laravel 11 support
- Version bump

## 1.3.0 - 2024-03-02

- Merged a [pull request](https://github.com/golchha21/ReSmushIt/pull/1) from [@atastycookie](https://github.com/atastycookie) which improves security to avoid MITM attacks 
- Version bump

## 1.2.9 - 2023-05-06

- Added Laravel 10 support
- Version bump

## 1.2.8 - 2022-05-08

- Moved Laravel/framework from require-dev to require
- Added Laravel 9 support
- Version bump

## 1.2.7 - 2022-01-14

- Updated const version
- Updated Changelog.md
- Version bump

## 1.2.6 - 2022-01-09

- Version bump
- Updated Readme.md & Changelog.md

## 1.2.5 - 2022-01-09

- Version bump

## 1.2.4 - 2022-01-09

- Changed author website from http to https

## 1.2.3 - 2021-02-06

- Now supports Laravel 8
- Version bump

## 1.2.2 - 2020-04-25

- Invalid character in composer removed
- Version bump

## 1.2.1 - 2020-04-25

- Version bump

## 1.2.0 - 2020-04-25

- Moved & Renamed the Service Provider
- Now supports Facades
- Updated README
- Updated CHANGELOG
- Version bump composer.json

## 1.1.0 - 2020-04-18

- Ability to save the original images
- configuration value load error now rectified
- Reformatted the code
- Updated the class documentation
- Updated CHANGELOG
- Version bump composer.json

## 1.0.4 - 2020-04-17

- Made the const Private 
- Updated CHANGELOG
- Updated README
- Version bump composer.json

## 1.0.3 - 2020-04-17

- Updated CHANGELOG

## 1.0.2 - 2020-04-17

- Updated composer.json with version details.

## 1.0.1 - 2020-04-17

- Updates to composer.json & README

## 1.0.0 - 2020-04-17

- initial release
