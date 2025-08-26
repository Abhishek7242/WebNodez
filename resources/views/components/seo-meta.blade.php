@php
use App\Services\SEOService;

$seoData = SEOService::generateMetaTags($metaData ?? []);
@endphp

<!-- Primary Meta Tags -->
<title>{{ $seoData['title'] }}</title>
<meta name="title" content="{{ $seoData['title'] }}">
<meta name="description" content="{{ $seoData['description'] }}">
<meta name="keywords" content="{{ $seoData['keywords'] }}">
<meta name="author" content="Linkuss">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="googlebot" content="index, follow">

<!-- Canonical URL -->
<link rel="canonical" href="{{ SEOService::generateCanonicalUrl($canonicalUrl ?? null) }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $seoData['type'] }}">
<meta property="og:url" content="{{ $seoData['url'] }}">
<meta property="og:title" content="{{ $seoData['title'] }}">
<meta property="og:description" content="{{ $seoData['description'] }}">
<meta property="og:image" content="{{ $seoData['image'] }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="{{ $seoData['site_name'] }}">
<meta property="og:locale" content="{{ $seoData['locale'] }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $seoData['url'] }}">
<meta name="twitter:title" content="{{ $seoData['title'] }}">
<meta name="twitter:description" content="{{ $seoData['description'] }}">
<meta name="twitter:image" content="{{ $seoData['image'] }}">
<meta name="twitter:creator" content="@linkuss">
<meta name="twitter:site" content="@linkuss">

<!-- Additional SEO Meta Tags -->
<meta name="theme-color" content="#1a202c">
<meta name="msapplication-TileColor" content="#1a202c">
<meta name="application-name" content="Linkuss">

@if(isset($readingTime))
<meta name="twitter:label1" content="Reading time">
<meta name="twitter:data1" content="{{ $readingTime }} min read">
@endif

@if(isset($publishedTime))
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif

@if(isset($modifiedTime))
<meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif

@if(isset($tags) && is_array($tags))
@foreach($tags as $tag)
<meta property="article:tag" content="{{ $tag }}">
@endforeach
@endif
