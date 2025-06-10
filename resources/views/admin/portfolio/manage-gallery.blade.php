@extends('admin/layouts/main')
@section('title', 'WebNodez - Design Gallery')
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
        /* Custom Select Styling */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        select option {
            background-color: #1f2937;
            color: white;
        }

        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px #3b82f6;
        }

        /* Remove the custom chevron div since we're using background image */
        .select-wrapper {
            position: relative;
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
                    <h1 class="text-3xl font-bold text-white mb-2">Design Gallery</h1>
                    <p class="text-gray-400">Manage your design portfolio and showcase your work</p>
                </div>
                <button onclick="openDesignForm()"
                    class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i>Add Design
                </button>
            </div>

            <!-- Design Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($designs as $design)
                    <div data-design-id="{{ $design->id }}"
                        class="bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-blue-500/20 group">
                        <div class="relative">
                            @if ($design->is_featured)
                                <div
                                    class="absolute top-2 left-2 z-10 bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                    <i class="fas fa-star mr-1"></i>Featured
                                </div>
                            @endif
                            <img src="{{ $design->image }}" alt="{{ $design->title }}" class="w-full h-48 object-cover">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-white mb-2">{{ $design->title }}</h3>
                            <div class="flex items-center mb-2">
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full 
                                    @if ($design->category === 'web_dev') bg-blue-500/20 text-blue-300
                                    @elseif($design->category === 'app_dev') bg-green-500/20 text-green-300
                                    @else bg-purple-500/20 text-purple-300 @endif">
                                    {{ $categories[$design->category] }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="{{ $design->link }}"
                                    class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                    <i class="fas fa-external-link-alt mr-1"></i>View Design
                                </a>
                                <div class="flex space-x-2">
                                    <button onclick="openDesignForm({{ $design->toJson() }})"
                                        class="text-gray-400 hover:text-white transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteDesign({{ $design->id }})"
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

    <!-- Design Form Modal -->
    <div id="designFormModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-gray-900 rounded-xl p-6 w-full max-w-md transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white" id="formTitle">Add New Design</h2>
                <button onclick="closeDesignForm()" class="text-gray-400 hover:text-white transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="designForm" class="space-y-4">
                <input type="hidden" id="designId">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Title</label>
                    <input type="text" id="designTitle"
                        class="w-full bg-white/5 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        placeholder="Enter design title">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Image URL</label>
                    <input type="url" id="designImage"
                        class="w-full bg-white/5 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        placeholder="Enter image URL">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Design Link</label>
                    <input type="url" id="designLink"
                        class="w-full bg-white/5 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        placeholder="Enter design link">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                    <div class="select-wrapper">
                        <select id="designCategory"
                            class="w-full bg-white/5 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="isFeatured"
                        class="w-4 h-4 rounded border-gray-600 bg-white/5 text-blue-500 focus:ring-blue-500">
                    <label for="isFeatured" class="text-sm font-medium text-gray-300">Mark as Featured</label>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeDesignForm()"
                        class="px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white hover:bg-white/10 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                        Save Design
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to open the design form
        function openDesignForm(design = null) {
            const modal = document.getElementById('designFormModal');
            const form = document.getElementById('designForm');
            const title = document.getElementById('formTitle');

            // Reset form
            form.reset();

            if (design) {
                // Edit mode
                title.textContent = 'Edit Design';
                document.getElementById('designId').value = design.id;
                document.getElementById('designTitle').value = design.title;
                document.getElementById('designImage').value = design.image;
                document.getElementById('designLink').value = design.link;
                document.getElementById('designCategory').value = design.category;
                document.getElementById('isFeatured').checked = design.is_featured || false;
            } else {
                // Add mode
                title.textContent = 'Add New Design';
                document.getElementById('designId').value = '';
                document.getElementById('designCategory').value = 'web_dev';
                document.getElementById('isFeatured').checked = false;
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // Function to close the design form
        function closeDesignForm() {
            const modal = document.getElementById('designFormModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Function to show notifications
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

        // Function to handle form submission
        document.getElementById('designForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const designData = {
                id: document.getElementById('designId').value,
                title: document.getElementById('designTitle').value,
                image: document.getElementById('designImage').value,
                link: document.getElementById('designLink').value,
                category: document.getElementById('designCategory').value,
                is_featured: document.getElementById('isFeatured').checked,
                _token: document.querySelector('meta[name="csrf-token"]').content
            };

            const url = designData.id ?
                `/admin/manage-portfolio/gallery/update/${designData.id}` :
                '/admin/manage-portfolio/gallery/store';

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitButton.disabled = true;

            // Send the data to the server
            fetch(url, {
                    method: designData.id ? 'PUT' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(designData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Error saving design');
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
                    showNotification(error.message || 'Error saving design. Please try again.', 'error');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });

            // Close the form
            closeDesignForm();
        });

        // Function to delete a design
        function deleteDesign(id) {
            if (confirm('Are you sure you want to delete this design?')) {
                // Show loading state
                const deleteButton = document.querySelector(`[data-design-id="${id}"] .fa-trash`).parentElement;
                const originalHTML = deleteButton.innerHTML;
                deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                deleteButton.disabled = true;

                fetch(`/admin/manage-portfolio/gallery/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw new Error(data.message || 'Error deleting design');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            showNotification(data.message, 'success');
                            // Remove the card from the DOM
                            const card = document.querySelector(`[data-design-id="${id}"]`);
                            if (card) {
                                card.remove();
                            }
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification(error.message || 'Error deleting design. Please try again.', 'error');
                    })
                    .finally(() => {
                        // Reset button state
                        deleteButton.innerHTML = originalHTML;
                        deleteButton.disabled = false;
                    });
            }
        }

        // Close modal when clicking outside
        document.getElementById('designFormModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDesignForm();
            }
        });
    </script>

</header>

@endsection
