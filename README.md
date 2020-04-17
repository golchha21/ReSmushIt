reSmushit for Laravel
==========

[![Latest Version on Packagist](https://img.shields.io/packagist/v/golchha21/resmushit.svg?style=flat-square)](https://packagist.org/packages/golchha21/resmushit)
[![Build Status](https://img.shields.io/travis/golchha21/resmushit/master.svg?style=flat-square)](https://travis-ci.org/golchha21/resmushit)
[![Total Downloads](https://img.shields.io/packagist/dt/golchha21/resmushit.svg?style=flat-square)](https://packagist.org/packages/golchha21/resmushit)

A Laravel package for the popular image optimization web service [reSmush.it](http://resmush.it/)

## Installation

Install via composer

```bash
composer require golchha21/resmushit
```

### Publish configuration file

```bash
php artisan vendor:publish --provider Golchha21\ReSmushIt\ReSmushItServiceProvider --tag=config
```

## Example configuration file
```php
// config/ReSmushIt.php
<?php

return [
	
    'quality' => 92,

    'mime' => [
        'image/png',
        'image/jpeg',
        'image/gif',
        'image/bmp',
        'image/tiff',
    ],

    'useragent' => 'SOME USER AGENT',

    'exif' => true|false,
];
```

## Usage

``` php
    $file = public_path('images/news1.jpg');
    $files = [
        public_path('images/news1.jpg'),
        public_path('images/news2.jpg'),
        public_path('images/news3.jpg'),
        public_path('images/news4.jpg'),
    ];

    $resmushit = new ReSmushIt();
    $result = $resmushit->path($file);
    $results = $resmushit->paths($files);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email vardhans@ulhas.net instead of using the issue tracker.

## Author

- [Ulhas Vardhan Golchha](https://github.com/golchha21) - *Initial work*

See also the list of [contributors](https://github.com/golchha21/reSmushit/graphs/contributors) who participated in this project.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.