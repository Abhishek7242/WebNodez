  <section class="service">
        <div class="our-service-text">
            <small class="text-[var(--color-primary)] font-medium tracking-wide">Innovating Digital Solutions for
                Tomorrow's Success</small>
            <h1>
                {{ $service }}
                <div class="our-service-desc-text">
                    {{ $details['description'] }}
                </div>
            </h1>
            <button>Get Started</button>
        </div>

        <div class="triangles">
            <div class="triangle" style="background-image: url('{{ $introImages[0] }}');">
            </div>
            <div class="triangle" style="background-image: url('{{ $introImages[1] }}');">
            </div>
            <div class="triangle" style="background-image: url('{{ $introImages[2] }}');">
            </div>
            <div class="triangle" style="background-image: url('{{ $introImages[3] }}');">
            </div>
        </div>
    </section>