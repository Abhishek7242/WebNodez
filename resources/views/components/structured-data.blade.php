@php
use App\Services\SEOService;

$schemaData = [];

// Add organization schema to all pages
$schemaData[] = SEOService::generatePageSchema('organization', []);

// Add website schema to home page
if (request()->is('/')) {
    $schemaData[] = SEOService::generatePageSchema('website', []);
}

// Add specific schema based on page type
if (isset($schemaType) && isset($schemaData_custom)) {
    $schemaData[] = SEOService::generatePageSchema($schemaType, $schemaData_custom);
}

// Add breadcrumb schema if breadcrumbs are provided
if (isset($breadcrumbs) && is_array($breadcrumbs)) {
    $schemaData[] = SEOService::generatePageSchema('breadcrumb', $breadcrumbs);
}

// Add FAQ schema if FAQs are provided
if (isset($faqs) && is_array($faqs)) {
    $schemaData[] = SEOService::generatePageSchema('faq', $faqs);
}
@endphp

@foreach($schemaData as $schema)
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endforeach
