@props(['items'])
<style>
    .tech-group-list-item h4 {
        font-size: 14px;
        white-space: nowrap;
    }

    @media (min-width: 750px) and (max-width: 1200px) {
        .inner-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            gap: 1rem;
        }

        .tech-group-list-item {
            padding: 0.75rem;
        }

        .tech-group-list-item h4 {
            font-size: 13px;
            white-space: normal;
            text-align: center;
            line-height: 1.2;
        }

        .tech-group-list-item-img {
            width: 3.5rem;
            height: 3.5rem;
            margin-bottom: 0.5rem;
        }

        .tech-group-list-item img {
            width: 2.5rem;
            height: 2.5rem;
        }
    }

    @media (max-width: 1200px) {
        .home-tech-section .inner-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }

    @media (max-width: 750px) {

        .home-tech-section .inner-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        }
    }

    @media (max-width: 550px) {

        .home-tech-section .inner-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

    }

    @media (max-width: 450px) {
        .tech-group-list-item {
            padding: 5px 8px;
        }

        .tech-group-list-item>div {
            margin-bottom: 0;
            padding: 0;
        }

        .tech-group-list-item h4 {
            font-size: 11px;
        }

        .tech-group-list-item img {
            height: 1.75rem;
            width: 1.75rem;
        }
    }

    @media (max-width: 450px) {
        .tech-group-list-item-img {
            width: 100%;
            height: 4rem;
        }
    }

   

    .dark-mode .tech-group-list-item {
        background: var(--dark-bg);
    }

    .dark-mode .tech-group-list-item div {
        background: var(--dark-bg);
    }

    .dark-mode .tech-group-list-item h4 {
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
                    class="tech-group-list-item-img w-20 h-20 mb-4 flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-3">
                    <img loading="lazy" src="{{ $item['icon'] }}" alt="{{ $item['name'] }}"
                        class="w-14 h-14 object-contain transform group-hover:scale-110 transition-transform duration-300">
                </div>
                <h4
                    class="text-base font-semibold text-gray-800 group-hover:text-green-600 transition-colors duration-300">
                    {{ $item['name'] }}</h4>
            </div>
        </div>
    @endforeach
</div>
