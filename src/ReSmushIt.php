<?php

namespace Golchha21\ReSmushIt;

class ReSmushIt
{
    public function path(string $file): array
    {
        if (!is_file($file)) {
            return [
                'error' => 'File does not exist',
                'file'  => $file,
            ];
        }

        $mime = mime_content_type($file);

        if (!in_array($mime, config('ReSmushIt.mime', []), true)) {
            return [
                'error' => 'Unsupported mime type',
                'mime'  => $mime,
                'file'  => $file,
            ];
        }

        return $this->optimizeFile($file);
    }

    public function paths(array $files): array
    {
        $results = [];

        foreach ($files as $file) {
            $results[] = $this->path($file);
        }

        return $results;
    }

    /**
     * This method existed logically before — now it is explicit and safe
     */
    protected function optimizeFile(string $file): array
    {
        $payload = [
            'files' => new \CURLFile($file),
        ];

        $response = $this->callApi($payload);

        if (!is_array($response)) {
            return [
                'error' => 'Invalid API response',
                'file'  => $file,
            ];
        }

        if (isset($response['error'])) {
            return $response + ['file' => $file];
        }

        /**
         * Preserve original file if configured
         */
        if (config('ReSmushIt.original', false) && isset($response['dest'])) {
            copy($file, $file . '.original');
        }

        return $response;
    }

    /**
     * Extracted HTTP call (NEW)
     * Everything that used to be inline lives here now
     */
    protected function callApi(array $payload): array
    {
        $quality = config('ReSmushIt.quality', 92);
        $endpoint = 'https://api.resmush.it/?qlty=' . $quality;

        if (config('ReSmushIt.exif', false)) {
            $endpoint .= '&exif=1';
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_USERAGENT      => config('ReSmushIt.useragent', 'ReSmushIt'),
            CURLOPT_TIMEOUT        => 30,
        ]);

        $rawResponse = curl_exec($ch);

        if ($rawResponse === false) {
            $error = curl_error($ch);
            curl_close($ch);

            return [
                'error' => $error ?: 'cURL error',
            ];
        }

        curl_close($ch);

        $decoded = json_decode($rawResponse, true);

        if (!is_array($decoded)) {
            return [
                'error' => 'Unable to decode API response',
                'raw'   => $rawResponse,
            ];
        }

        return $decoded;
    }
}
