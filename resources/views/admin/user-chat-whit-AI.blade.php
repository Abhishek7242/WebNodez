@extends('admin/layouts/main')
@section('title', 'WebNodez - User AI Chat Monitor')
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
                    <h1 class="text-3xl font-bold text-white mb-2">User AI Chat Monitor</h1>
                    <p class="text-gray-400">Monitor and manage user conversations with AI</p>
                </div>
                <div class="flex space-x-4">
                    <button
                        class="bg-gradient-to-r from-green-500 to-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-green-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-robot mr-2"></i>Active Conversations
                    </button>
                    <button
                        class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-purple-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-chart-line mr-2"></i>Analytics
                    </button>
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
                            <input type="text" id="searchInput" placeholder="Search conversations..."
                                class="w-full pl-10 pr-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                    <select id="statusFilter"
                        class="bg-white/5 border border-gray-600 rounded-lg text-white px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="" class="bg-gray-800 text-white">All Users</option>
                        <option value="active" class="bg-gray-800 text-white">Active Users</option>
                        <option value="inactive" class="bg-gray-800 text-white">Inactive Users</option>
                    </select>
                    <select id="timeFilter"
                        class="bg-white/5 border border-gray-600 rounded-lg text-white px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="" class="bg-gray-800 text-white">All Time</option>
                        <option value="today" class="bg-gray-800 text-white">Today</option>
                        <option value="week" class="bg-gray-800 text-white">This Week</option>
                        <option value="month" class="bg-gray-800 text-white">This Month</option>
                    </select>
                </div>
            </div>

            <!-- Chat Conversations -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Chat List -->
                <div class="lg:col-span-1 bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden">
                    <div class="p-4 border-b border-gray-700">
                        <h2 class="text-lg font-semibold text-white">Recent Conversations</h2>
                    </div>
                    <div class="overflow-y-auto max-h-[600px]">
                     

                        @foreach ($conversations as $conversation)
                            <div class="p-4 hover:bg-white/5 cursor-pointer transition-colors duration-200 border-b border-gray-700 chat-item"
                                onclick="showChat('{{ $conversation['user'] }}', '{{ $conversation['email'] }}', '{{ $conversation['avatar'] }}', '{{ $conversation['status'] }}')">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                                        {{ $conversation['avatar'] }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="text-sm font-medium text-white truncate">
                                                    {{ $conversation['user'] }}</p>
                                                <p class="text-xs text-gray-400 truncate">{{ $conversation['email'] }}</p>
                                            </div>
                                            <span class="text-xs text-gray-400">{{ $conversation['time'] }}</span>
                                        </div>
                                        <p class="text-sm text-gray-300 mt-1 truncate">{{ $conversation['last_message'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Chat Details -->
                <div class="lg:col-span-2 bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden" id="chatDetails">
                    <div class="p-4 border-b border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold"
                                    id="chatAvatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-white" id="chatUserName">Select a User</h2>
                                    <p class="text-sm text-gray-400" id="chatUserEmail">Choose a conversation to view
                                        messages</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full" id="chatStatus">
                                    Inactive
                                </span>
                                <button onclick="showUserDetails()"
                                    class="text-gray-400 hover:text-white transition-colors duration-200"
                                    id="userDetailsBtn" style="display: none;">
                                    <i class="fas fa-user-circle"></i>
                                </button>
                                <button class="text-gray-400 hover:text-white transition-colors duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 space-y-4 max-h-[500px] overflow-y-auto" id="chatMessages">
                        <!-- Default state when no user is selected -->
                        <div class="flex items-center justify-center h-[400px]">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-comments text-4xl mb-2"></i>
                                <p>Select a conversation to view messages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Details Modal -->
    <div id="userDetailsModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-gray-900 rounded-xl p-6 w-full max-w-md transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white">User Details</h2>
                <button onclick="closeUserDetailsModal()"
                    class="text-gray-400 hover:text-white transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <div class="text-white" id="modalUserEmail"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                    <div class="text-white" id="modalUserPhone"></div>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button onclick="closeUserDetailsModal()"
                    class="px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white hover:bg-white/10 transition-colors duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .chat-item.active {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>

    <script>
        // Chat messages from database
        const chatMessages = @json($messages);

        // Store user details
        const userDetails = @json($conversations);

        // Filter functions
        function filterConversations() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const timeFilter = document.getElementById('timeFilter').value;

            const chatItems = document.querySelectorAll('.chat-item');
            const chatMessagesContainer = document.getElementById('chatMessages');
            const chatDetails = document.getElementById('chatDetails');

            // Get current time in IST
            const now = new Date();
            const istOffset = 5.5 * 60 * 60 * 1000; // IST is UTC+5:30
            const istNow = new Date(now.getTime() + istOffset);

            // Set time to start of day in IST
            const todayStart = new Date(istNow.getTime() - (24 * 60 * 60 * 1000)); // Last 24 hours
            const weekStart = new Date(istNow.getTime() - (7 * 24 * 60 * 60 * 1000)); // Last 7 days
            const monthStart = new Date(istNow.getTime() - (30 * 24 * 60 * 60 * 1000)); // Last 30 days

            let visibleChats = 0;

            chatItems.forEach(item => {
                const userName = item.querySelector('.text-white').textContent.toLowerCase();
                const userEmail = item.querySelector('.text-gray-400').textContent.toLowerCase();
                const lastMessage = item.querySelector('.text-gray-300').textContent.toLowerCase();
                const status = item.querySelector('.text-gray-400').textContent.includes('Active') ? 'active' :
                    'inactive';

                // Get messages for this user from the database
                const userMessages = chatMessages[userName] || [];
                let messageTime;

                if (userMessages.length > 0) {
                    // Get the last message time from the database
                    const lastMessageTime = userMessages[userMessages.length - 1].time;

                    // Parse the time from the database
                    if (lastMessageTime.includes('minute')) {
                        const minutes = parseInt(lastMessageTime.match(/\d+/)[0]);
                        messageTime = new Date(now.getTime() - (minutes * 60 * 1000));
                    } else if (lastMessageTime.includes('hour')) {
                        const hours = parseInt(lastMessageTime.match(/\d+/)[0]);
                        messageTime = new Date(now.getTime() - (hours * 60 * 60 * 1000));
                    } else if (lastMessageTime.includes('day')) {
                        const days = parseInt(lastMessageTime.match(/\d+/)[0]);
                        messageTime = new Date(now.getTime() - (days * 24 * 60 * 60 * 1000));
                    } else if (lastMessageTime.includes('second')) {
                        messageTime = new Date(now.getTime());
                    } else {
                        // Handle datetime format (e.g., "2025-06-05 11:15:21")
                        try {
                            messageTime = new Date(lastMessageTime);
                            if (isNaN(messageTime.getTime())) {
                                // If parsing fails, use current time
                                messageTime = new Date(now.getTime());
                            }
                        } catch (e) {
                            messageTime = new Date(now.getTime());
                        }
                    }
                } else {
                    // If no messages, use the time from the conversation list
                    const timeText = item.querySelector('.text-gray-400').textContent;
                    if (timeText.includes('minute')) {
                        const minutes = parseInt(timeText.match(/\d+/)[0]);
                        messageTime = new Date(now.getTime() - (minutes * 60 * 1000));
                    } else if (timeText.includes('hour')) {
                        const hours = parseInt(timeText.match(/\d+/)[0]);
                        messageTime = new Date(now.getTime() - (hours * 60 * 60 * 1000));
                    } else if (timeText.includes('day')) {
                        const days = parseInt(timeText.match(/\d+/)[0]);
                        messageTime = new Date(now.getTime() - (days * 24 * 60 * 60 * 1000));
                    } else if (timeText.includes('second')) {
                        messageTime = new Date(now.getTime());
                    } else {
                        try {
                            // Handle datetime format (e.g., "2025-06-05 11:15:21")
                            messageTime = new Date(timeText);
                            if (isNaN(messageTime.getTime())) {
                                // If parsing fails, use current time
                                messageTime = new Date(now.getTime());
                            }
                        } catch (e) {
                            messageTime = new Date(now.getTime());
                        }
                    }
                }

                // Convert message time to IST
                messageTime = new Date(messageTime.getTime() + istOffset);

                // Time filter logic
                let timeMatch = true;
                if (timeFilter) {
                    switch (timeFilter) {
                        case 'today':
                            // Set today's start time in IST
                            const todayStartIST = new Date(istNow);
                            todayStartIST.setHours(0, 0, 0, 0);
                            timeMatch = messageTime >= todayStartIST;
                            console.log(messageTime, todayStartIST)
                            break;
                        case 'week':
                            // Set week's start time in IST (last 7 days)
                            const weekStartIST = new Date(istNow);
                            weekStartIST.setDate(weekStartIST.getDate() - 7);
                            timeMatch = messageTime >= weekStartIST;
                            break;
                        case 'month':
                            // Set month's start time in IST (last 30 days)
                            const monthStartIST = new Date(istNow);
                            monthStartIST.setDate(monthStartIST.getDate() - 30);
                            timeMatch = messageTime >= monthStartIST;
                            break;
                    }
                }

                // Status filter logic
                const statusMatch = !statusFilter || status === statusFilter;

                // Search term logic
                const searchMatch = !searchTerm ||
                    userName.includes(searchTerm) ||
                    userEmail.includes(searchTerm) ||
                    lastMessage.includes(searchTerm);

                // Show/hide based on all filters
                if (statusMatch && timeMatch && searchMatch) {
                    item.style.display = '';
                    visibleChats++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Hide chat details if no conversations are visible
            if (visibleChats === 0) {
                chatDetails.style.display = 'none';
                chatMessagesContainer.innerHTML = `
                    <div class="flex items-center justify-center h-full">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-search text-4xl mb-2"></i>
                            <p>No conversations match your filters</p>
                        </div>
                    </div>
                `;
            } else {
                chatDetails.style.display = '';
                // If the currently displayed chat is hidden by filters, show the first visible chat
                const activeChat = document.querySelector('.chat-item.active');
                if (activeChat && activeChat.style.display === 'none') {
                    const firstVisibleChat = document.querySelector('.chat-item[style=""]');
                    if (firstVisibleChat) {
                        const userName = firstVisibleChat.querySelector('.text-white').textContent;
                        const userEmail = firstVisibleChat.querySelector('.text-gray-400').textContent;
                        const userAvatar = firstVisibleChat.querySelector('.rounded-full').textContent.trim();
                        const userStatus = firstVisibleChat.querySelector('.text-gray-400').textContent.includes('Active') ?
                            'active' : 'inactive';
                        showChat(userName, userEmail, userAvatar, userStatus);
                    }
                }
            }
        }

        // Add event listeners for filters
        document.getElementById('searchInput').addEventListener('input', filterConversations);
        document.getElementById('statusFilter').addEventListener('change', filterConversations);
        document.getElementById('timeFilter').addEventListener('change', filterConversations);

        function showChat(userName, userEmail, userAvatar, userStatus) {
            // Update chat header
            document.getElementById('chatAvatar').textContent = userAvatar;
            document.getElementById('chatUserName').textContent = userName;
            document.getElementById('chatUserEmail').textContent = userEmail;

            // Show/hide user details button based on available information
            const userDetailsBtn = document.getElementById('userDetailsBtn');
            const user = userDetails.find(u => u.user === userName);
            if (user && (user.email !== user.visitor_id + '@visitor.com' || user.phone)) {
                userDetailsBtn.style.display = 'block';
            } else {
                userDetailsBtn.style.display = 'none';
            }

            // Update status badge
            const statusBadge = document.getElementById('chatStatus');
            statusBadge.textContent = userStatus.charAt(0).toUpperCase() + userStatus.slice(1);
            statusBadge.className = `px-3 py-1 text-xs font-semibold rounded-full ${
                userStatus === 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400'
            }`;

            // Update active state in chat list
            document.querySelectorAll('.chat-item').forEach(item => {
                item.classList.remove('active');
                if (item.querySelector('.text-white').textContent === userName) {
                    item.classList.add('active');
                }
            });

            // Load chat messages
            const chatMessagesContainer = document.getElementById('chatMessages');
            chatMessagesContainer.innerHTML = '';

            const messages = chatMessages[userName] || [];
            messages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.className = `flex items-start space-x-3 ${msg.type === 'user' ? 'justify-end' : ''}`;

                const messageContent = `
                    ${msg.type === 'user' ? `
                                <div class="flex-1 text-right">
                                    <div class="bg-blue-500/20 rounded-lg p-3 inline-block">
                                        <p class="text-sm text-blue-400">${msg.message}</p>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-1 block">${msg.time}</span>
                                </div>
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-sm">
                                    ${userAvatar}
                                </div>
                            ` : `
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-sm">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-white/5 rounded-lg p-3">
                                        <p class="text-sm text-gray-300">${msg.message}</p>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-1">${msg.time}</span>
                                </div>
                            `}
                `;

                messageDiv.innerHTML = messageContent;
                chatMessagesContainer.appendChild(messageDiv);
            });

            // Scroll to bottom of chat
            chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
        }

        function showUserDetails() {
            const userName = document.getElementById('chatUserName').textContent;
            const user = userDetails.find(u => u.user === userName);

            if (user) {
                document.getElementById('modalUserEmail').textContent = user.email;
                document.getElementById('modalUserPhone').textContent = user.phone || 'Not provided';

                document.getElementById('userDetailsModal').classList.remove('hidden');
                document.getElementById('userDetailsModal').classList.add('flex');
            }
        }

        function closeUserDetailsModal() {
            document.getElementById('userDetailsModal').classList.add('hidden');
            document.getElementById('userDetailsModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('userDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUserDetailsModal();
            }
        });

        // Show first chat by default
        document.addEventListener('DOMContentLoaded', () => {
            // Remove the automatic selection of first chat
            // const firstChat = document.querySelector('.chat-item');
            // if (firstChat) {
            //     const userName = firstChat.querySelector('.text-white').textContent;
            //     const userEmail = firstChat.querySelector('.text-gray-400').textContent;
            //     const userAvatar = firstChat.querySelector('.rounded-full').textContent.trim();
            //     const userStatus = firstChat.querySelector('.text-gray-400').textContent.includes('Active') ?
            //         'active' : 'inactive';
            //     showChat(userName, userEmail, userAvatar, userStatus);
            // }
        });
    </script>

@endsection
