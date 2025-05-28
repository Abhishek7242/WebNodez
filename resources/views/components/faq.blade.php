{{-- @props(['faqs']) --}}

<section class="faq-section py-20 px-6 md:px-12 lg:px-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="faq-container max-w-4xl mx-auto">
        <!-- Section Header -->
        <div class="faq-header text-center mb-16">
            <div class="faq-badge flex items-center justify-center space-x-3 mb-6">
                <div class="faq-badge-line w-2 h-8 rounded-full"></div>
                <span class="faq-badge-text font-medium text-lg">FAQ</span>
            </div>
            <h2 class="faq-title text-4xl md:text-5xl font-bold mb-6">Frequently Asked Questions</h2>
            <p class="faq-description text-xl text-gray-600">
                Find answers to common questions about our services and processes.
            </p>
        </div>

        <!-- FAQ Items -->
        <div class="faq-items space-y-6">
            @foreach ($faqs as $index => $faq)
                <div class="faq-item bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <button
                        class="faq-question w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none group"
                        onclick="toggleFaq({{ $index }})">
                        <span
                            class="text-lg font-medium text-gray-900 group-hover:text-green-600 transition-colors duration-300">{{ $faq['question'] }}</span>
                        <div class="faq-icon-wrapper">
                            <i class="fas fa-chevron-down faq-icon transition-all duration-300 text-green-500"></i>
                        </div>
                    </button>
                    <div class="faq-answer px-8 py-0 max-h-0 overflow-hidden transition-all duration-300">
                        <div class="faq-answer-content pb-6">
                            <div class="w-12 h-1 bg-green-100 rounded-full mb-4"></div>
                            <p class="text-gray-600 leading-relaxed">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    function toggleFaq(index) {
        const answer = document.querySelectorAll('.faq-answer')[index];
        const icon = document.querySelectorAll('.faq-icon')[index];
        const question = document.querySelectorAll('.faq-question')[index];

        // Close all other answers
        document.querySelectorAll('.faq-answer').forEach((item, i) => {
            if (i !== index) {
                item.style.maxHeight = null;
                document.querySelectorAll('.faq-icon')[i].style.transform = 'rotate(0deg)';
                document.querySelectorAll('.faq-question')[i].classList.remove('active');
            }
        });

        // Toggle current answer
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
            icon.style.transform = 'rotate(0deg)';
            question.classList.remove('active');
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
            icon.style.transform = 'rotate(180deg)';
            question.classList.add('active');
        }
    }
</script>
