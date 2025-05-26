<div class="group relative process-step-card perspective-1000">
    <div class="card-inner relative w-full h-full transition-transform duration-700 transform-style-3d">
        <!-- Front of card -->
        <div
            class="card-front absolute w-full h-full backface-hidden bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 shadow-xl border border-gray-100">
            <div class="relative">
                <!-- Decorative elements -->
                <div
                    class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full opacity-50 blur-xl">
                </div>
                <div
                    class="absolute -bottom-4 -left-4 w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full opacity-50 blur-xl">
                </div>

                <!-- Icon container -->
                <div class="icon-wrapper relative mb-6">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl blur-md opacity-30 transform -rotate-6">
                    </div>
                    <div class="relative bg-white rounded-2xl p-4 shadow-lg border border-gray-100">
                        <div
                            class="w-12 h-12 mx-auto text-blue-600 transform transition-transform duration-300 group-hover:scale-110">
                            {!! $icon !!}
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="relative">
                    <h4
                        class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                        {{ $title }}</h4>
                    <p class="text-gray-600 leading-relaxed">{!! $description !!}</p>
                </div>
            </div>
        </div>

        <!-- Back of card -->
        <div
            class="card-back absolute w-full h-full backface-hidden bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl p-8 shadow-xl transform rotate-y-180">
            <div class="h-full flex flex-col justify-center items-center text-white">
                <div class="w-16 h-16 mb-4 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                    {!! $icon !!}
                </div>
                <h4 class="text-xl font-bold mb-3">{{ $title }}</h4>
                <p class="text-white/90 text-center">{!! $description !!}</p>
            </div>
        </div>
    </div>
</div>
