@extends('admin/layouts/main')
@section('title', 'Linkuss - Manage Client Progress')
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
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Client Project Progress</h1>
                    <p class="text-gray-400">Manage and track client project progress</p>
                </div>
                <button onclick="openAddModal()"
                    class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i>Add New Project
                </button>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <div
                        class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-blue-500/20">
                        <div class="relative mb-4">
                            <img src="{{ $project->image }}" alt="{{ $project->project_name }}"
                                class="w-full h-48 object-cover rounded-lg">
                            <div class="absolute top-2 right-2">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $project->getStatusBadgeClass() }}">
                                    {{ $project->getStatusText() }}
                                </span>
                            </div>
                        </div>

                        <h3 class="text-xl font-semibold text-white mb-2">{{ $project->project_name }}</h3>
                        <p class="text-gray-400 text-sm mb-4"
                            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ Str::limit($project->description, 100) }}</p>

                        <!-- Project Phases -->
                        <div class="mb-4">
                            <div class="text-sm text-gray-400 mb-2">Project Phases</div>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex items-center">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $project->design_completed ? 'bg-green-500' : 'bg-gray-500' }} mr-2">
                                    </div>
                                    <span class="text-xs text-gray-300">Design</span>
                                </div>
                                <div class="flex items-center">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $project->development_completed ? 'bg-green-500' : 'bg-gray-500' }} mr-2">
                                    </div>
                                    <span class="text-xs text-gray-300">Dev</span>
                                </div>
                                <div class="flex items-center">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $project->testing_completed ? 'bg-green-500' : 'bg-gray-500' }} mr-2">
                                    </div>
                                    <span class="text-xs text-gray-300">Testing</span>
                                </div>
                                <div class="flex items-center">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $project->deployment_completed ? 'bg-green-500' : 'bg-gray-500' }} mr-2">
                                    </div>
                                    <span class="text-xs text-gray-300">Deploy</span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-400 mb-1">
                                <span>Progress</span>
                                <span>{{ $project->progress_percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-300"
                                    style="width: {{ $project->progress_percentage }}%"></div>
                            </div>
                        </div>

                        <!-- Project Dates -->
                        <div class="text-xs text-gray-400 mb-4">
                            @if ($project->start_date)
                                <div>Started: {{ $project->start_date->format('M d, Y') }}</div>
                            @endif
                            @if ($project->expected_completion_date)
                                <div>Expected: {{ $project->expected_completion_date->format('M d, Y') }}</div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <button onclick="viewProgress('{{ $project->uuid }}')"
                                class="flex-1 bg-blue-500 text-white px-3 py-2 rounded-lg text-sm font-semibold hover:bg-blue-600 transition-colors">
                                <i class="fas fa-eye mr-1"></i>View Progress
                            </button>
                            <button onclick="sendEmail('{{ $project->uuid }}')"
                                class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm font-semibold hover:bg-green-600 transition-colors">
                                <i class="fas fa-envelope"></i>
                            </button>
                            <button onclick="deleteProject('{{ $project->uuid }}')"
                                class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm font-semibold hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($projects->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-folder-open text-6xl text-gray-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-400 mb-2">No Projects Yet</h3>
                    <p class="text-gray-500 mb-4">Start by adding your first client project</p>
                    <button onclick="openAddModal()"
                        class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i>Add First Project
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Add/Edit Project Modal -->
    <div id="projectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Add New Project</h2>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="projectForm" onsubmit="submitProject(event)">
                    <input type="hidden" id="projectId" name="project_id">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Name</label>
                            <input type="text" id="projectName" name="project_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Client Email</label>
                            <input type="email" id="clientEmail" name="client_email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Image URL</label>
                        <input type="url" id="image" name="image" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="https://example.com/image.jpg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" required rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Progress (%)</label>
                            <input type="number" id="progressPercentage" name="progress_percentage" min="0"
                                max="100" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                            <input type="date" id="startDate" name="start_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Expected Completion</label>
                            <input type="date" id="expectedCompletionDate" name="expected_completion_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Project Phases -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Phases</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="designCompleted" name="design_completed" class="mr-2">
                                <label for="designCompleted" class="text-sm text-gray-700">Design</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="developmentCompleted" name="development_completed"
                                    class="mr-2">
                                <label for="developmentCompleted" class="text-sm text-gray-700">Development</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="testingCompleted" name="testing_completed" class="mr-2">
                                <label for="testingCompleted" class="text-sm text-gray-700">Testing</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="deploymentCompleted" name="deployment_completed"
                                    class="mr-2">
                                <label for="deploymentCompleted" class="text-sm text-gray-700">Deployment</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            <span id="submitBtnText">Add Project</span>
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

        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Add New Project';
            document.getElementById('submitBtnText').textContent = 'Add Project';
            document.getElementById('projectForm').reset();
            document.getElementById('projectId').value = '';
            document.getElementById('projectModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('projectModal').classList.add('hidden');
        }



        function submitProject(event) {
            event.preventDefault();

            // Prevent multiple submissions
            const submitButton = event.target.querySelector('button[type="submit"]');
            if (submitButton.disabled) {
                return;
            }

            // Disable submit button and show loading state
            submitButton.disabled = true;
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';

            const formData = new FormData(event.target);
            const projectId = document.getElementById('projectId').value;
            const url = projectId ? `/admin/client-projects/${projectId}` : '/admin/client-projects';
            const method = projectId ? 'PUT' : 'POST';

            fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Success!', data.message, 'success');
                        closeModal();
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showNotification('Error!', data.message, 'error');
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

        function deleteProject(uuid) {
            if (confirm('Are you sure you want to delete this project?')) {
                fetch(`/admin/client-projects/${uuid}`, {
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

        function viewProgress(uuid) {
            window.location.href = `/admin/client-projects/${uuid}/progress`;
        }

        function sendEmail(uuid) {
            if (confirm('Send project notification email to the client?')) {
                fetch(`/admin/client-projects/${uuid}/send-email`, {
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
    </script>

@endsection
