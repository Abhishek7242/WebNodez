<div class="service-card">
  <div class="icon-circle text-blue-500">
    {!! $icon !!}
  </div>

  <div>
    <h3 class="service-title">{{ $title }}</h3>
    <p class="service-desc">{{ $description }}</p>
  </div>

  <a href="{{ $link ?? '#' }}" class="btn-green">
    <p>Learn More</p>
  </a>
</div>
