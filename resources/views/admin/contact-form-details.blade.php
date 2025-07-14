@extends('admin/layouts/main')
@section('title', 'Linkuss - Contact Form Details')
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
                    <h1 class="text-3xl font-bold text-white mb-2">Contact Form Submissions</h1>
                    <p class="text-gray-400">View and manage all contact form submissions</p>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 mb-6">
                <div class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" placeholder="Search submissions..."
                                class="w-full pl-10 pr-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                    <select id="statusFilter"
                        class="bg-white/5 border border-gray-600 rounded-lg text-white px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="" class="bg-gray-800 text-white">All Status</option>
                        <option value="new" class="bg-gray-800 text-white">New</option>
                        <option value="read" class="bg-gray-800 text-white">Read</option>
                        <option value="replied" class="bg-gray-800 text-white">Replied</option>
                    </select>
                </div>
            </div>

            <!-- Contact Form Submissions Table -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-white/5">
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">S No</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Name</th>

                                {{-- <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Date</th> --}}
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($contacts as $contact)
                                <tr data-message-id="{{ $contact['id'] }}"
                                    class="hover:bg-white/5 transition-colors duration-200">

                                    <td class="px-6 py-4">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-semibold text-sm">
                                            {{ $no }}
                                        </div>
                                    </td>
                                    @php
                                        $no++;
                                    @endphp

                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-white">{{ $contact['name'] }}</div>
                                    </td>

                                    {{-- <td class="px-6 py-4">
                                        <div class="text-sm text-gray-300">
                                            {{ $contact['created_at']->format('M d, Y H:i') }}
                                        </div>
                                    </td> --}}
                                    <td class="px-6 py-4">
                                        <span
                                            class="status-badge px-3 py-1 text-xs font-semibold rounded-full 
                                        {{ $contact['status'] === 'New'
                                            ? 'bg-blue-500/20 text-blue-400'
                                            : ($contact['status'] === 'read'
                                                ? 'bg-yellow-500/20 text-yellow-400'
                                                : 'bg-green-500/20 text-green-400') }}">
                                            {{ ucfirst($contact['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <button onclick="viewMessage('{{ $contact['id'] }}')"
                                                class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="deleteMessage('{{ $contact['id'] }}')"
                                            class="text-red-400 hover:text-red-300 transition-colors duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button onclick="markAsReplied('{{ $contact['id'] }}')"
                                            class="text-yellow-400 {{ $contact['status'] === 'Replied' ? 'hidden' : '' }} hover:text-yellow-300 transition-colors duration-200">
                                            <i class="fas fa-check"></i>
                                        </button>
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

    <!-- Message View Modal -->
    <div id="messageModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-gray-900 rounded-xl p-6 w-full max-w-2xl transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white">Message Details</h2>
                <button onclick="closeMessageModal()" class="text-gray-400 hover:text-white transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                    <div class="text-white" id="modalName"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <div class="text-white" id="modalEmail"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                    <div class="text-white" id="modalPhone"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Message</label>
                    <div class="text-white whitespace-pre-wrap" id="modalMessage"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Date</label>
                    <div class="text-white" id="modalDate"></div>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button onclick="closeMessageModal()"
                    class="px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white hover:bg-white/10 transition-colors duration-200">
                    Close
                </button>
                <a href="#" id="replyEmailLink"
                    class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300">
                    Reply via Email
                </a>
            </div>
        </div>
    </div>

    <script>
        let currentMessageId = null;

        function viewMessage(id) {
            currentMessageId = id;
            // Fetch message details and show modal
            fetch(`/admin/contact/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalName').textContent = data.name;
                    document.getElementById('modalEmail').textContent = data.email;
                    document.getElementById('modalPhone').textContent = data.phone || 'N/A';
                    document.getElementById('modalMessage').textContent = data.message;
                    document.getElementById('modalDate').textContent = new Date(data.created_at).toLocaleString();
                    document.getElementById('replyEmailLink').href = `mailto:${data.email}`;

                    // Hide reply button if status is replied
                    const replyButton = document.getElementById('replyEmailLink');
                    console.log('Message Status:', data.status); // Debug log

                    // Get the status from the table row
                    const statusCell = document.querySelector(`tr[data-message-id="${id}"] .status-badge`);
                    const currentStatus = statusCell ? statusCell.textContent.trim().toLowerCase() : '';
                    console.log('Current Status:', currentStatus); // Debug log

                    if (currentStatus === 'replied') {
                        replyButton.style.display = 'none';
                    } else {
                        replyButton.style.display = 'inline-block';
                    }

                    document.getElementById('messageModal').classList.remove('hidden');
                    document.getElementById('messageModal').classList.add('flex');
                });
        }

        function closeMessageModal() {
            document.getElementById('messageModal').classList.add('hidden');
            document.getElementById('messageModal').classList.remove('flex');

            if (currentMessageId) {
                const statusCell = document.querySelector(`tr[data-message-id="${currentMessageId}"] .status-badge`);
                if (statusCell && statusCell.textContent.trim().toLowerCase() === 'new') {
                    statusCell.textContent = 'Read';
                    statusCell.classList.remove('bg-blue-500/20', 'text-blue-400');
                    statusCell.classList.add('bg-yellow-500/20', 'text-yellow-400');
                }
            }
            currentMessageId = null;
        }

        function markAsReplied(id) {
            if (confirm('Are you sure you replied to this message?')) {
                fetch(`/admin/contact/${id}/mark-replied`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        }
                    });
            }
        }

        function deleteMessage(id) {
            if (confirm('Are you sure you want to delete this message?')) {
                fetch(`/admin/contact/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Message deleted successfully');
                            window.location.reload();
                        }
                    });
            }
        }

        // Close modal when clicking outside
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMessageModal();
            }
        });

        // Add this to your existing script section
        document.getElementById('statusFilter').addEventListener('change', function() {
            const selectedStatus = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const statusCell = row.querySelector('.status-badge');
                const status = statusCell.textContent.trim().toLowerCase();

                if (selectedStatus === '' || status === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Add search functionality
        document.querySelector('input[type="text"]').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const status = row.querySelector('.status-badge').textContent.toLowerCase();

                if (name.includes(searchTerm) || status.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

@endsection
