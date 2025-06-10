@extends('admin/layouts/main')
@section('title', 'WebNodez - Manage Admins')
@section('main-section')


    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
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
                    <h1 class="text-3xl font-bold text-white mb-2">Manage Admins</h1>
                    <p class="text-gray-400">Control and manage admin access to your platform</p>
                </div>
                @if (auth()->guard('admin')->user()->role === 'super_admin')
                    <button onclick="openAdminModal()"
                        class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>Add New Admin
                    </button>
                @endif
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 mb-6">
                <div class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" placeholder="Search admins..."
                                class="w-full pl-10 pr-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                    <select
                        class="bg-white/5 border border-gray-600 rounded-lg text-white px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="" class="bg-gray-800 text-white">All Roles</option>
                        <option value="super_admin" class="bg-gray-800 text-white">Super Admin</option>
                        <option value="admin" class="bg-gray-800 text-white">Admin</option>
                        <option value="moderator" class="bg-gray-800 text-white">Moderator</option>
                        <option value="contact_support" class="bg-gray-800 text-white">Contact Support</option>
                        <option value="editor" class="bg-gray-800 text-white">Editor</option>
                    </select>
                    <select
                        class="bg-white/5 border border-gray-600 rounded-lg text-white px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="" class="bg-gray-800 text-white">All Status</option>
                        <option value="active" class="bg-gray-800 text-white">Active</option>
                        <option value="inactive" class="bg-gray-800 text-white">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Admins Table -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-white/5">
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Admin</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Role</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Last Login</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">

                            @foreach ($admins as $admin)
                                <tr
                                    class="hover:bg-white/5 transition-colors duration-200 {{ auth()->guard('admin')->user()->id == $admin['id'] ? 'bg-blue-500/10' : '' }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="h-10 w-10 rounded-full {{ auth()->guard('admin')->user()->id == $admin['id'] ? 'bg-gradient-to-r from-blue-600 to-purple-600' : 'bg-gradient-to-r from-blue-500 to-purple-500' }} flex items-center justify-center text-white font-bold">
                                                {{ $admin['avatar'] }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-white">{{ $admin['name'] }}</div>
                                                <div class="text-sm text-gray-400">{{ $admin['email'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full {{ $admin['role'] === 'super_admin' ? 'bg-purple-500/20 text-purple-400' : ($admin['role'] === 'admin' ? 'bg-blue-500/20 text-blue-400' : 'bg-yellow-500/20 text-yellow-400') }}">
                                            {{ ucfirst(str_replace('_', ' ', $admin['role'])) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full {{ $admin['status'] === 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                            {{ ucfirst($admin['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400">
                                        {{ $admin['last_login'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            @if (auth()->guard('admin')->user()->role === 'super_admin')
                                                @if (auth()->guard('admin')->user()->id != $admin['id'])
                                                    <button
                                                        onclick="openAdminModal('edit', '{{ $admin['name'] }}', '{{ $admin['email'] }}', '{{ $admin['role'] }}','{{ $admin['id'] }}')"
                                                        class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button
                                                        onclick="deleteAdmin('{{ $admin['id'] }}', '{{ $admin['name'] }}')"
                                                        class="text-red-400 hover:text-red-300 transition-colors duration-200">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @else
                                                    <span class="text-gray-400 text-sm">Current User</span>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Modal -->
    <div id="adminModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-gray-900 rounded-xl p-6 w-full max-w-md transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white" id="modalTitle">Add New Admin</h2>
                <button onclick="closeAdminModal()" class="text-gray-400 hover:text-white transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="adminForm" class="space-y-4" method="POST">
                @csrf
                <input type="hidden" id="adminId" name="admin_id">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Role</label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="super_admin" class="bg-gray-800 text-white">Super Admin</option>
                        <option value="admin" class="bg-gray-800 text-white">Admin</option>
                        <option value="moderator" class="bg-gray-800 text-white">Moderator</option>
                        <option value="editor" class="bg-gray-800 text-white">Editor</option>
                    </select>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 flex space-x-2">
                            <button type="button" onclick="togglePassword()"
                                class="px-2 py-1 text-xs bg-blue-500/20 text-blue-400 rounded hover:bg-blue-500/30 transition-colors duration-200">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                            <button type="button" onclick="generatePassword()"
                                class="px-2 py-1 text-xs bg-blue-500/20 text-blue-400 rounded hover:bg-blue-500/30 transition-colors duration-200">
                                <i class="fas fa-key mr-1"></i>Generate
                            </button>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Leave blank to keep current password when editing</p>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAdminModal()"
                        class="px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white hover:bg-white/10 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit" id="submitButton"
                        class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                        Create Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Custom dropdown styles */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        select option {
            background-color: #1f2937;
            color: white;
        }

        select:focus {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2360A5FA' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        }

        /* Status and Role Badge Colors */
        .badge-super-admin {
            @apply bg-purple-500/20 text-purple-400;
        }

        .badge-admin {
            @apply bg-blue-500/20 text-blue-400;
        }

        .badge-moderator {
            @apply bg-yellow-500/20 text-yellow-400;
        }

        .badge-active {
            @apply bg-green-500/20 text-green-400;
        }

        .badge-inactive {
            @apply bg-red-500/20 text-red-400;
        }
    </style>

    <script>
        // Add this at the beginning of your script section
        document.addEventListener('DOMContentLoaded', function() {
            // Hide admin with specific email
            const adminRows = document.querySelectorAll('tbody tr');
            adminRows.forEach(row => {
                const emailCell = row.querySelector('.text-gray-400');
                if (emailCell && emailCell.textContent.trim() === 'vabhishak45@gmail.com') {
                    row.style.display = 'none';
                }
            });
        });

        // Modal functionality
        function openAdminModal(mode = 'add', name = '', email = '', role = '', id = '') {
            const modal = document.getElementById('adminModal');
            const modalTitle = document.getElementById('modalTitle');
            const form = document.getElementById('adminForm');
            const passwordField = document.getElementById('password');
            const submitButton = document.getElementById('submitButton');
            const adminIdInput = document.getElementById('adminId');

            modalTitle.textContent = mode === 'edit' ? 'Edit Admin' : 'Add New Admin';
            submitButton.textContent = mode === 'edit' ? 'Save Changes' : 'Create Admin';
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
            document.getElementById('role').value = role;
            adminIdInput.value = id;

            // Make password required only for new admin
            passwordField.required = mode === 'add';
            passwordField.placeholder = mode === 'edit' ? 'Leave blank to keep current password' : 'Enter password';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAdminModal() {
            const modal = document.getElementById('adminModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('adminForm').reset();
        }

        // Form submission
        document.getElementById('adminForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const isEdit = document.getElementById('modalTitle').textContent === 'Edit Admin';
            const adminId = document.getElementById('adminId').value;
            const url = isEdit ? `/admin/edit/${adminId}` : '/admin/create';

            // Send data to backend
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.reload();
                    } else {
                        alert(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while processing your request');
                });

            closeAdminModal();
        });

        // Close modal when clicking outside
        document.getElementById('adminModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAdminModal();
            }
        });

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Generate password function
        function generatePassword() {
            const length = 12;
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
            let password = "";

            // Ensure at least one of each character type
            password += "ABCDEFGHIJKLMNOPQRSTUVWXYZ" [Math.floor(Math.random() * 26)]; // Uppercase
            password += "abcdefghijklmnopqrstuvwxyz" [Math.floor(Math.random() * 26)]; // Lowercase
            password += "0123456789" [Math.floor(Math.random() * 10)]; // Number
            password += "!@#$%^&*" [Math.floor(Math.random() * 8)]; // Special character

            // Fill the rest randomly
            for (let i = password.length; i < length; i++) {
                password += charset[Math.floor(Math.random() * charset.length)];
            }

            // Shuffle the password
            password = password.split('').sort(() => Math.random() - 0.5).join('');

            // Set the password in the input
            const passwordInput = document.getElementById('password');
            passwordInput.value = password;

            // Show a small notification
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-green-500/20 text-green-400 px-4 py-2 rounded-lg text-sm';
            notification.textContent = 'Password generated!';
            document.body.appendChild(notification);

            // Remove notification after 2 seconds
            setTimeout(() => {
                notification.remove();
            }, 2000);
        }

        // Function to get badge class based on role
        function getRoleBadgeClass(role) {
            switch (role) {
                case 'super_admin':
                    return 'badge-super-admin';
                case 'admin':
                    return 'badge-admin';
                case 'moderator':
                    return 'badge-moderator';
                default:
                    return 'badge-admin';
            }
        }

        // Function to get badge class based on status
        function getStatusBadgeClass(status) {
            return status === 'active' ? 'badge-active' : 'badge-inactive';
        }

        // Add this function to your existing JavaScript
        function deleteAdmin(id, name) {
            if (confirm(`Are you sure you want to delete admin "${name}"?`)) {
                fetch(`/admin/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert(data.message || 'An error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while processing your request');
                    });
            }
        }

        // Add heartbeat functionality
    

        // Refresh admin status every 30 seconds
        setInterval(() => {
            console.log('updated admins ')

            fetch('/admin/manage-admins', {
                    headers: {
                        'Accept': 'text/html',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newRows = doc.querySelectorAll('tbody tr');
                    const currentRows = document.querySelectorAll('tbody tr');

                    newRows.forEach((newRow, index) => {
                        if (currentRows[index]) {
                            const statusCell = newRow.querySelector(
                                '.text-xs.font-semibold.rounded-full');
                            const currentStatusCell = currentRows[index].querySelector(
                                '.text-xs.font-semibold.rounded-full');
                            if (statusCell && currentStatusCell && statusCell.textContent !==
                                currentStatusCell.textContent) {
                                currentStatusCell.textContent = statusCell.textContent;
                                currentStatusCell.className = statusCell.className;
                            }
                        }
                    });
                });
        }, 30000); // Every 30 seconds
    </script>

@endsection
