<?php

namespace Golchha21\ReSmushIt;

use CURLFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class ReSmushIt
{
    const VERSION = '1.0.0';
    const ENDPOINT = 'http://api.resmush.it/';
    const TIMEOUT = 10;
    const MAX_FILE_SIZE = 5242880;

    /** @var file */
    protected $file;

    /**
     * starts the optimization process through the validations
     * @param $path string
     * @return boolean array
     */
    public function path($path)
    {
        $this->file = $path;
        $validation = $this->validate();
        if ($validation === true) {
            return $this->process();
        }
        return $validation;
    }

    /**
     * validates the file before processing
     * @param  string
     * @return boolean|array
     */
    protected function validate()
    {
        if (!File::exists($this->file)) {
            return json_encode([
                'error' => '404',
                'error_long' => 'No such file or directory found.'
            ]);
        }
        if (!in_array(File::mimeType($this->file), $this->getMime())) {
            return json_encode([
                'error' => '403',
                'error_long' => 'Forbidden file format provided. Works strictly with jpg, png, gif, tif and bmp files.'
            ]);
        }
        if (File::size($this->file) > self::MAX_FILE_SIZE) {
            return json_encode([
                'error' => '502',
                'error_long' => 'Image provided is too large (must be below 5MB)'
            ]);
        }

        return true;
    }

    /**
     * sets the list of supported mime types by the API
     */
    protected function getMime()
    {
        if (Config::has('resmushit.mime')) {
            return Config::get('resmushit.mime');
        }
        return [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/bmp',
            'image/tiff',
        ];
    }

    protected function process()
    {
        $result = json_decode($this->postCurl(), true);
        if (isset($result['error'])) {
            return json_encode([
                'error' => $result['error'],
                'error_long' => $result['error_long'],
            ]);
        } else {
            $this->getCurl($result['dest']);
            return true;
        }
    }

    /**
     * send the image for optimization
     * @return CURLFile
     */
    protected function postCurl()
    {
        $arguments = [
            "files" => new CURLFile($this->file, File::mimeType($this->file), File::basename($this->file)),
            "qlty" => $this->getPictureQuality(),
            "exif" => $this->getExif(),
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::ENDPOINT);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->getUserAgent());
        curl_setopt($curl, CURLOPT_POSTFIELDS, $arguments);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            $result = curl_error($curl);
        }
        curl_close($curl);
        return $result;
    }

    /**
     * sets the quality of the optimized picture.
     */
    protected function getPictureQuality()
    {
        if (Config::has('resmushit.quality')) {
            return Config::get('resmushit.quality');
        }
        return 92;
    }

    /**
     * sets whether to preserve exif for picture.
     */
    protected function getExif()
    {
        if (Config::has('resmushit.exif')) {
            return Config::get('resmushit.exif');
        }
        return false;
    }

    /**
     * sets the useragent to be used for the API.
     * @return string
     */
    protected function getUserAgent()
    {
        if (Config::has('resmushit.useragent')) {
            return Config::get('resmushit.useragent');
        }
        return "reSmushit".self::VERSION.' - '.env('app.url');
    }

    /**
     * downloads and saves the optimized picture
     * @param  string
     */
    protected function getCurl($destination)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $destination);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->getUserAgent());
        $data = curl_exec($curl);
//        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $file = fopen($this->file, "w+");
        fwrite($file, $data);
        fclose($file);
    }

    /**
     * starts the optimization process through the validations
     * @param $paths array
     * @return boolean array
     */
    public function paths($paths)
    {
        if (is_array($paths)) {
            foreach ($paths as $path) {
                $this->file = $path;
                $validation = $this->validate();
                if ($validation === true) {
                    $result[File::basename($this->file)] = $this->process();
                } else {
                    $result[File::basename($this->file)] = $validation;
                }
            }
            return $result;
        }
        return json_encode([
            'error' => 400,
            'error_long' => 'No url of images provided.',
        ]);
    }

}
