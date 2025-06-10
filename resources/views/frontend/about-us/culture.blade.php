<section class="section-wrapper -color-primary">
    <!-- Decorative Elements -->
    <div class="decorative-elements">
        <div class="top-gradient"></div>
        <div class="bottom-gradient"></div>
    </div>

    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="header-highlight">
                <div class="divider"></div>
                <span class="tagline text-primary">Life at WebNodez</span>
                <div class="divider reverse"></div>
            </div>
            <h2 class="heading">Work. Grow. Belong.</h2>
            <p class="description">
                We've built a culture that empowers people to do the best work of their lives. Here's what it's like to
                be part of our journey.
            </p>
        </div>

        <!-- Culture Cards -->
        <div class="cards-grid">
            <!-- Card 1 -->
            <div class="card-group">
                <div class="card-bg rotate"></div>
                <div class="card">
                    <div class="icon-wrapper rotate">
                        <i class="fas fa-comments text-white text-xl"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Transparent Communication</h3>
                        <p class="card-description">We foster a culture where openness and trust build stronger teams. Every voice counts, always.</p>
                        {{-- <div class="card-footer">
                            <span class="link-text">Learn More</span>
                            <i class="fas fa-arrow-right icon-transition"></i>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card-group">
                <div class="card-bg rotate-reverse"></div>
                <div class="card">
                    <div class="icon-wrapper rotate-reverse">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">People-First Culture</h3>
                        <p class="card-description">We value flexibility, creativity, and well-being, supporting our people both personally and professionally.</p>
                        {{-- <div class="card-footer">
                            <span class="link-text">Learn More</span>
                            <i class="fas fa-arrow-right icon-transition"></i>
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card-group">
                <div class="card-bg rotate"></div>
                <div class="card">
                    <div class="icon-wrapper rotate">
                        <i class="fas fa-trophy text-white text-xl"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Shared Success</h3>
                        <p class="card-description">We win together. Collaboration is in our DNA — with clients and teammates alike.</p>
                        {{-- <div class="card-footer">
                            <span class="link-text">Learn More</span>
                            <i class="fas fa-arrow-right icon-transition"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Culture Stats -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value text-primary">98%</div>
                <p class="stat-label">Employee Satisfaction</p>
            </div>
            <div class="stat-item">
                <div class="stat-value text-secondary">{{ $achievements[4]['number'] }}+</div>
                <p class="stat-label">Team Members</p>
            </div>
            <div class="stat-item">
                <div class="stat-value text-primary">5+</div>
                <p class="stat-label">Countries Reached</p>
            </div>
            <div class="stat-item">
                <div class="stat-value text-secondary">{{ $achievements[1]['number'] }}+</div>
                <p class="stat-label">Projects Completed</p>
            </div>
        </div>

        <!-- Final Call -->
        <div class="final-call">
            <p class="call-description">We're not just building software — we're building a culture of impact, growth, and shared success.</p>
           
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=youremail@example.com&su=Job Inquiry&body=Hi, I’m interested in joining your team."  target="_blank"  class=" animated-button cta-button">
                    <span>Join Our Team</span>
                <i class="fas fa-arrow-right icon-transition ml-3"></i>
                </a>

        </div>
    </div>
</section>
