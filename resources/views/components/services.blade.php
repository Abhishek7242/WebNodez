<div class="service-card">
  <div class="icon-circle text-blue-500">
    {!! $icon !!}
  </div>

  <div>
    <h3 class="service-title">{{ $title }}</h3>
    <p class="service-desc">{{ $description }}</p>
  </div>

  <button class="btn-green">
    <a href="{{ $link ?? '#' }}">Learn More</a>
  </button>
</div>
