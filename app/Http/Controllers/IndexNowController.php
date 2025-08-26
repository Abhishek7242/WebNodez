<?php

namespace App\Http\Controllers;

use App\Services\IndexNowService;
use Illuminate\Support\Facades\Http;

class IndexNowController extends Controller
{
    public function submitSitemap()
    {
        $sitemapUrl = url('/sitemap.xml'); // adjust if needed
        $xml = Http::get($sitemapUrl)->body();

        $sitemap = simplexml_load_string($xml);
        $sitemap->registerXPathNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $urls = [];
        foreach ($sitemap->xpath('//sm:url/sm:loc') as $loc) {
            $urls[] = (string) $loc;
        }

        if (empty($urls)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No URLs found in sitemap',
                'sitemap_url' => $sitemapUrl
            ]);
        }

        $indexNow = new IndexNowService();
        $response = $indexNow->submitUrls($urls);

        return response()->json([
            'status' => $response ? 'success' : 'failed',
            'submitted_urls' => $urls,
            'api_response' => $response
        ]);
    }
}
