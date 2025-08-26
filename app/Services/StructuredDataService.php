<?php

namespace App\Services;

class StructuredDataService
{
    public static function getOrganizationSchema()
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => "Linkuss",
            "url" => "https://linkuss.com",
            "logo" => "https://linkuss.com/assets/favicon/logo.png",
            "description" => "Linkuss is a leading web development and digital solutions company providing professional web design, development, and IT services to help businesses grow online.",
            "foundingDate" => "2020",
            "contactPoint" => [
                "@type" => "ContactPoint",
                "contactType" => "Customer Service",
                "email" => "support@linkuss.com",
                "areaServed" => "Global",
                "availableLanguage" => ["English", "Hindi"]
            ],
            "address" => [
                "@type" => "PostalAddress",
                "addressCountry" => "IN",
                "addressRegion" => "India"
            ],
            "sameAs" => [
                "https://twitter.com/linkuss",
                "https://www.linkedin.com/in/linkuss-digital-solutions-8b014537b",
                "https://www.facebook.com/linkuss"
            ],
            "services" => [
                "Web Development",
                "Mobile App Development",
                "Digital Marketing",
                "SEO Services",
                "E-commerce Solutions"
            ]
        ];
    }

    public static function getWebsiteSchema()
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "WebSite",
            "name" => "Linkuss",
            "url" => "https://linkuss.com",
            "description" => "Professional web development, digital solutions, and IT services for business growth.",
            "publisher" => self::getOrganizationSchema(),
            "potentialAction" => [
                "@type" => "SearchAction",
                "target" => "https://linkuss.com/search?q={search_term_string}",
                "query-input" => "required name=search_term_string"
            ]
        ];
    }

    public static function getBlogPostSchema($blog)
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $blog->title,
            "description" => $blog->meta_description ?? substr(strip_tags($blog->content), 0, 160),
            "image" => $blog->featured_image ? url($blog->featured_image) : url('images/default-blog.jpg'),
            "author" => [
                "@type" => "Person",
                "name" => $blog->author ?? "Linkuss Team"
            ],
            "publisher" => self::getOrganizationSchema(),
            "datePublished" => $blog->created_at->toISOString(),
            "dateModified" => $blog->updated_at->toISOString(),
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => url('/blog/' . $blog->slug)
            ],
            "keywords" => $blog->tags ?? "web development, digital solutions"
        ];
    }

    public static function getServiceSchema($service)
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => $service['name'],
            "description" => $service['description'],
            "provider" => self::getOrganizationSchema(),
            "areaServed" => "Global",
            "serviceType" => $service['type'] ?? "Digital Service",
            "offers" => [
                "@type" => "Offer",
                "availability" => "https://schema.org/InStock",
                "priceCurrency" => "USD",
                "priceRange" => $service['price_range'] ?? "$500-$5000"
            ]
        ];
    }

    public static function getBreadcrumbSchema($breadcrumbs)
    {
        $listItems = [];
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $listItems[] = [
                "@type" => "ListItem",
                "position" => $index + 1,
                "name" => $breadcrumb['name'],
                "item" => $breadcrumb['url']
            ];
        }

        return [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $listItems
        ];
    }

    public static function getFAQSchema($faqs)
    {
        $mainEntity = [];
        foreach ($faqs as $faq) {
            $mainEntity[] = [
                "@type" => "Question",
                "name" => $faq['question'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $faq['answer']
                ]
            ];
        }

        return [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $mainEntity
        ];
    }

    public static function getLocalBusinessSchema()
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "LocalBusiness",
            "name" => "Linkuss",
            "image" => "https://linkuss.com/assets/favicon/logo.png",
            "telephone" => "+1-XXX-XXX-XXXX",
            "email" => "support@linkuss.com",
            "address" => [
                "@type" => "PostalAddress",
                "addressCountry" => "IN"
            ],
            "geo" => [
                "@type" => "GeoCoordinates",
                "latitude" => "28.6139",
                "longitude" => "77.2090"
            ],
            "url" => "https://linkuss.com",
            "sameAs" => [
                "https://twitter.com/linkuss",
                "https://www.linkedin.com/in/linkuss-digital-solutions-8b014537b",
                "https://www.facebook.com/linkuss"
            ],
            "openingHoursSpecification" => [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens" => "09:00",
                "closes" => "18:00"
            ]
        ];
    }
}
