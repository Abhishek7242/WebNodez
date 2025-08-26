<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowHelper
{
    protected static $endpoint = "https://api.indexnow.org/indexnow";
    protected static $host     = "linkuss.com"; // your domain
    protected static $key      = "597f5d7528e74f8495263c3e4956c3d3"; // your IndexNow key
    protected static $keyPath  = "https://linkuss.com/597f5d7528e74f8495263c3e4956c3d3.txt";

    /**
     * Ping IndexNow using an Eloquent model that has getIndexNowUrl()
     */
    public static function ping($model)
    {
        if (!method_exists($model, 'getIndexNowUrl')) {
            Log::warning("IndexNow: Model does not have getIndexNowUrl()");
            return false;
        }

        return self::pingUrl($model->getIndexNowUrl());
    }

    /**
     * Ping IndexNow with a direct URL
     */
    public static function pingUrl($url)
    {
        try {
            $response = Http::get(self::$endpoint, [
                "url"        => $url,
                "host"       => self::$host,
                "key"        => self::$key,
                "keyLocation" => self::$keyPath,
            ]);

            if ($response->successful()) {
                Log::info("✅ IndexNow ping success for: {$url}");
                return true;
            }

            Log::warning("⚠️ IndexNow ping failed for {$url} - Status: " . $response->status());
            return false;
        } catch (\Exception $e) {
            Log::error("❌ IndexNow ping exception for {$url}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Old method for backward compatibility
     */
    public static function submitUrl($url)
    {
        return self::pingUrl($url);
    }
}
