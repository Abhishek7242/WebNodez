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
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 mb-6 shadow-xl border border-gray-700/50">
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
                    <button id="filterButton" type="button"
                        class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </div>

            <!-- Chat Conversations -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Chat List -->
                <div
                    class="lg:col-span-1 bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden shadow-xl border border-gray-700/50">
                    <div class="p-4 border-b border-gray-700 bg-gradient-to-r from-gray-800/50 to-gray-900/50">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-inbox mr-2 text-blue-400"></i>
                            Recent Conversations
                        </h2>
                    </div>
                    <div id="visitorList" class="overflow-y-auto max-h-[600px] custom-scrollbar">
                        @foreach ($conversations as $conversation)
                            <div class="visitor chat-item p-4 hover:bg-white/5 cursor-pointer transition-all duration-200 border-b border-gray-700/50 group"
                                data-user="{{ $conversation['user'] }}" data-visitor-id="{{ $conversation['visitor_id'] }}"
                                onclick="showChat('{{ $conversation['user'] }}', '{{ $conversation['visitor_id'] }}', '{{ $conversation['email'] }}', '{{ $conversation['status'] }}', '{{ $conversation['avatar'] }}')">
                                <div class="chat-item-content flex items-start space-x-3">
                                    <div
                                        class="chat-avatar h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-sm flex-shrink-0 shadow-lg group-hover:scale-105 transition-transform duration-200">
                                        {{ $conversation['avatar'] }}
                                    </div>
                                    <div class="chat-details flex-1 min-w-0">
                                        <div class="chat-header flex justify-between items-start">
                                            <div class="chat-user-info min-w-0">
                                                <p
                                                    class="chat-username text-sm font-medium text-white truncate group-hover:text-blue-400 transition-colors duration-200">
                                                    {{ $conversation['user'] }}
                                                </p>
                                                <p class="chat-email text-xs text-gray-400 truncate">
                                                    {{ $conversation['email'] }}
                                                </p>
                                            </div>
                                            <div class="chat-status-container flex flex-col items-end ml-2 flex-shrink-0">
                                                @if ($conversation['status'] === 'active')
                                                    <div
                                                        class="chat-status-indicator flex items-center space-x-1 bg-green-500/10 px-2 py-1 rounded-full">
                                                        <span
                                                            class="status-dot h-2 w-2 bg-green-500 rounded-full animate-pulse"></span>
                                                        <span class="status-text text-xs text-green-400">Active</span>
                                                    </div>
                                                @endif
                                                <span
                                                    class="chat-time text-xs text-gray-400 mt-1">{{ $conversation['time'] }}</span>
                                            </div>
                                        </div>
                                        <p
                                            class="chat-last-message text-sm text-gray-300 mt-1 truncate group-hover:text-gray-200 transition-colors duration-200">
                                            {{ $conversation['last_message'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Chat Details -->
                <div class="lg:col-span-2 bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden shadow-xl border border-gray-700/50"
                    id="chatDetails">
                    <div class="p-4 border-b border-gray-700 bg-gradient-to-r from-gray-800/50 to-gray-900/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-lg"
                                    id="chatAvatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-white" id="chatUserName">Select a User</h2>
                                    <p class="text-sm text-gray-400" id="chatUserEmail">Choose a conversation to view
                                        messages</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3" id="chatDetailsButtons">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-700/50 text-gray-300"
                                    id="chatStatus">
                                    Inactive
                                </span>
                                <button onclick="takeChatControl()"
                                    class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:shadow-lg hover:shadow-green-500/50 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center">
                                    <i class="fas fa-user-shield mr-2"></i>Take Control
                                </button>
                                <button onclick="showUserInfo()"
                                    class="text-gray-400 hover:text-white transition-colors duration-200 p-2 rounded-lg hover:bg-white/5">
                                    <i class="fas fa-info-circle text-lg"></i>
                                </button>
                                <button
                                    class="text-gray-400 hover:text-white transition-colors duration-200 p-2 rounded-lg hover:bg-white/5">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 space-y-4 max-h-[500px] overflow-y-auto custom-scrollbar" id="chatMessages">
                        <!-- Default state when no user is selected -->
                        <div class="flex items-center justify-center h-[400px]">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-comments text-4xl mb-3 text-blue-400"></i>
                                <p class="text-lg font-medium">Select a conversation to view messages</p>
                                <p class="text-sm mt-1">Choose from the list on the left to start chatting</p>
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

    <!-- User Info Modal -->
    <div id="userInfoModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-gray-900 rounded-xl p-6 w-full max-w-md transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white">User Information</h2>
                <button onclick="closeUserInfoModal()"
                    class="text-gray-400 hover:text-white transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <div class="text-white" id="infoUserEmail"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                    <div class="text-white" id="infoUserPhone"></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                    <div class="text-white" id="infoUserStatus"></div>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button onclick="closeUserInfoModal()"
                    class="px-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white hover:bg-white/10 transition-colors duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .chat-item.active {
            background: rgba(59, 130, 246, 0.1);
            border-left: 3px solid #3b82f6;
        }

        .chat-item.active .chat-username {
            color: #60a5fa;
        }

        /* Message bubbles */
        .message-bubble {
            position: relative;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            max-width: 80%;
            margin-bottom: 0.5rem;
        }

        .message-bubble::before {
            content: '';
            position: absolute;
            bottom: 0;
            width: 12px;
            height: 12px;
        }

        .message-bubble.user::before {
            left: -6px;
            border-bottom-right-radius: 16px;
            background: linear-gradient(to bottom right, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0.2) 50%, transparent 50%, transparent);
        }

        .message-bubble.ai::before {
            right: -6px;
            border-bottom-left-radius: 16px;
            background: linear-gradient(to bottom left, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.05) 50%, transparent 50%, transparent);
        }

        /* Date separator */
        .date-separator {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }

        .date-separator::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        .date-separator span {
            position: relative;
            background: rgba(31, 41, 55, 0.8);
            padding: 0.25rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            color: rgba(156, 163, 175, 1);
        }
    </style>

    <script>
        // Chat messages from database
        const chatMessages = @json($messages);

        // Store user details
        const userDetails = @json($conversations);

        // Initialize Pusher
        const pusher = new Pusher('57d1bf302023911c127a', {
            cluster: 'ap2',
            encrypted: true
        });
        // Initialize active visitor ID variable
        let takeControlVisitorId = '';
        const userLiveMessages = {};
        let activeVisitorId = '';

        // Store live messages as objects for sorting
        let liveMessagesArray = [];

        // Store active channel
        let activeChannel = null;

        // Helper to render live messages in order
        function renderLiveMessages() {
            const chatMessagesContainer = document.getElementById('chatMessages');
            let liveMessagesContainer = chatMessagesContainer.querySelector('.live-messages');
            if (!liveMessagesContainer) return;
            // Clear only the message divs (keep headers)
            liveMessagesContainer.innerHTML = `
                <div class="text-xs text-gray-400 mb-2 px-2">
                    <i class="fas fa-bolt mr-1"></i>Live Messages
                </div>
            `;
            // Sort by timestamp
            liveMessagesArray.sort((a, b) => new Date(a.timestamp) - new Date(b.timestamp));
            // Render each message
            liveMessagesArray.forEach(msgObj => {
                liveMessagesContainer.appendChild(msgObj.div);
            });
        }

        // Modify the showChat function to handle live messages
        function showChat(userName, visitorId, userEmail, status, userAvatar) {
            // Unsubscribe from previous channel if exists
            if (activeChannel) {
                activeChannel.unbind('chatbot-message');
                pusher.unsubscribe(activeChannel.name);
                console.log('Unsubscribed from previous channel:', activeChannel.name);
            }

            // Subscribe to new channel
            const channel = pusher.subscribe('chatbot.' + visitorId);
            activeChannel = channel;
            console.log('Subscribed to new channel:', channel.name);

            channel.bind('chatbot-message', function(data) {
                console.log('=== New Message Event ===');
                console.log('Full message data:', data);
                console.log('Message content:', data.message);
                console.log('Sender:', data.sender);
                console.log('Visitor ID:', data.visitor_id);
                console.log('Active Visitor ID:', activeVisitorId);
                console.log('IDs match?', data.visitor_id === activeVisitorId);

                // Only show messages if the visitor ID matches the active visitor ID
                if (data.visitor_id === activeVisitorId) {
                    console.log('=== Displaying Message ===');
                    const chatMessagesContainer = document.getElementById('chatMessages');
                    if (!chatMessagesContainer) {
                        console.error('Chat messages container not found');
                        return;
                    }

                    // Get or create live messages container
                    let liveMessagesContainer = chatMessagesContainer.querySelector('.live-messages');
                    if (!liveMessagesContainer) {
                        console.log('Creating new live messages container');
                        liveMessagesContainer = document.createElement('div');
                        liveMessagesContainer.className = 'live-messages mt-4 border-t border-gray-700 pt-4';

                        // Add today's date separator
                        const now = new Date();
                        const istNow = new Date(now.toLocaleString('en-US', {
                            timeZone: 'Asia/Kolkata'
                        }));
                        const dateSeparator = document.createElement('div');
                        dateSeparator.className = 'flex justify-center my-4';
                        dateSeparator.innerHTML = `
                            <span class="px-4 py-1 text-xs font-medium text-gray-400 bg-gray-800/50 rounded-full">
                                Today
                            </span>
                        `;
                        liveMessagesContainer.appendChild(dateSeparator);

                        liveMessagesContainer.innerHTML += `
                            <div class="text-xs text-gray-400 mb-2 px-2">
                                <i class="fas fa-bolt mr-1"></i>Live Messages
                            </div>
                        `;
                        chatMessagesContainer.appendChild(liveMessagesContainer);
                    }

                    // Create message element
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex items-start gap-3 mb-4';

                    const activeChat = document.querySelector('.chat-item.active');
                    const userAvatar = activeChat?.querySelector('.rounded-full')?.textContent.trim() || 'U';

                    // Convert timestamp to IST
                    const messageTime = new Date(data.timestamp || new Date());
                    const istTime = new Date(messageTime.toLocaleString('en-US', {
                        timeZone: 'Asia/Kolkata'
                    }));
                    const formattedTime = istTime.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true,
                        timeZone: 'Asia/Kolkata'
                    });

                    const messageContent = `
                        ${data.sender === 'user' ? `
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-sm">
                                        ${userAvatar}
                                    </div>
                                    <div class="flex-1">
                                        <div class="bg-blue-500/20 rounded-lg p-3">
                                            <p class="text-sm text-blue-400">${data.message}</p>
                                        </div>
                                        <span class="text-xs text-gray-400 mt-1">${formattedTime}</span>
                                    </div>
                                ` : `
                                    <div class="flex-1 text-right">
                                        <div class="bg-white/5 rounded-lg p-3 inline-block">
                                            <p class="text-sm text-gray-300">${data.message}</p>
                                        </div>
                                        <span class="text-xs text-gray-400 mt-1 block">${formattedTime}</span>
                                    </div>
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-sm">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                `}
                    `;

                    messageDiv.innerHTML = messageContent;
                    liveMessagesContainer.appendChild(messageDiv);

                    // Store the updated live messages
                    userLiveMessages[data.visitor_id] = liveMessagesContainer.innerHTML;

                    // Scroll to bottom
                    chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;

                    // Update the last message in the chat list
                    const chatItem = document.querySelector(`.chat-item[data-visitor-id="${data.visitor_id}"]`);
                    if (chatItem) {
                        const lastMessageElement = chatItem.querySelector('.text-gray-300');
                        if (lastMessageElement) {
                            lastMessageElement.textContent = data.message;
                        }
                    }

                    // Store message with timestamp
                    liveMessagesArray.push({
                        timestamp: data.timestamp || new Date().toISOString(),
                        div: messageDiv
                    });
                    renderLiveMessages();
                }
            });

            // Rest of your existing showChat function code...
            console.log('=== Showing Chat ===');
            console.log('User name:', userName);
            console.log('Visitor ID:', visitorId);
            console.log('Previous active visitor ID:', activeVisitorId);
            document.getElementById('chatUserName').textContent = userName;
            document.getElementById('chatUserEmail').textContent = userEmail;
            document.getElementById('chatStatus').textContent = status;
            document.getElementById('chatAvatar').textContent = userAvatar;
            document.getElementById('chatMessages').innerHTML = '';

            // Update Take Control button based on control status
            const controlButton = document.querySelector('button[onclick="takeChatControl()"]');
            if (takeControlVisitorId === visitorId) {
                // If this chat is under control, show Remove Control button
                controlButton.innerHTML = '<i class="fas fa-user-shield mr-2"></i>Remove Control';
                controlButton.classList.remove('from-green-500', 'to-emerald-500', 'hover:shadow-green-500/50');
                controlButton.classList.add('from-red-500', 'to-pink-500', 'hover:shadow-red-500/50');

                // Enable input field and send button
                const messageInput = document.getElementById('messageInput');
                const sendButton = document.querySelector('button[onclick="sendMessage()"]');
                if (messageInput && sendButton) {
                    messageInput.disabled = false;
                    messageInput.placeholder = "You are now in control. Type your message...";
                    sendButton.disabled = false;
                    sendButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    sendButton.classList.add('hover:shadow-lg', 'hover:shadow-blue-500/50', 'hover:-translate-y-0.5');
                }

                // Add permanent control notification
                const chatMessagesContainer = document.getElementById('chatMessages');
                const controlNotification = document.createElement('div');
                controlNotification.className = 'flex items-center justify-center my-4';
                controlNotification.innerHTML = `
                    <div class="bg-yellow-500/20 rounded-lg px-4 py-2">
                        <p class="text-sm text-yellow-400">
                            <i class="fas fa-user-shield mr-2"></i>
                            You have taken control of this conversation
                        </p>
                    </div>
                `;
                chatMessagesContainer.appendChild(controlNotification);
            } else {
                // If this chat is not under control, show Take Control button
                controlButton.innerHTML = '<i class="fas fa-user-shield mr-2"></i>Take Control';
                controlButton.classList.remove('from-red-500', 'to-pink-500', 'hover:shadow-red-500/50');
                controlButton.classList.add('from-green-500', 'to-emerald-500', 'hover:shadow-green-500/50');

                // Disable input field and send button
                const messageInput = document.getElementById('messageInput');
                const sendButton = document.querySelector('button[onclick="sendMessage()"]');
                if (messageInput && sendButton) {
                    messageInput.disabled = true;
                    messageInput.placeholder = "Take control to send messages...";
                    sendButton.disabled = true;
                    sendButton.classList.add('opacity-50', 'cursor-not-allowed');
                    sendButton.classList.remove('hover:shadow-lg', 'hover:shadow-blue-500/50', 'hover:-translate-y-0.5');
                }
            }

            // Store current live messages before switching
            if (activeVisitorId) {
                const currentLiveContainer = document.querySelector('.live-messages');
                if (currentLiveContainer) {
                    userLiveMessages[activeVisitorId] = currentLiveContainer.innerHTML;
                    console.log('Stored live messages for:', activeVisitorId);
                }
            }

            // Update the active visitor ID
            activeVisitorId = visitorId;
            console.log('New active visitor ID:', activeVisitorId);

            if (!userName || !visitorId) {
                console.error('Missing required parameters:', {
                    userName,
                    visitorId
                });
                return;
            }

            // Get chat container
            const chatMessagesContainer = document.getElementById('chatMessages');
            if (!chatMessagesContainer) {
                console.error('Chat messages container not found');
                return;
            }

            // Show loading state
            chatMessagesContainer.innerHTML = `
                <div class="flex items-center justify-center h-full">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                </div>
            `;

            // Fetch messages from the server using the existing route
            fetch(`/user-chats/${visitorId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Received messages:', data);

                    // Clear the container
                    chatMessagesContainer.innerHTML = '';

                    // Create containers for historical and live messages
                    const historicalMessagesContainer = document.createElement('div');
                    historicalMessagesContainer.className = 'historical-messages';

                    const liveMessagesContainer = document.createElement('div');
                    liveMessagesContainer.className = 'live-messages mt-4 border-t border-gray-700 pt-4';

                    // Restore live messages if they exist
                    if (userLiveMessages[visitorId]) {
                        console.log('Restoring live messages for:', visitorId);
                        liveMessagesContainer.innerHTML = userLiveMessages[visitorId];
                    } else {
                        liveMessagesContainer.innerHTML = `
                            <div class="text-xs text-gray-400 mb-2 px-2">
                                <i class="fas fa-bolt mr-1"></i>Live Messages
                            </div>
                        `;
                    }

                    // Add historical messages
                    if (data && data.length > 0) {
                        let currentDate = null;

                        data.forEach(msg => {
                            // Convert UTC time to IST
                            const messageTime = new Date(msg.created_at);
                            const istTime = new Date(messageTime.toLocaleString('en-US', {
                                timeZone: 'Asia/Kolkata'
                            }));

                            // Format date for comparison using IST
                            const messageDate = istTime.toLocaleDateString('en-GB', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                timeZone: 'Asia/Kolkata'
                            });

                            // Add date separator if date changes
                            if (messageDate !== currentDate) {
                                const dateSeparator = document.createElement('div');
                                dateSeparator.className = 'flex justify-center my-4';

                                // Get current date in IST
                                const now = new Date();
                                const istNow = new Date(now.toLocaleString('en-US', {
                                    timeZone: 'Asia/Kolkata'
                                }));
                                console.log('istNow ', istNow);
                                const yesterday = new Date(istNow);
                                console.log('yesterday', yesterday);
                                yesterday.setDate(yesterday.getDate() - 1);

                                let displayDate;
                                if (istTime.toDateString() === istNow.toDateString()) {
                                    displayDate = 'Today';
                                } else if (istTime.toDateString() === yesterday.toDateString()) {
                                    displayDate = 'Yesterday';
                                } else {
                                    displayDate = istTime.toLocaleDateString('en-GB', {
                                        month: 'short',
                                        day: 'numeric',
                                        year: 'numeric',
                                        timeZone: 'Asia/Kolkata'
                                    });
                                }

                                dateSeparator.innerHTML = `
                                    <span class="px-4 py-1 text-xs font-medium text-gray-400 bg-gray-800/50 rounded-full">
                                        ${displayDate}
                                    </span>
                                `;
                                historicalMessagesContainer.appendChild(dateSeparator);
                                currentDate = messageDate;
                            }

                            const messageDiv = document.createElement('div');
                            messageDiv.className =
                                `flex items-start space-x-3 ${msg.sender === 'user' ? 'justify-end mr-96' : 'ml-96'}`;

                            // Always show 12-hour format with AM/PM
                            const formattedTime = istTime.toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true,
                                timeZone: 'Asia/Kolkata'
                            });

                            const messageContent = `
                                ${msg.sender === 'user' ? `
                                                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-sm">
                                                                    ${userName.charAt(0).toUpperCase()}
                                                                </div>
                                                                <div class="flex-1">
                                                                    <div class="bg-blue-500/20 rounded-lg p-3">
                                                                        <p class="text-sm text-blue-400">${msg.message}</p>
                                                                    </div>
                                                                    <span class="text-xs text-gray-400 mt-1">${formattedTime}</span>
                                                                </div>
                                                            ` : `
                                                                <div class="flex-1 text-right">
                                                                    <div class="bg-white/5 rounded-lg p-3 inline-block">
                                                                        <p class="text-sm text-gray-300">${msg.message}</p>
                                                                    </div>
                                                                    <span class="text-xs text-gray-400 mt-1 block">${formattedTime}</span>
                                                                </div>
                                                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-sm">
                                                                    <i class="fas fa-robot"></i>
                                                                </div>
                                                            `}
                            `;

                            messageDiv.innerHTML = messageContent;
                            historicalMessagesContainer.appendChild(messageDiv);
                        });
                    }

                    // Add containers to main chat container
                    chatMessagesContainer.appendChild(historicalMessagesContainer);
                    chatMessagesContainer.appendChild(liveMessagesContainer);

                    // Add control notification if this chat is under control
                    if (takeControlVisitorId === visitorId) {
                        const controlNotification = document.createElement('div');
                        controlNotification.className = 'flex items-center justify-center my-4';
                        controlNotification.innerHTML = `
                            <div class="bg-yellow-500/20 rounded-lg px-4 py-2">
                                <p class="text-sm text-yellow-400">
                                    <i class="fas fa-user-shield mr-2"></i>
                                    You have taken control of this conversation
                                </p>
                            </div>
                        `;
                        chatMessagesContainer.insertBefore(controlNotification, liveMessagesContainer);
                    }

                    // Store current user
                    chatMessagesContainer.setAttribute('data-current-user', userName);
                    chatMessagesContainer.setAttribute('data-visitor-id', visitorId);

                    // Scroll to bottom of chat
                    chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;

                    // Add message input field if it doesn't exist
                    if (!document.getElementById('messageInput')) {
                        const inputContainer = document.createElement('div');
                        inputContainer.className = 'mt-4 p-4 border-t border-gray-700';
                        inputContainer.innerHTML = `
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 relative">
                                    <input type="text" 
                                           id="messageInput" 
                                           placeholder="Type your message..." 
                                           class="w-full bg-white/5 border border-gray-600 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                           disabled>
                                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
                                        <i class="fas fa-paperclip"></i>
                                    </button>
                                </div>
                                <button onclick="sendMessage()" 
                                        class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg hover:shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-0.5"
                                        disabled>
                                    <i class="fas fa-paper-plane mr-2"></i>Send
                                </button>
                            </div>
                        `;
                        chatMessagesContainer.parentNode.appendChild(inputContainer);
                    }
                })
                .catch(error => {
                    console.error('Error fetching messages:', error);
                    chatMessagesContainer.innerHTML = `
                        <div class="flex items-center justify-center h-full text-red-500">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            Error loading messages
                        </div>
                    `;
                });
        }

        // Add connection status logging
        pusher.connection.bind('state_change', function(states) {
            console.log('Pusher connection state changed:', states);
        });

        pusher.connection.bind('connected', function() {
            console.log('Pusher connected successfully');
        });

        pusher.connection.bind('error', function(err) {
            console.error('Pusher connection error:', err);
        });

        // Debug Pusher connection
        pusher.connection.bind('state_change', states => {
            console.log('=== Pusher State Change ===');
            console.log('Previous state:', states.previous);
            console.log('Current state:', states.current);
        });

        pusher.connection.bind('connected', () => {
            console.log('=== Pusher Connected ===');
            console.log('Connection state:', pusher.connection.state);
            console.log('Connection options:', {
                key: pusher.key,
                cluster: pusher.config.cluster,
                encrypted: pusher.config.encrypted
            });
        });

        pusher.connection.bind('error', (err) => {
            console.error('=== Pusher Connection Error ===');
            console.error('Error details:', err);
        });

        // Debug channel subscription

        // Test Pusher connection
        function testPusherConnection() {
            console.log('=== Testing Pusher Connection ===');
            console.log('Connection state:', pusher.connection.state);

            console.log('Pusher instance:', pusher);
        }

        // Run test on page load
        testPusherConnection();

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
            const istNow = new Date(now.toLocaleString('en-US', {
                timeZone: 'Asia/Kolkata'
            }));

            // Set time to start of day in IST
            const todayStart = new Date(istNow.getTime() - (24 * 60 * 60 * 1000)); // Last 24 hours
            const weekStart = new Date(istNow.getTime() - (7 * 24 * 60 * 60 * 1000)); // Last 7 days
            const monthStart = new Date(istNow.getTime() - (30 * 24 * 60 * 60 * 1000)); // Last 30 days

            let visibleChats = 0;

            chatItems.forEach(item => {
                const userName = item.querySelector('.chat-username').textContent.toLowerCase();
                const userEmail = item.querySelector('.chat-email').textContent.toLowerCase();
                const lastMessage = item.querySelector('.chat-last-message').textContent.toLowerCase();
                // Robust status detection
                const statusTextSpan = item.querySelector('.status-text');
                let status = 'inactive';
                if (statusTextSpan) {
                    const statusText = statusTextSpan.textContent.trim().toLowerCase();
                    if (statusText === 'active') status = 'active';
                }

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
                    const timeText = item.querySelector('.chat-time').textContent;
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

            // Only update the user list, do not hide or change chat details or chatMessages
            // Remove or comment out the following block:
            /*
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
                                            const userName = firstVisibleChat.querySelector('.chat-username').textContent;
                                            const userEmail = firstVisibleChat.querySelector('.chat-email').textContent;
                                            const userAvatar = firstVisibleChat.querySelector('.chat-avatar').textContent.trim();
                                            const userStatus = firstVisibleChat.querySelector('.chat-status-text')?.textContent.includes('Active') ?
                                                'active' : 'inactive';
                                            showChat(userName, userEmail, userAvatar, userStatus);
                                        }
                                    }
                                }
                                */
        }

        // Add event listeners for filters
        document.getElementById('searchInput').addEventListener('input', filterConversations);
        document.getElementById('statusFilter').addEventListener('change', filterConversations);
        document.getElementById('timeFilter').addEventListener('change', filterConversations);

        // Add event listener for filter button
        document.getElementById('filterButton').addEventListener('click', filterConversations);

        // Add send message function
        function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const sendButton = document.querySelector('button[onclick="sendMessage()"]');
            const message = messageInput.value.trim();

            if (message && activeVisitorId) {
                // Disable input and button while sending
                messageInput.disabled = true;
                sendButton.disabled = true;
                sendButton.classList.add('opacity-50', 'cursor-not-allowed');
                sendButton.classList.remove('hover:shadow-lg', 'hover:shadow-blue-500/50', 'hover:-translate-y-0.5');

                const userName = document.getElementById('chatUserName').textContent;
                const userAvatar = document.getElementById('chatAvatar').textContent;
                const chatMessagesContainer = document.getElementById('chatMessages');
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                console.log('message', message, activeVisitorId, userName);
                // Send message to server
                fetch('/user-chats/admin-message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token || ''
                        },
                        body: JSON.stringify({
                            message: message,
                            visitor_id: activeVisitorId,
                            admin_name: userName
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            console.log('message sent successfully');
                            // Create and append new message
                            const messageDiv = document.createElement('div');
                            messageDiv.className = 'flex items-start gap-3 mb-4';
                            messageDiv.innerHTML = `
                                <div class="flex-1 text-right">
                                    <div class="bg-white/5 rounded-lg p-3 inline-block">
                                        <p class="text-sm text-gray-300">${message}</p>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-1 block">Just now</span>
                                </div>
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-sm">
                                    ${userAvatar}
                                </div>
                            `;

                            // Get or create live-messages container
                            let liveMessagesContainer = chatMessagesContainer.querySelector('.live-messages');
                            if (!liveMessagesContainer) {
                                liveMessagesContainer = document.createElement('div');
                                liveMessagesContainer.className = 'live-messages mt-4 border-t border-gray-700 pt-4';

                                // Add today's date separator
                                const now = new Date();
                                const istNow = new Date(now.toLocaleString('en-US', {
                                    timeZone: 'Asia/Kolkata'
                                }));
                                const dateSeparator = document.createElement('div');
                                dateSeparator.className = 'flex justify-center my-4';
                                dateSeparator.innerHTML = `
                                    <span class="px-4 py-1 text-xs font-medium text-gray-400 bg-gray-800/50 rounded-full">
                                        Today
                                    </span>
                                `;
                                liveMessagesContainer.appendChild(dateSeparator);

                                // Add live messages header
                                const liveHeader = document.createElement('div');
                                liveHeader.className = 'text-xs text-gray-400 mb-2 px-2';
                                liveHeader.innerHTML = `<i class="fas fa-bolt mr-1"></i>Live Messages`;
                                liveMessagesContainer.appendChild(liveHeader);

                                chatMessagesContainer.appendChild(liveMessagesContainer);
                            }

                            // Store message with timestamp for sorting
                            liveMessagesArray.push({
                                timestamp: new Date().toISOString(),
                                div: messageDiv
                            });

                            // Re-render all live messages in order
                            renderLiveMessages();

                            messageInput.value = '';
                            chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
                        } else {
                            throw new Error(data.message || 'Failed to send message');
                        }
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                        // Show error notification
                        const notification = document.createElement('div');
                        notification.className =
                            'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-y-0 opacity-100';
                        notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>Failed to send message: ${error.message}</span>
                        </div>
                    `;
                        document.body.appendChild(notification);
                        setTimeout(() => {
                            notification.style.transform = 'translateY(100%)';
                            notification.style.opacity = '0';
                            setTimeout(() => notification.remove(), 300);
                        }, 3000);
                    })
                    .finally(() => {
                        // Re-enable input and button after sending
                        messageInput.disabled = false;
                        sendButton.disabled = false;
                        sendButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        sendButton.classList.add('hover:shadow-lg', 'hover:shadow-blue-500/50',
                            'hover:-translate-y-0.5');
                        messageInput.focus();
                    });
            }
        }

        // Add enter key support for sending messages
        document.addEventListener('DOMContentLoaded', function() {
            const messageInput = document.getElementById('messageInput');
            if (messageInput) {
                messageInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendMessage();
                    }
                });
            }
        });

        // Add click event listener for send button
        document.addEventListener('DOMContentLoaded', function() {
            const sendButton = document.querySelector('button[onclick="sendMessage()"]');
            if (sendButton) {
                sendButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    sendMessage();
                });
            }
        });

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

        // Add take control function
        function takeChatControl() {
            if (!activeVisitorId) {
                console.error('No active visitor selected');
                return;
            }

            const controlButton = document.querySelector('button[onclick="takeChatControl()"]');
            const isCurrentlyControlling = controlButton.textContent.includes('Remove');
            const messageInput = document.getElementById('messageInput');
            const sendButton = document.querySelector('button[onclick="sendMessage()"]');
            const userName = document.getElementById('chatUserName').textContent;
            const chatMessagesContainer = document.getElementById('chatMessages');
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // If trying to take control of a new chat while already controlling another
            if (!isCurrentlyControlling && takeControlVisitorId && takeControlVisitorId !== activeVisitorId) {
                // First release control of the previous chat
                fetch(`/user-chats/take-control`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token || ''
                        },
                        body: JSON.stringify({
                            admin_control: false,
                            visitor_id: takeControlVisitorId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Released control of previous chat:', data);
                        // Now proceed with taking control of the new chat
                        takeControlVisitorId = '';
                        // Continue with taking control of new chat
                        proceedWithTakeControl();
                    })
                    .catch(error => {
                        console.error('Error releasing previous control:', error);
                        showNotification('Failed to release previous control: ' + error.message, 'error');
                    });
            } else {
                // If not controlling any chat or releasing current control, proceed normally
                proceedWithTakeControl();
            }

            function proceedWithTakeControl() {
                // Disable button and show loading state
                controlButton.disabled = true;
                controlButton.classList.add('opacity-50', 'cursor-not-allowed');
                const originalButtonContent = controlButton.innerHTML;
                controlButton.innerHTML = `
                    <div class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        ${isCurrentlyControlling ? 'Releasing Control...' : 'Taking Control...'}
                    </div>
                `;

                // Add a temporary background effect
                const buttonBackground = document.createElement('div');
                buttonBackground.className =
                    'absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 opacity-0 transition-opacity duration-300';
                controlButton.style.position = 'relative';
                controlButton.appendChild(buttonBackground);

                // Animate the background
                setTimeout(() => {
                    buttonBackground.classList.add('opacity-20');
                }, 100);

                fetch(`/user-chats/take-control`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token || ''
                        },
                        body: JSON.stringify({
                            admin_control: !isCurrentlyControlling,
                            visitor_id: activeVisitorId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('control status:', data);
                        takeControlVisitorId = isCurrentlyControlling ? '' : activeVisitorId;
                        console.log('takeControlVisitorId', takeControlVisitorId);

                        // Remove loading state and background effect
                        buttonBackground.remove();
                        controlButton.disabled = false;
                        controlButton.classList.remove('opacity-50', 'cursor-not-allowed');

                        // Toggle button text and state
                        if (!isCurrentlyControlling) {
                            // Taking control
                            controlButton.innerHTML = '<i class="fas fa-user-shield mr-2"></i>Remove Control';
                            controlButton.classList.remove('from-green-500', 'to-emerald-500',
                                'hover:shadow-green-500/50');
                            controlButton.classList.add('from-red-500', 'to-pink-500', 'hover:shadow-red-500/50');

                            // Enable input field and send button
                            if (messageInput && sendButton) {
                                messageInput.disabled = false;
                                messageInput.placeholder = "You are now in control. Type your message...";
                                sendButton.disabled = false;
                                sendButton.classList.remove('opacity-50', 'cursor-not-allowed');
                                sendButton.classList.add('hover:shadow-lg', 'hover:shadow-blue-500/50',
                                    'hover:-translate-y-0.5');
                            }

                            // Add system message with animation
                            const systemMessageDiv = document.createElement('div');
                            systemMessageDiv.className =
                                'flex items-center justify-center my-4 transform transition-all duration-300 opacity-0 translate-y-4';
                            systemMessageDiv.innerHTML = `
                            <div class="bg-yellow-500/20 rounded-lg px-4 py-2">
                                <p class="text-sm text-yellow-400">
                                    <i class="fas fa-user-shield mr-2"></i>
                                    You have taken control of this conversation
                                </p>
                            </div>
                        `;
                            chatMessagesContainer.appendChild(systemMessageDiv);

                            // Trigger animation
                            setTimeout(() => {
                                systemMessageDiv.classList.remove('opacity-0', 'translate-y-4');
                            }, 50);

                            // Show notification
                            showNotification('You are now in control of the chat with ' + userName, 'success');
                        } else {
                            // Removing control
                            controlButton.innerHTML = '<i class="fas fa-user-shield mr-2"></i>Take Control';
                            controlButton.classList.remove('from-red-500', 'to-pink-500', 'hover:shadow-red-500/50');
                            controlButton.classList.add('from-green-500', 'to-emerald-500',
                                'hover:shadow-green-500/50');

                            // Disable input field and send button
                            if (messageInput && sendButton) {
                                messageInput.disabled = true;
                                messageInput.placeholder = "Take control to send messages...";
                                sendButton.disabled = true;
                                sendButton.classList.add('opacity-50', 'cursor-not-allowed');
                                sendButton.classList.remove('hover:shadow-lg', 'hover:shadow-blue-500/50',
                                    'hover:-translate-y-0.5');
                            }

                            // Add system message with animation
                            const systemMessageDiv = document.createElement('div');
                            systemMessageDiv.className =
                                'flex items-center justify-center my-4 transform transition-all duration-300 opacity-0 translate-y-4';
                            systemMessageDiv.innerHTML = `
                            <div class="bg-gray-500/20 rounded-lg px-4 py-2">
                                <p class="text-sm text-gray-400">
                                    <i class="fas fa-robot mr-2"></i>
                                    Control has been released back to AI
                                </p>
                            </div>
                        `;
                            chatMessagesContainer.appendChild(systemMessageDiv);

                            // Trigger animation
                            setTimeout(() => {
                                systemMessageDiv.classList.remove('opacity-0', 'translate-y-4');
                            }, 50);

                            // Show notification
                            showNotification('You have released control of the chat with ' + userName, 'info');
                        }

                        // Scroll to bottom
                        chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Restore button state
                        controlButton.disabled = false;
                        controlButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        controlButton.innerHTML = originalButtonContent;
                        buttonBackground.remove();

                        showNotification('Failed to update control status: ' + error.message, 'error');
                    });
            }
        }

        // Helper function to show notifications
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className =
                'fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-y-0 opacity-100';

            // Set background color based on type
            switch (type) {
                case 'success':
                    notification.classList.add('bg-green-500', 'text-white');
                    break;
                case 'error':
                    notification.classList.add('bg-red-500', 'text-white');
                    break;
                case 'info':
                    notification.classList.add('bg-blue-500', 'text-white');
                    break;
                default:
                    notification.classList.add('bg-gray-500', 'text-white');
            }

            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
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

        function showUserInfo() {
            const userName = document.getElementById('chatUserName').textContent;
            const userEmail = document.getElementById('chatUserEmail').textContent;
            const userStatus = document.getElementById('chatStatus').textContent;
            const userAvatar = document.getElementById('chatAvatar').textContent;

            // Set the information in the modal
            document.getElementById('infoUserEmail').textContent = userEmail;
            document.getElementById('infoUserPhone').textContent =
                'Not provided'; // Since phone is not available in the current data
            document.getElementById('infoUserStatus').textContent = userStatus;
            document.getElementById('infoUserStatus').className =
                `text-${userStatus.toLowerCase() === 'active' ? 'green' : 'gray'}-400`;

            // Show the modal
            document.getElementById('userInfoModal').classList.remove('hidden');
            document.getElementById('userInfoModal').classList.add('flex');
        }

        function closeUserInfoModal() {
            document.getElementById('userInfoModal').classList.add('hidden');
            document.getElementById('userInfoModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('userInfoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUserInfoModal();
            }
        });

        // Hide chat details buttons if no activeVisitorId
        function updateChatDetailsButtonsVisibility() {
            const btns = document.getElementById('chatDetailsButtons');
            if (typeof activeVisitorId === 'undefined' || !activeVisitorId) {
                btns.style.display = 'none';
            } else {
                btns.style.display = '';
            }
        }
        // Call on chat load and after showChat
        document.addEventListener('DOMContentLoaded', updateChatDetailsButtonsVisibility);
        // Patch showChat to call this after updating activeVisitorId
        const originalShowChat = showChat;
        showChat = function(...args) {
            originalShowChat.apply(this, args);
            updateChatDetailsButtonsVisibility();
        };

        // Add this function to refresh conversations
        function refreshConversations() {
            fetch('/admin/user-ai-chats')
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newConversations = doc.querySelector('.overflow-y-auto');

                    if (newConversations) {
                        const currentContainer = document.querySelector('.overflow-y-auto');
                        const activeVisitorId = document.querySelector('.chat-item.active')?.getAttribute(
                            'data-visitor-id');

                        // Update the conversations list
                        currentContainer.innerHTML = newConversations.innerHTML;

                        // Restore active state if there was an active chat
                        if (activeVisitorId) {
                            const activeChat = document.querySelector(
                                `.chat-item[data-visitor-id="${activeVisitorId}"]`);
                            if (activeChat) {
                                activeChat.classList.add('active');
                            }
                        }
                    }
                })
                .catch(error => console.error('Error refreshing conversations:', error));
        }

        // Add function to release control before reload
        function releaseControlAndReload() {
            if (takeControlVisitorId) {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch('/user-chats/take-control', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token || ''
                        },
                        body: JSON.stringify({
                            admin_control: false,
                            visitor_id: takeControlVisitorId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Control released before reload:', data);
                        takeControlVisitorId = '';
                        // Reload the page after control is released
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error releasing control:', error);
                        // Still reload even if there's an error
                        window.location.reload();
                    });
            } else {
                // If no control, just reload
                window.location.reload();
            }
        }

        // Handle page reload/close
        window.onbeforeunload = function(e) {
            if (takeControlVisitorId) {
                e.preventDefault();
                releaseControlAndReload();
                return;
            }
            updateVisitorListTimes();
        };

        // Start the refresh interval when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            // Initial refresh
            refreshConversations();

            // Set up interval to refresh every minute
            setInterval(refreshConversations, 60000);
        });

        // Function to format chat date
        function formatChatDate(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const yesterday = new Date(now);
            yesterday.setDate(yesterday.getDate() - 1);

            // Convert to IST
            const istDate = new Date(date.getTime() + (5.5 * 60 * 60 * 1000));
            const istNow = new Date(now.getTime() + (5.5 * 60 * 60 * 1000));
            const istYesterday = new Date(yesterday.getTime() + (5.5 * 60 * 60 * 1000));

            // Format time
            const timeStr = istDate.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });

            // Check if it's today
            if (istDate.toDateString() === istNow.toDateString()) {
                return timeStr;
            }
            // Check if it's yesterday
            else if (istDate.toDateString() === istYesterday.toDateString()) {
                return `Yesterday`;
            }
            // For older dates
            else {
                const diffTime = Math.abs(istNow - istDate);
                const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
                const diffYears = Math.floor(diffDays / 365);

                if (diffYears > 0) {
                    return `${diffYears} ${diffYears === 1 ? 'year' : 'years'} ago`;
                } else if (diffDays > 0) {
                    return `${diffDays} ${diffDays === 1 ? 'day' : 'days'} ago`;
                } else {
                    return istDate.toLocaleDateString('en-US', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    }) + ' ' + timeStr;
                }
            }
        }

        let isUpdatingTimes = false;

        // Function to update visitor list times
        async function updateVisitorListTimes() {
            if (isUpdatingTimes) return;
            isUpdatingTimes = true;

            try {
                const visitorItems = document.querySelectorAll('.visitor');

                for (const visitorItem of visitorItems) {
                    const visitorId = visitorItem.getAttribute('data-visitor-id');

                    try {
                        const response = await fetch(`/user-chats/last-active-time/${visitorId}`);
                        const data = await response.json();

                        if (data.status === 'success') {
                            const lastActiveTime = new Date(data.updated_at);
                            const chatTime = formatChatDate(lastActiveTime);
                            const timeElement = visitorItem.querySelector('.chat-time');

                            if (timeElement) {
                                // Create a new span element
                                timeElement.innerText = chatTime;
                            }
                        }
                    } catch (error) {
                        console.error('Error fetching last active time for visitor', visitorId, ':', error);
                    }
                }
            } catch (error) {
                console.error('Error updating visitor list times:', error);
            } finally {
                isUpdatingTimes = false;
            }
        }

        // Call updateVisitorListTimes when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Initial update
            updateVisitorListTimes();

            // Set up periodic updates
        });
    </script>

@endsection
