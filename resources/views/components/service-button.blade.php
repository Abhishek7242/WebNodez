
<button class="our-services-button {{ $button['active'] ? 'active' : '' }}" data-service="{{ $button['id'] }}">
    <div class="our-services-button-icon">
        <i class="{{ $button['icon'] }}"></i>
    </div>
    <div class="our-services-button-title">{{ $button['title'] }}</div>
</button>
