<?php

namespace App\Services;

use Illuminate\Support\Str;

class SEOService
{
    public static function generateMetaTags($data)
    {
        $defaults = [
            'title' => 'Linkuss - Web Development & Digital Solutions',
            'description' => 'Professional web development, digital solutions, and IT services for business growth. Expert team delivering innovative solutions.',
            'keywords' => 'web development, digital solutions, IT services, software development, web design, mobile apps',
            'image' => asset('images/og-image.jpg'),
            'url' => url()->current(),
            'type' => 'website',
            'site_name' => 'Linkuss',
            'locale' => 'en_US'
        ];

        $meta = array_merge($defaults, $data);

        // Ensure title is within optimal length (50-60 characters)
        if (strlen($meta['title']) > 60) {
            $meta['title'] = Str::limit($meta['title'], 57, '...');
        }

        // Ensure description is within optimal length (150-160 characters)
        if (strlen($meta['description']) > 160) {
            $meta['description'] = Str::limit($meta['description'], 157, '...');
        }

        return $meta;
    }

    public static function generateCanonicalUrl($url = null)
    {
        return $url ?? url()->current();
    }

    public static function generateHreflangTags($languages = [])
    {
        $tags = [];
        foreach ($languages as $lang => $url) {
            $tags[] = '<link rel="alternate" hreflang="' . $lang . '" href="' . $url . '">';
        }
        return implode("\n", $tags);
    }

    public static function optimizeImageAlt($filename, $context = '')
    {
        $alt = str_replace(['-', '_'], ' ', pathinfo($filename, PATHINFO_FILENAME));
        $alt = ucwords($alt);
        
        if ($context) {
            $alt = $context . ' - ' . $alt;
        }
        
        return $alt;
    }

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public static function extractKeywords($content, $limit = 10)
    {
        // Remove HTML tags and convert to lowercase
        $text = strtolower(strip_tags($content));
        
        // Remove common stop words
        $stopWords = ['the', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by', 'is', 'are', 'was', 'were', 'be', 'been', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'must', 'can', 'this', 'that', 'these', 'those', 'a', 'an'];
        
        // Extract words
        $words = str_word_count($text, 1);
        $words = array_filter($words, function($word) use ($stopWords) {
            return strlen($word) > 3 && !in_array($word, $stopWords);
        });
        
        // Count word frequency
        $wordCount = array_count_values($words);
        arsort($wordCount);
        
        return array_slice(array_keys($wordCount), 0, $limit);
    }

    public static function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200); // Average reading speed: 200 words per minute
        return max(1, $readingTime);
    }

    public static function generatePageSchema($type, $data)
    {
        switch ($type) {
            case 'article':
                return StructuredDataService::getBlogPostSchema($data);
            case 'service':
                return StructuredDataService::getServiceSchema($data);
            case 'organization':
                return StructuredDataService::getOrganizationSchema();
            case 'website':
                return StructuredDataService::getWebsiteSchema();
            case 'breadcrumb':
                return StructuredDataService::getBreadcrumbSchema($data);
            case 'faq':
                return StructuredDataService::getFAQSchema($data);
            case 'local_business':
                return StructuredDataService::getLocalBusinessSchema();
            default:
                return StructuredDataService::getWebsiteSchema();
        }
    }
}
