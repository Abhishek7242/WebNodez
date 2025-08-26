<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IndexNowService
{
    protected $endpoint;
    protected $key;

    public function __construct()
    {
        $this->endpoint = config('services.indexnow.endpoint');
        $this->key = config('services.indexnow.key');
    }

    public function submitUrls(array $urls)
    {
        $response = Http::post($this->endpoint, [
            'host' => parse_url(config('app.url'), PHP_URL_HOST),
            'key' => $this->key,
            'keyLocation' => config('app.url') . '/' . $this->key . '.txt',
            'urlList' => $urls,
        ]);

        return [
            'status_code' => $response->status(),
            'body' => $response->body()
        ];
    }
}
