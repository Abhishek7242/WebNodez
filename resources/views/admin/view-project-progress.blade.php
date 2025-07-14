@extends('admin/layouts/main')
@section('title', 'Linkuss - Project Progress')
@section('client-progress', 'active')
@section('main-section')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <div class="flex items-center mb-2">
                        <a href="/admin/manage-client-progress" class="text-blue-400 hover:text-blue-300 mr-3">
                            <i class="fas fa-arrow-left"></i> Back to Projects
                        </a>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $project->project_name }}</h1>
                    <p class="text-gray-400">Project Progress Details</p>
                </div>
                <div class="flex space-x-3">
                    <button onclick="editProject()"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit Project
                    </button>
                    <button onclick="sendEmail()"
                        class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>Send Email
                    </button>
                    <button onclick="goBack()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-600 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </button>
                </div>
            </div>

            <!-- Project Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Project Image and Basic Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                        <div class="relative mb-6">
                            <img src="{{ $project->image }}" alt="{{ $project->project_name }}"
                                class="w-full h-64 object-cover rounded-lg">
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 text-sm font-semibold rounded-full {{ $project->getStatusBadgeClass() }}">
                                    {{ $project->getStatusText() }}
                                </span>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold text-white mb-4">Project Description</h2>
                        <p class="text-gray-300 leading-relaxed">{{ $project->description }}</p>
                    </div>
                </div>

                <!-- Project Stats -->
                <div class="space-y-6">
                    <!-- Progress Card -->
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Progress Overview</h3>

                        <!-- Progress Circle -->
                        <div class="flex justify-center mb-4">
                            <div class="relative w-32 h-32">
                                <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="54" fill="none" stroke="#374151"
                                        stroke-width="8" />
                                    <circle cx="60" cy="60" r="54" fill="none" stroke="url(#gradient)"
                                        stroke-width="8" stroke-dasharray="{{ 2 * pi() * 54 }}"
                                        stroke-dashoffset="{{ 2 * pi() * 54 * (1 - $project->progress_percentage / 100) }}"
                                        stroke-linecap="round" />
                                    <defs>
                                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%"
                                            y2="0%">
                                            <stop offset="0%" style="stop-color:#3B82F6" />
                                            <stop offset="100%" style="stop-color:#8B5CF6" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-white">{{ $project->progress_percentage }}%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-400 mb-2">
                                <span>Completion</span>
                                <span>{{ $project->progress_percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-3">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-3 rounded-full transition-all duration-500"
                                    style="width: {{ $project->progress_percentage }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Details -->
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-4">Project Details</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Status:</span>
                                <span class="text-white font-medium">{{ $project->getStatusText() }}</span>
                            </div>

                            @if ($project->start_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Start Date:</span>
                                    <span class="text-white">{{ $project->start_date->format('M d, Y') }}</span>
                                </div>
                            @endif

                            @if ($project->expected_completion_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Expected Completion:</span>
                                    <span
                                        class="text-white">{{ $project->expected_completion_date->format('M d, Y') }}</span>
                                </div>

                                @php
                                    $today = now();
                                    $expectedDate = $project->expected_completion_date;
                                    $daysRemaining = $today->diffInDays($expectedDate, false);
                                    $isOverdue = $daysRemaining < 0;
                                @endphp

                                <div class="flex justify-between">
                                    <span class="text-gray-400">Time Remaining:</span>
                                    <span class="text-white {{ $isOverdue ? 'text-red-400' : 'text-green-400' }}">
                                        @if ($isOverdue)
                                            {{ abs($daysRemaining) }} days overdue
                                        @else
                                            {{ $daysRemaining }} days
                                        @endif
                                    </span>
                                </div>
                            @endif

                            <div class="flex justify-between">
                                <span class="text-gray-400">Created:</span>
                                <span class="text-white">{{ $project->created_at->format('M d, Y') }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-400">Last Updated:</span>
                                <span class="text-white">{{ $project->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Phases -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-8">
                <h2 class="text-2xl font-bold text-white mb-6">Project Phases</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Design Phase -->
                    <div class="bg-white/5 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-white">Design</h3>
                            <button onclick="togglePhase('design', {{ $project->design_completed ? 'false' : 'true' }})"
                                class="px-3 py-1 text-xs rounded-full {{ $project->design_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                {{ $project->design_completed ? 'Completed' : 'Pending' }}
                            </button>
                        </div>
                        @if ($project->design_completion_date)
                            <p class="text-sm text-gray-400">Completed:
                                {{ $project->design_completion_date->format('M d, Y') }}</p>
                        @else
                            <p class="text-sm text-gray-400">Not completed yet</p>
                        @endif
                    </div>

                    <!-- Development Phase -->
                    <div class="bg-white/5 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-white">Development</h3>
                            <button
                                onclick="togglePhase('development', {{ $project->development_completed ? 'false' : 'true' }})"
                                class="px-3 py-1 text-xs rounded-full {{ $project->development_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                {{ $project->development_completed ? 'Completed' : 'Pending' }}
                            </button>
                        </div>
                        @if ($project->development_completion_date)
                            <p class="text-sm text-gray-400">Completed:
                                {{ $project->development_completion_date->format('M d, Y') }}</p>
                        @else
                            <p class="text-sm text-gray-400">Not completed yet</p>
                        @endif
                    </div>

                    <!-- Testing Phase -->
                    <div class="bg-white/5 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-white">Testing</h3>
                            <button onclick="togglePhase('testing', {{ $project->testing_completed ? 'false' : 'true' }})"
                                class="px-3 py-1 text-xs rounded-full {{ $project->testing_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                {{ $project->testing_completed ? 'Completed' : 'Pending' }}
                            </button>
                        </div>
                        @if ($project->testing_completion_date)
                            <p class="text-sm text-gray-400">Completed:
                                {{ $project->testing_completion_date->format('M d, Y') }}</p>
                        @else
                            <p class="text-sm text-gray-400">Not completed yet</p>
                        @endif
                    </div>

                    <!-- Deployment Phase -->
                    <div class="bg-white/5 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-white">Deployment</h3>
                            <button
                                onclick="togglePhase('deployment', {{ $project->deployment_completed ? 'false' : 'true' }})"
                                class="px-3 py-1 text-xs rounded-full {{ $project->deployment_completed ? 'bg-green-500 text-white' : 'bg-gray-500 text-gray-300' }}">
                                {{ $project->deployment_completed ? 'Completed' : 'Pending' }}
                            </button>
                        </div>
                        @if ($project->deployment_completion_date)
                            <p class="text-sm text-gray-400">Completed:
                                {{ $project->deployment_completion_date->format('M d, Y') }}</p>
                        @else
                            <p class="text-sm text-gray-400">Not completed yet</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-8">
                <h2 class="text-2xl font-bold text-white mb-6">Progress Timeline</h2>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-600"></div>

                    <!-- Timeline Items -->
                    <div class="space-y-6">
                        <!-- Project Started -->
                        @if ($project->start_date)
                            <div class="relative flex items-start">
                                <div class="absolute left-4 w-4 h-4 bg-green-500 rounded-full border-4 border-gray-800">
                                </div>
                                <div class="ml-12">
                                    <h4 class="text-lg font-semibold text-white">Project Started</h4>
                                    <p class="text-gray-400">{{ $project->start_date->format('F d, Y') }}</p>
                                    <p class="text-gray-300 mt-2">Project development began with initial planning and
                                        setup.</p>
                                </div>
                            </div>
                        @endif

                        <!-- Current Progress -->
                        <div class="relative flex items-start">
                            <div class="absolute left-4 w-4 h-4 bg-blue-500 rounded-full border-4 border-gray-800"></div>
                            <div class="ml-12">
                                <h4 class="text-lg font-semibold text-white">Current Progress</h4>
                                <p class="text-gray-400">{{ $project->updated_at->format('F d, Y') }}</p>
                                <p class="text-gray-300 mt-2">Project is {{ $project->progress_percentage }}% complete.
                                </p>
                                <div class="mt-3">
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-500"
                                            style="width: {{ $project->progress_percentage }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Expected Completion -->
                        @if ($project->expected_completion_date)
                            <div class="relative flex items-start">
                                <div class="absolute left-4 w-4 h-4 bg-purple-500 rounded-full border-4 border-gray-800">
                                </div>
                                <div class="ml-12">
                                    <h4 class="text-lg font-semibold text-white">Expected Completion</h4>
                                    <p class="text-gray-400">{{ $project->expected_completion_date->format('F d, Y') }}
                                    </p>
                                    <p class="text-gray-300 mt-2">Target completion date for project delivery.</p>
                                </div>
                            </div>
                        @endif

                        <!-- Project Completed (if applicable) -->
                        @if ($project->status === 'completed')
                            <div class="relative flex items-start">
                                <div class="absolute left-4 w-4 h-4 bg-green-500 rounded-full border-4 border-gray-800">
                                </div>
                                <div class="ml-12">
                                    <h4 class="text-lg font-semibold text-white">Project Completed</h4>
                                    <p class="text-gray-400">{{ $project->updated_at->format('F d, Y') }}</p>
                                    <p class="text-gray-300 mt-2">Project has been successfully completed and delivered.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-white mb-6">Quick Actions</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button onclick="updateProgress()"
                        class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fas fa-chart-line text-2xl mb-2"></i>
                        <div class="font-semibold">Update Progress</div>
                        <div class="text-sm opacity-90">Modify completion percentage</div>
                    </button>

                    <button onclick="changeStatus()"
                        class="bg-yellow-500 text-white p-4 rounded-lg hover:bg-yellow-600 transition-colors">
                        <i class="fas fa-exchange-alt text-2xl mb-2"></i>
                        <div class="font-semibold">Change Status</div>
                        <div class="text-sm opacity-90">Update project status</div>
                    </button>

                    <button onclick="deleteProject()"
                        class="bg-red-500 text-white p-4 rounded-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-2xl mb-2"></i>
                        <div class="font-semibold">Delete Project</div>
                        <div class="text-sm opacity-90">Remove project permanently</div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Edit Project</h2>
                    <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editForm" onsubmit="submitEditProject(event)">
                    <input type="hidden" id="editProjectId">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Name</label>
                            <input type="text" id="editProjectName" name="project_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Client Email</label>
                            <input type="email" id="editClientEmail" name="client_email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="editStatus" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Image URL</label>
                        <input type="url" id="editImage" name="image" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="https://example.com/image.jpg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="editDescription" name="description" required rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Progress (%)</label>
                            <input type="number" id="editProgressPercentage" name="progress_percentage" min="0"
                                max="100" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                            <input type="date" id="editStartDate" name="start_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Expected Completion</label>
                            <input type="date" id="editExpectedCompletionDate" name="expected_completion_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Project Phases -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Phases</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="editDesignCompleted" name="design_completed" class="mr-2">
                                <label for="editDesignCompleted" class="text-sm text-gray-700">Design</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="editDevelopmentCompleted" name="development_completed"
                                    class="mr-2">
                                <label for="editDevelopmentCompleted" class="text-sm text-gray-700">Development</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="editTestingCompleted" name="testing_completed"
                                    class="mr-2">
                                <label for="editTestingCompleted" class="text-sm text-gray-700">Testing</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="editDeploymentCompleted" name="deployment_completed"
                                    class="mr-2">
                                <label for="editDeploymentCompleted" class="text-sm text-gray-700">Deployment</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            <span id="editSubmitBtnText">Update Project</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Notification system
        function showNotification(title, message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());

            const notification = document.createElement('div');
            notification.className =
                `notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 translate-x-full`;

            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' :
                'fa-info-circle';

            notification.innerHTML = `
                <div class="flex items-center ${bgColor} text-white p-4 rounded-lg">
                    <i class="fas ${icon} mr-3 text-xl"></i>
                    <div class="flex-1">
                        <div class="font-semibold">${title}</div>
                        <div class="text-sm opacity-90">${message}</div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        if (notification.parentElement) {
                            notification.remove();
                        }
                    }, 300);
                }
            }, 5000);
        }

        function goBack() {
            window.location.href = '/admin/manage-client-progress';
        }

        function editProject() {
            // Populate the edit form with current project data
            document.getElementById('editProjectId').value = '{{ $project->uuid }}';
            document.getElementById('editProjectName').value = '{{ $project->project_name }}';
            document.getElementById('editDescription').value = '{{ $project->description }}';
            document.getElementById('editImage').value = '{{ $project->image }}';
            document.getElementById('editStatus').value = '{{ $project->status }}';
            document.getElementById('editProgressPercentage').value = '{{ $project->progress_percentage }}';
            document.getElementById('editClientEmail').value = '{{ $project->client_email }}';

            // Handle dates properly - format them for HTML date inputs
            @if ($project->start_date)
                document.getElementById('editStartDate').value = '{{ $project->start_date->format('Y-m-d') }}';
            @else
                document.getElementById('editStartDate').value = '';
            @endif

            @if ($project->expected_completion_date)
                document.getElementById('editExpectedCompletionDate').value =
                    '{{ $project->expected_completion_date->format('Y-m-d') }}';
            @else
                document.getElementById('editExpectedCompletionDate').value = '';
            @endif

            // Set phase checkboxes
            document.getElementById('editDesignCompleted').checked = {{ $project->design_completed ? 'true' : 'false' }};
            document.getElementById('editDevelopmentCompleted').checked =
                {{ $project->development_completed ? 'true' : 'false' }};
            document.getElementById('editTestingCompleted').checked = {{ $project->testing_completed ? 'true' : 'false' }};
            document.getElementById('editDeploymentCompleted').checked =
                {{ $project->deployment_completed ? 'true' : 'false' }};

            // Show the edit modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function submitEditProject(event) {
            event.preventDefault();

            // Prevent multiple submissions
            const submitButton = event.target.querySelector('button[type="submit"]');
            if (submitButton.disabled) {
                return;
            }

            // Disable submit button and show loading state
            submitButton.disabled = true;
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';

            const projectId = document.getElementById('editProjectId').value;
            const url = `/admin/client-projects/${projectId}`;
            const method = 'PUT';

            // Get form data manually to avoid FormData issues
            const formObject = {
                project_name: document.getElementById('editProjectName').value,
                description: document.getElementById('editDescription').value,
                image: document.getElementById('editImage').value,
                status: document.getElementById('editStatus').value,
                progress_percentage: parseInt(document.getElementById('editProgressPercentage').value),
                start_date: document.getElementById('editStartDate').value || null,
                expected_completion_date: document.getElementById('editExpectedCompletionDate').value || null,
                client_email: document.getElementById('editClientEmail').value || null,
                design_completed: document.getElementById('editDesignCompleted').checked,
                development_completed: document.getElementById('editDevelopmentCompleted').checked,
                testing_completed: document.getElementById('editTestingCompleted').checked,
                deployment_completed: document.getElementById('editDeploymentCompleted').checked
            };

            // Debug: Log the data being sent
            console.log('Sending data:', formObject);

            fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formObject)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Success!', 'Project updated successfully', 'success');
                        closeEditModal();
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        // Handle validation errors
                        if (data.errors) {
                            let errorMessage = 'Validation errors:\n';
                            Object.keys(data.errors).forEach(field => {
                                errorMessage += `• ${field}: ${data.errors[field].join(', ')}\n`;
                            });
                            showNotification('Error!', errorMessage, 'error');
                        } else {
                            showNotification('Error!', data.message, 'error');
                        }
                    }
                })
                .catch(error => {
                    showNotification('Error!', 'Network error occurred. Please try again.', 'error');
                })
                .finally(() => {
                    // Re-enable submit button
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                });
        }

        function sendEmail() {
            if (confirm('Send project notification email to the client?')) {
                fetch('/admin/client-projects/{{ $project->uuid }}/send-email', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Success!', 'Email sent successfully!', 'success');
                        } else {
                            showNotification('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showNotification('Error!', 'Error sending email: ' + error.message, 'error');
                    });
            }
        }

        function updateProgress() {
            const newProgress = prompt('Enter new progress percentage (0-100):', '{{ $project->progress_percentage }}');
            if (newProgress !== null && !isNaN(newProgress) && newProgress >= 0 && newProgress <= 100) {
                // Send update request
                fetch('/admin/client-projects/{{ $project->uuid }}', {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            project_name: '{{ $project->project_name }}',
                            description: '{{ $project->description }}',
                            image: '{{ $project->image }}',
                            status: '{{ $project->status }}',
                            progress_percentage: parseInt(newProgress),
                            start_date: '{{ $project->start_date }}',
                            expected_completion_date: '{{ $project->expected_completion_date }}'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Success!', 'Progress updated successfully', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showNotification('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showNotification('Error!', 'Network error occurred. Please try again.', 'error');
                    });
            }
        }

        function changeStatus() {
            const statuses = ['in_progress', 'completed', 'on_hold'];
            const statusNames = ['In Progress', 'Completed', 'On Hold'];
            const currentIndex = statuses.indexOf('{{ $project->status }}');

            const newStatus = prompt('Select new status:\n1. In Progress\n2. Completed\n3. On Hold\n\nEnter number (1-3):',
                currentIndex + 1);

            if (newStatus !== null && !isNaN(newStatus) && newStatus >= 1 && newStatus <= 3) {
                const selectedStatus = statuses[newStatus - 1];

                fetch('/admin/client-projects/{{ $project->uuid }}', {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            project_name: '{{ $project->project_name }}',
                            description: '{{ $project->description }}',
                            image: '{{ $project->image }}',
                            status: selectedStatus,
                            progress_percentage: {{ $project->progress_percentage }},
                            start_date: '{{ $project->start_date }}',
                            expected_completion_date: '{{ $project->expected_completion_date }}'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Success!', 'Status updated successfully', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showNotification('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showNotification('Error!', 'Network error occurred. Please try again.', 'error');
                    });
            }
        }

        function deleteProject() {
            if (confirm('Are you sure you want to delete this project? This action cannot be undone.')) {
                fetch('/admin/client-projects/{{ $project->uuid }}', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification('Success!', 'Project deleted successfully', 'success');
                            setTimeout(() => {
                                window.location.href = '/admin/manage-client-progress';
                            }, 1500);
                        } else {
                            showNotification('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showNotification('Error!', 'Network error occurred. Please try again.', 'error');
                    });
            }
        }

        function togglePhase(phase, completed) {
            fetch('/admin/client-projects/{{ $project->uuid }}/complete-phase', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        phase: phase,
                        completed: completed
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Success!', data.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showNotification('Error!', data.message, 'error');
                    }
                })
                .catch(error => {
                    showNotification('Error!', 'Network error occurred. Please try again.', 'error');
                });
        }
    </script>

@endsection
