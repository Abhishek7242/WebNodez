@extends('admin/layouts/main')
@section('title', 'WebNodez - Case Studies')
@section('home', 'active')
@section('main-section')

    <!-- Add CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .case-studies-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .case-studies-featured-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(145deg, #3b82f6, #8b5cf6);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .case-studies-featured-tag i {
            font-size: 0.7rem;
        }

        .case-studies-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .case-studies-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .case-studies-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .case-studies-card:hover .case-studies-image img {
            transform: scale(1.05);
        }

        .case-studies-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .case-studies-card:hover .case-studies-overlay {
            opacity: 1;
        }

        .case-studies-overlay-content {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            display: flex;
            gap: 1rem;
        }

        .case-studies-duration,
        .case-studies-role {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            color: white;
        }

        .case-studies-content {
            padding: 1.5rem;
        }

        .case-studies-tags {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .case-studies-tag {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
        }

        .case-studies-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: white;
            margin-bottom: 0.5rem;
        }

        .case-studies-card-description {
            color: #9ca3af;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .case-studies-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0.5rem;
        }

        .case-studies-stat {
            text-align: center;
        }

        .case-studies-stat-number {
            display: block;
            font-size: 1.5rem;
            font-weight: 600;
            color: #60a5fa;
            margin-bottom: 0.25rem;
        }

        .case-studies-stat-label {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .case-studies-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #60a5fa;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .case-studies-link:hover {
            color: #93c5fd;
        }

        .case-studies-link i {
            transition: transform 0.3s ease;
        }

        .case-studies-link:hover i {
            transform: translateX(4px);
        }

        /* Form Modal Styles */
        .case-study-form-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .case-study-form-modal.active {
            display: flex;
            opacity: 1;
        }

        .case-study-form-container {
            background: linear-gradient(145deg, #1f2937, #111827);
            border-radius: 1.5rem;
            padding: 2rem;
            width: 100%;
            max-width: 1000px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .case-study-form-modal.active .case-study-form-container {
            transform: translateY(0);
        }

        .case-study-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            background: linear-gradient(145deg, #1f2937, #111827);
            z-index: 10;
            padding-top: 1rem;
        }

        .case-study-form-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(to right, #60a5fa, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .case-study-form-close {
            color: #9ca3af;
            cursor: pointer;
            transition: all 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .case-study-form-close:hover {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .case-study-form-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: auto;
        }

        .case-study-form-group {
            margin-bottom: 0.75rem;
        }

        .case-study-form-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            color: white;
            transition: all 0.2s;
            font-size: 0.875rem;
        }

        .case-study-form-input option {
            background: #1f2937;
            color: white;
        }

        .case-study-form-input:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .case-study-form-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .case-study-form-textarea {
            min-height: 80px;
            resize: vertical;
            line-height: 1.5;
        }

        .case-study-form-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .case-study-form-stat {
            background: rgba(255, 255, 255, 0.05);
            padding: 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s;
        }

        .case-study-form-stat:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .case-study-form-button {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .case-study-form-button-submit {
            background: linear-gradient(145deg, #3b82f6, #8b5cf6);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .case-study-form-button-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
        }

        .case-study-form-button-submit:active {
            transform: translateY(0);
        }

        .case-study-form-checkbox {
            position: relative;
            display: inline-block;
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
        }

        .case-study-form-checkbox .checkmark {
            width: 18px;
            height: 18px;
        }

        .case-study-form-checkbox .checkmark:after {
            left: 5px;
            top: 2px;
            width: 4px;
            height: 8px;
        }

        .case-study-form-label {
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: #e5e7eb;
            font-weight: 500;
        }

        .case-study-form-tags {
            min-height: 32px;
            padding: 0.25rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 0.5rem;
        }

        .case-study-form-tag {
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            background: linear-gradient(145deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2));
            border: 1px solid rgba(96, 165, 250, 0.3);
        }

        .case-study-form-tag-remove {
            width: 16px;
            height: 16px;
        }

        .form-grid {
            display: grid;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .form-grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .form-section {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .form-section-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #e5e7eb;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Scrollbar styling */
        .case-study-form-container::-webkit-scrollbar {
            width: 8px;
        }

        .case-study-form-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }

        .case-study-form-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .case-study-form-container::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>

    <!-- Three.js and other required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <!-- Canvas background container -->
    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>

    <div class="min-h-screen p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Case Studies</h1>
                    <p class="text-gray-400">Manage your case studies and showcase your work</p>
                </div>
                <button onclick="openCaseStudyForm()"
                    class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i>Add Case Study
                </button>
            </div>

            <!-- Case Studies Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($caseStudies as $caseStudy)
                    <div class="case-studies-card" data-category="{{ $caseStudy->category }}">
                        @if ($caseStudy->is_featured)
                            <div class="case-studies-featured-tag">
                                <i class="fas fa-star"></i>
                                Featured
                            </div>
                        @endif
                        <div class="case-studies-image">
                            <img src="{{ $caseStudy->image }}" alt="{{ $caseStudy->title }}">
                            <div class="case-studies-overlay">
                                <div class="case-studies-overlay-content">
                                    <span class="case-studies-duration">{{ $caseStudy->duration }}</span>
                                    <span class="case-studies-role">{{ $caseStudy->role }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="case-studies-content">
                            <div class="case-studies-tags">
                                @foreach ($caseStudy->tags as $tag)
                                    <span class="case-studies-tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <h3 class="case-studies-card-title">{{ $caseStudy->title }}</h3>
                            <p class="case-studies-card-description">{{ $caseStudy->description }}</p>
                            <div class="case-studies-stats">
                                @foreach ($caseStudy->stats as $stat)
                                    <div class="case-studies-stat">
                                        <span class="case-studies-stat-number">{{ $stat['number'] }}</span>
                                        <span class="case-studies-stat-label">{{ $stat['label'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="{{ $caseStudy->link }}" class="case-studies-link">
                                    View Case Study
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <div class="flex space-x-2">
                                    <button
                                        onclick='editCaseStudy({
                                        id: {{ $caseStudy->id }},
                                        title: "{{ addslashes($caseStudy->title) }}",
                                        image: "{{ addslashes($caseStudy->image) }}",
                                        category: "{{ $caseStudy->category }}",
                                        duration: "{{ addslashes($caseStudy->duration) }}",
                                        role: "{{ addslashes($caseStudy->role) }}",
                                        description: "{{ addslashes($caseStudy->description) }}",
                                        link: "{{ addslashes($caseStudy->link) }}",
                                        tags: {!! json_encode($caseStudy->tags) !!},
                                        stats: {!! json_encode($caseStudy->stats) !!},
                                        is_featured: {{ $caseStudy->is_featured ? 'true' : 'false' }}
                                    })'
                                        class="text-gray-400 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteCaseStudy({{ $caseStudy->id }})"
                                        class="text-gray-400 hover:text-red-400 transition-colors duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Case Study Form Modal -->
    <div id="caseStudyFormModal" class="case-study-form-modal">
        <div class="case-study-form-container">
            <div class="case-study-form-header">
                <h2 class="case-study-form-title" id="formTitle">Add New Case Study</h2>
                <div class="case-study-form-actions">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <span class="case-study-form-checkbox">
                            <input type="checkbox" id="caseStudyFeatured">
                            <span class="checkmark"></span>
                        </span>
                        <span class="case-study-form-label">Mark as Featured</span>
                    </label>
                    <button type="button" onclick="submitCaseStudyForm()"
                        class="case-study-form-button case-study-form-button-submit">
                        <i class="fas fa-save"></i>
                        Save Case Study
                    </button>
                    <button onclick="closeCaseStudyForm()" class="case-study-form-close">
                    <i class="fas fa-times"></i>
                </button>
                </div>
                </div>
            <form id="caseStudyForm" class="space-y-4">
                <input type="hidden" id="caseStudyId">

                <div class="form-section">
                    <div class="form-section-title">Case Study Information</div>

                    <!-- First Line: Title, Category, Role -->
                    <div class="form-grid form-grid-3">
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Title</label>
                            <input type="text" id="caseStudyTitle" class="case-study-form-input"
                                placeholder="Enter case study title" required>
                </div>
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Category</label>
                            <select id="caseStudyCategory" class="case-study-form-input" required>
                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Role</label>
                            <input type="text" id="caseStudyRole" class="case-study-form-input"
                                placeholder="e.g., Lead Developer" required>
                        </div>
                    </div>

                    <!-- Second Line: Image, Description, Link -->
                    <div class="form-grid form-grid-3">
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Image URL</label>
                            <input type="url" id="caseStudyImage" class="case-study-form-input"
                                placeholder="https://example.com/image.jpg" required>
                        </div>
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Description</label>
                            <textarea id="caseStudyDescription" class="case-study-form-input case-study-form-textarea"
                                placeholder="Enter case study description..." required></textarea>
                        </div>
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Link</label>
                            <input type="url" id="caseStudyLink" class="case-study-form-input"
                                placeholder="https://example.com/case-study">
                        </div>
                    </div>

                    <!-- Third Line: Duration and Tags -->
                    <div class="form-grid form-grid-2">
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Duration</label>
                            <input type="text" id="caseStudyDuration" class="case-study-form-input"
                                placeholder="e.g., 3 months" required>
                        </div>
                        <div class="case-study-form-group">
                            <label class="case-study-form-label">Tags</label>
                            <div class="case-study-form-tags" id="caseStudyTags"></div>
                            <input type="text" id="caseStudyTagInput" class="case-study-form-input mt-2"
                                placeholder="Add a tag and press Enter">
                        </div>
                    </div>

                    <!-- Fourth Line: Stats -->
                    <div class="case-study-form-group">
                        <label class="case-study-form-label">Stats</label>
                        <div class="case-study-form-stats">
                            <div class="case-study-form-stat">
                                <input type="text" id="caseStudyStat1Number" class="case-study-form-input mb-2"
                                    placeholder="Number (e.g., 2.5x)">
                                <input type="text" id="caseStudyStat1Label" class="case-study-form-input"
                                    placeholder="Label (e.g., Social Engagement)">
                            </div>
                            <div class="case-study-form-stat">
                                <input type="text" id="caseStudyStat2Number" class="case-study-form-input mb-2"
                                    placeholder="Number (e.g., 90%)">
                                <input type="text" id="caseStudyStat2Label" class="case-study-form-input"
                                    placeholder="Label (e.g., Customer Approval)">
                    </div>
                </div>
                </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let tags = [];

        function openCaseStudyForm(caseStudy = null) {
            const modal = document.getElementById('caseStudyFormModal');
            const form = document.getElementById('caseStudyForm');
            const title = document.getElementById('formTitle');

            // Reset form
            form.reset();
            tags = [];

            if (caseStudy) {
                // Edit mode
                title.textContent = 'Edit Case Study';
                document.getElementById('caseStudyId').value = caseStudy.id;
                document.getElementById('caseStudyTitle').value = caseStudy.title;
                document.getElementById('caseStudyImage').value = caseStudy.image;
                document.getElementById('caseStudyCategory').value = caseStudy.category;
                document.getElementById('caseStudyDuration').value = caseStudy.duration;
                document.getElementById('caseStudyRole').value = caseStudy.role;
                document.getElementById('caseStudyDescription').value = caseStudy.description;
                document.getElementById('caseStudyLink').value = caseStudy.link;
                document.getElementById('caseStudyFeatured').checked = caseStudy.is_featured;

                // Set tags
                tags = caseStudy.tags;
                updateTagsDisplay();

                // Set stats
                if (caseStudy.stats && caseStudy.stats.length >= 2) {
                    document.getElementById('caseStudyStat1Number').value = caseStudy.stats[0].number;
                    document.getElementById('caseStudyStat1Label').value = caseStudy.stats[0].label;
                    document.getElementById('caseStudyStat2Number').value = caseStudy.stats[1].number;
                    document.getElementById('caseStudyStat2Label').value = caseStudy.stats[1].label;
                }
            } else {
                // Add mode
                title.textContent = 'Add New Case Study';
                document.getElementById('caseStudyId').value = '';
                document.getElementById('caseStudyCategory').value = 'web_dev';
                document.getElementById('caseStudyFeatured').checked = false;
            }

            modal.classList.add('active');
        }

        function closeCaseStudyForm() {
            const modal = document.getElementById('caseStudyFormModal');
            modal.classList.remove('active');
        }

        function updateTagsDisplay() {
            const tagsContainer = document.getElementById('caseStudyTags');
            tagsContainer.innerHTML = tags.map(tag => `
                <span class="case-study-form-tag">
                    ${tag}
                    <span class="case-study-form-tag-remove" onclick="removeTag('${tag}')">
                        <i class="fas fa-times"></i>
                    </span>
                </span>
            `).join('');
        }

        function addTag(tag) {
            if (tag && !tags.includes(tag)) {
                tags.push(tag);
                updateTagsDisplay();
            }
        }

        function removeTag(tag) {
            tags = tags.filter(t => t !== tag);
            updateTagsDisplay();
        }

        // Handle tag input
        document.getElementById('caseStudyTagInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const tag = this.value.trim();
                if (tag) {
                    addTag(tag);
                    this.value = '';
                }
            }
        });

        function submitCaseStudyForm() {
            const form = document.getElementById('caseStudyForm');
            const caseStudyData = {
                id: document.getElementById('caseStudyId').value,
                title: document.getElementById('caseStudyTitle').value,
                image: document.getElementById('caseStudyImage').value,
                category: document.getElementById('caseStudyCategory').value,
                duration: document.getElementById('caseStudyDuration').value,
                role: document.getElementById('caseStudyRole').value,
                description: document.getElementById('caseStudyDescription').value,
                link: document.getElementById('caseStudyLink').value,
                tags: tags,
                stats: [{
                        number: document.getElementById('caseStudyStat1Number').value,
                        label: document.getElementById('caseStudyStat1Label').value
                    },
                    {
                        number: document.getElementById('caseStudyStat2Number').value,
                        label: document.getElementById('caseStudyStat2Label').value
                    }
                ],
                is_featured: document.getElementById('caseStudyFeatured').checked,
                _token: document.querySelector('meta[name="csrf-token"]').content
            };

            const url = caseStudyData.id ?
                `/admin/manage-portfolio/case-studies/update/${caseStudyData.id}` :
                '/admin/manage-portfolio/case-studies/store';

            // Show loading state
            const submitButton = document.querySelector('.case-study-form-button-submit');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitButton.disabled = true;

            // Send the data to the server
            fetch(url, {
                    method: caseStudyData.id ? 'PUT' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(caseStudyData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Error saving case study');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        // Reload the page to show updated data
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification(error.message || 'Error saving case study. Please try again.', 'error');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });
        }

        function editCaseStudy(caseStudy) {
            // Open form with case study data
            openCaseStudyForm(caseStudy);
        }

        function deleteCaseStudy(id) {
            if (confirm('Are you sure you want to delete this case study?')) {
                // Show loading state
                const deleteButton = document.querySelector(`[onclick="deleteCaseStudy(${id})"]`);
                const originalHTML = deleteButton.innerHTML;
                deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                deleteButton.disabled = true;

                fetch(`/admin/manage-portfolio/case-studies/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw new Error(data.message || 'Error deleting case study');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            showNotification(data.message, 'success');
                            // Remove the card from the DOM
                            const card = document.querySelector(`[data-category]`).closest('.case-studies-card');
                            if (card) {
                                card.remove();
                            }
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification(error.message || 'Error deleting case study. Please try again.', 'error');
                    })
                    .finally(() => {
                        // Reset button state
                        deleteButton.innerHTML = originalHTML;
                        deleteButton.disabled = false;
                    });
            }
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className =
                'fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-y-0 opacity-100 z-50';

            // Set background color based on type
            switch (type) {
                case 'success':
                    notification.classList.add('bg-green-500', 'text-white');
                    break;
                case 'error':
                    notification.classList.add('bg-red-500', 'text-white');
                    break;
                default:
                    notification.classList.add('bg-gray-500', 'text-white');
            }

            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateY(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Close modal when clicking outside
        document.getElementById('caseStudyFormModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCaseStudyForm();
            }
        });
    </script>

@endsection
