<section class="case-studies-section">
    <div class="case-studies-container px-4 sm:px-6 md:px-8">
        <div class="case-studies-header">
            <span class="case-studies-subtitle">Our Work</span>
            <h2 class="case-studies-title">Featured Case Studies</h2>
            <p class="case-studies-description">Discover how we've helped businesses achieve their goals through
                innovative solutions</p>
        </div>

        <div class="case-studies-grid">
            @foreach ($caseStudies as $caseStudy)
                <div class="case-studies-card" data-category="{{ $caseStudy->category }}">
                    <div class="case-studies-image">
                        <img src="{{ $caseStudy->image }}" alt="{{ $caseStudy->title }}" loading="lazy">
                        <div class="case-studies-overlay">
                            <div class="case-studies-overlay-content">
                                <span class="case-studies-duration">{{ $caseStudy->duration }}</span>
                                <span class="case-studies-role">{{ $caseStudy->role }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="case-studies-content">
                        <div class="case-studies-tags">
                            @foreach ($caseStudy->tags as $tag)
                                <span class="case-studies-tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <h3 class="case-studies-card-title">{{ $caseStudy->title }}</h3>
                        <p class="case-studies-card-description">{{ $caseStudy->description }}</p>
                        <div class="case-studies-stats">
                            @foreach ($caseStudy->stats as $stat)
                                <div class="case-studies-stat">
                                    <span class="case-studies-stat-number">{{ $stat['number'] }}</span>
                                    <span class="case-studies-stat-label">{{ $stat['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                        @if ($caseStudy->link)
                            <a href="{{ $caseStudy->link }}" class="case-studies-link">
                                View Case Study
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="case-studies-cta">
            <h3 class="case-studies-cta-title">Ready to Start Your Project?</h3>
            <p class="case-studies-cta-text">Let's create something amazing together</p>
            <a href="/contact-us" class="case-studies-cta-button">Get in Touch</a>
        </div>
    </div>
</section>
