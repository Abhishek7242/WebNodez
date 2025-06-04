@props(['items'])
<style>
    .tech-group-list-item h4{
    font-size: 14px;
    white-space: nowrap;
}
    @media (max-width: 1200px) {

.home-tech-section .inner-grid{
    grid-template-columns: repeat(2, minmax(0, 1fr))!important;
}

    }
  @media (max-width: 750px) {

.home-tech-section .inner-grid{
    grid-template-columns: repeat(3, minmax(0, 1fr))!important;
}}
  @media (max-width: 550px) {

.home-tech-section .inner-grid{
    grid-template-columns: repeat(2, minmax(0, 1fr))!important;
}

    }
    @media (max-width: 450px) {
    .tech-group-list-item{
        padding:5px 10px;
    }
    .tech-group-list-item > div{
        margin-bottom: 0;
        padding: 0;
    }
.tech-group-list-item h4{
    font-size: 12px;
}
.tech-group-list-item img{
    height: 2rem;
    width: 2rem;
}
}
      .dark-mode .tech-group-list-item{
background: var(--dark-bg);
    }
      .dark-mode .tech-group-list-item div{
background: var(--dark-bg);
    }
      .dark-mode .tech-group-list-item h4{
color: rgb(0, 120, 36);
    }
</style>
<div class="inner-grid grid grid-cols-2 sm:grid-cols-3 gap-8">
    @foreach ($items as $item)
        <div class=" group relative">
            <div
                class="absolute -inset-0.5 bg-gradient-to-r from-green-600 to-purple-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200">
            </div>
            <div
                class="tech-group-list-item relative flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <div
                    class="w-20 h-20 mb-4 flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-3">
                    <img src="{{ $item['icon'] }}" alt="{{ $item['name'] }}"
                        class="w-14 h-14 object-contain transform group-hover:scale-110 transition-transform duration-300">
                </div>
                <h4
                    class="text-base font-semibold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                    {{ $item['name'] }}</h4>
            </div>
        </div>
    @endforeach
</div>


