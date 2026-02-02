# reSmushit for Laravel

[![Version](https://img.shields.io/packagist/v/golchha21/resmushit)](https://packagist.org/packages/golchha21/resmushit)
[![Downloads](https://img.shields.io/packagist/dt/golchha21/resmushit)](https://packagist.org/packages/golchha21/resmushit)
[![License](https://img.shields.io/packagist/l/golchha21/resmushit)](https://packagist.org/packages/golchha21/resmushit)

A Laravel package for the popular image optimization web service [reSmush.it](http://resmush.it/)

## Installation

Install via composer

``` bash
composer require golchha21/resmushit
```

### Publish configuration file

``` bash
php artisan vendor:publish --provider Golchha21\ReSmushIt\Providers\ServiceProvider --tag=config
```

## Example configuration file

``` php
// config/ReSmushIt.php

return [

    // Keep a copy of the original image
    'original' => true,

    // Image quality (0–100)
    'quality' => 92,

    // Supported mime types
    'mime' => [
        'image/png',
        'image/jpeg',
        'image/gif',
        'image/bmp',
        'image/tiff',
    ],

    // Custom User-Agent for API requests
    'useragent' => 'ReSmushIt v1.3.4',

    // Preserve EXIF metadata
    'exif' => false,
    
    // Maximum allowed file size in bytes (e.g. 5 MB)
    'max_filesize' => 5242880,
];
```

## Usage

### Option 1: Direct class usage

``` php
$file = public_path('images/news1.jpg');
$files = [
    public_path('images/news1.jpg'),
    public_path('images/news2.jpg'),
    public_path('images/news3.jpg'),
    public_path('images/news4.jpg'),
];

$resmushit = new ReSmushIt();
$result  = $resmushit->path($file);
$results = $resmushit->paths($files);
```

### Option 2: Facade usage

``` php
$file = public_path('images/news1.jpg');
$files = [
    public_path('images/news1.jpg'),
    public_path('images/news2.jpg'),
    public_path('images/news3.jpg'),
    public_path('images/news4.jpg'),
];

Optimize::path($file);
Optimize::paths($files);
```

## Error Handling

If the reSmush.it API is unreachable, times out, or returns an invalid response, the optimizer will return a structured error array instead of triggering a fatal error.

### Example

``` php
$result = Optimize::path($file);

if (isset($result['error'])) {
    // Handle the error (log it, retry, notify user, etc.)
}
```

## Return Value

Both `path()` and `paths()` always return arrays.

-   On success, the response contains optimization details returned by the reSmush.it API.
-   On failure, the response contains an `error` key describing the issue, along with additional context when available.

This applies to both single and batch optimization.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

For common issues and environment-specific fixes, see [Troubleshoot](TROUBLESHOOT.md).
If you discover any security-related issues, please email vardhans@ulhas.net instead of using the issue tracker.

## Author

-   [Ulhas Vardhan Golchha](https://github.com/golchha21) -- *Initial work*

See also the list of [contributors](https://github.com/golchha21/reSmushit/graphs/contributors) who participated in this project.

## License

reSmushit for Laravel is open-sourced software licensed under the [MIT license](LICENSE.md).
