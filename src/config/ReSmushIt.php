<?php

return [
    /*
    |--------------------------------------------------------------------------
    | reSmushit configuration file
    |--------------------------------------------------------------------------
     */

    'original' => false,

    'quality' => 92,

    'mime' => [
        'image/png',
        'image/jpeg',
        'image/gif',
        'image/bmp',
        'image/tiff',
    ],

    'useragent' => 'ReSmushIt v1.3.4',

    'exif' => false,

    'max_filesize' => 5242880, // 5 MB in bytes
];
