@props(['serviceHeading', 'detailsArray'])


<section class="process-section">
    <div class="max-w-7xl mx-auto px-4">
        <div class="section-header">
            <span class="section-badge">Our Process</span>
            <h2 class="section-title">Development Journey</h2>
            <p class="section-subtitle">A comprehensive approach to transforming your ideas into exceptional digital
                solutions</p>
        </div>

        <div class="process-container">
            @foreach ($detailsArray as $index => $step)
                <div class="process-item">
                    <div class="process-number">{{ $index + 1 }}</div>
                    <div class="process-content">
                        <h3 class="process-title">{{ $step['title'] }}</h3>
                        <p class="process-description">{{ $step['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
