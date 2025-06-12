<section class="culture-section section-wrapper -color-primary">
    <!-- Decorative Elements -->
    <div class="culture-decoration decorative-elements">
        <div class="culture-decoration-top top-gradient"></div>
        <div class="culture-decoration-bottom bottom-gradient"></div>
    </div>

    <div class="culture-container container">
        <!-- Section Header -->
        <div class="culture-header section-header">
            <div class="culture-badge header-highlight">
                <div class="culture-divider divider"></div>
                <span class="culture-tagline tagline text-primary">Life at WebNodez</span>
                <div class="culture-divider divider reverse"></div>
            </div>
            <h2 class="culture-title heading">Work. Grow. Belong.</h2>
            <p class="culture-description description">
                We've built a culture that empowers people to do the best work of their lives. Here's what it's like to
                be part of our journey.
            </p>
        </div>

        <!-- Culture Cards -->
        <div class="culture-cards cards-grid">
            <!-- Card 1 -->
            <div class="culture-card-group card-group">
                <div class="culture-card-bg card-bg rotate"></div>
                <div class="culture-card card">
                    <div class="culture-card-icon icon-wrapper rotate">
                        <i class="fas fa-comments text-white text-xl"></i>
                    </div>
                    <div class="culture-card-content card-content">
                        <h3 class="culture-card-title card-title">Transparent Communication</h3>
                        <p class="culture-card-description card-description">We foster a culture where openness and
                            trust build stronger teams. Every voice counts, always.</p>
                        {{-- <div class="card-footer">
                            <span class="link-text">Learn More</span>
                            <i class="fas fa-arrow-right icon-transition"></i>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="culture-card-group card-group">
                <div class="culture-card-bg card-bg rotate-reverse"></div>
                <div class="culture-card card">
                    <div class="culture-card-icon icon-wrapper rotate-reverse">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="culture-card-content card-content">
                        <h3 class="culture-card-title card-title">People-First Culture</h3>
                        <p class="culture-card-description card-description">We value flexibility, creativity, and
                            well-being, supporting our people both personally and professionally.</p>
                        {{-- <div class="card-footer">
                            <span class="link-text">Learn More</span>
                            <i class="fas fa-arrow-right icon-transition"></i>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="culture-card-group card-group">
                <div class="culture-card-bg card-bg rotate"></div>
                <div class="culture-card card">
                    <div class="culture-card-icon icon-wrapper rotate">
                        <i class="fas fa-trophy text-white text-xl"></i>
                    </div>
                    <div class="culture-card-content card-content">
                        <h3 class="culture-card-title card-title">Shared Success</h3>
                        <p class="culture-card-description card-description">We win together. Collaboration is in our
                            DNA — with clients and teammates alike.</p>
                        {{-- <div class="card-footer">
                            <span class="link-text">Learn More</span>
                            <i class="fas fa-arrow-right icon-transition"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Culture Stats -->
        <div class="culture-stats stats-grid">
            <div class="culture-stat-item stat-item">
                <div class="culture-stat-value stat-value text-primary">98%</div>
                <p class="culture-stat-label stat-label">Employee Satisfaction</p>
            </div>
            <div class="culture-stat-item stat-item">
                <div class="culture-stat-value stat-value text-secondary">{{ $achievements[4]['number'] }}+</div>
                <p class="culture-stat-label stat-label">Team Members</p>
            </div>
            <div class="culture-stat-item stat-item">
                <div class="culture-stat-value stat-value text-primary">5+</div>
                <p class="culture-stat-label stat-label">Countries Reached</p>
            </div>
            <div class="culture-stat-item stat-item">
                <div class="culture-stat-value stat-value text-secondary">{{ $achievements[1]['number'] }}+</div>
                <p class="culture-stat-label stat-label">Projects Completed</p>
            </div>
        </div>

        <!-- Final Call -->
        <div class="culture-cta final-call">
            <p class="culture-cta-description call-description">We're not just building software — we're building a
                culture of impact, growth, and shared success.</p>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=youremail@example.com&su=Job Inquiry&body=Hi, I'm interested in joining your team."
                target="_blank" class=" culture-cta-button animated-button cta-button">
                <span>Join Our Team</span>
                <i class="fas fa-arrow-right icon-transition ml-3"></i>
            </a>

        </div>
    </div>
</section>
