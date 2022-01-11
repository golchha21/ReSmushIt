reSmushit for Laravel
==========

[![Latest Stable Version](http://poser.pugx.org/golchha21/resmushit/v)](https://packagist.org/packages/golchha21/resmushit)
[![Total Downloads](http://poser.pugx.org/golchha21/resmushit/downloads)](https://packagist.org/packages/golchha21/resmushit)
[![License](http://poser.pugx.org/golchha21/resmushit/license)](https://packagist.org/packages/golchha21/resmushit)

A Laravel package for the popular image optimization web service [reSmush.it](http://resmush.it/)

## Installation

Install via composer

```bash
composer require golchha21/resmushit
```

### Publish configuration file

```bash
php artisan vendor:publish --provider Golchha21\ReSmushIt\Providers\ServiceProvider --tag=config
```

## Example configuration file

```php
// config/ReSmushIt.php

return [

    'original' => true|false,
    
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

###### Option 1
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

###### Option 2
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

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email vardhans@ulhas.net instead of using the issue tracker.

## Author

- [Ulhas Vardhan Golchha](https://github.com/golchha21) - *Initial work*

See also the list of [contributors](https://github.com/golchha21/reSmushit/graphs/contributors) who participated in this project.

## License

reSmushit for Laravel is open-sourced software licensed under the [MIT license](LICENSE.md).
