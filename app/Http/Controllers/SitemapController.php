<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static pages
        $staticPages = [
            ['url' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => '/about-us', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/portfolio', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/blogs', 'priority' => '0.7', 'changefreq' => 'daily'],
            ['url' => '/contact-us', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/privacy-policy', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => '/terms-conditions', 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap .= $this->generateUrlEntry(
                URL::to($page['url']),
                now()->toISOString(),
                $page['changefreq'],
                $page['priority']
            );
        }

        // Dynamic blog pages
        $blogs = Blog::where('status', 'published')->orderBy('updated_at', 'desc')->get();
        foreach ($blogs as $blog) {
            $sitemap .= $this->generateUrlEntry(
                URL::to('/blog/' . $blog->slug),
                $blog->updated_at->toISOString(),
                'weekly',
                '0.6'
            );
        }

        // Service pages (assuming services are dynamic)
        $services = ['web-development', 'mobile-app-development', 'digital-marketing', 'seo-services', 'e-commerce-solutions'];
        foreach ($services as $service) {
            $sitemap .= $this->generateUrlEntry(
                URL::to('/services/' . $service),
                now()->toISOString(),
                'monthly',
                '0.7'
            );
            
            // Pricing pages
            $sitemap .= $this->generateUrlEntry(
                URL::to('/pricing/' . $service),
                now()->toISOString(),
                'monthly',
                '0.5'
            );
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    private function generateUrlEntry($url, $lastmod, $changefreq, $priority)
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($url) . "</loc>\n" .
               "    <lastmod>" . $lastmod . "</lastmod>\n" .
               "    <changefreq>" . $changefreq . "</changefreq>\n" .
               "    <priority>" . $priority . "</priority>\n" .
               "  </url>\n";
    }
}
