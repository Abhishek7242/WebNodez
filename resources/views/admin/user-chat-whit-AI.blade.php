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
                            <input type="text" placeholder="Search conversations..."
                                class="w-full pl-10 pr-4 py-2 bg-white/5 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                    <select
                        class="bg-white/5 border border-gray-600 rounded-lg text-white px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                        <option value="" class="bg-gray-800 text-white">All Users</option>
                        <option value="active" class="bg-gray-800 text-white">Active Users</option>
                        <option value="inactive" class="bg-gray-800 text-white">Inactive Users</option>
                    </select>
                    <select
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
                        @php
                            $conversations = [
                                [
                                    'user' => 'John Doe',
                                    'email' => 'john@example.com',
                                    'last_message' => 'How can I integrate AI into my website?',
                                    'time' => '2 mins ago',
                                    'status' => 'active',
                                    'avatar' => 'JD',
                                ],
                                [
                                    'user' => 'Jane Smith',
                                    'email' => 'jane@example.com',
                                    'last_message' => 'What are the best practices for AI implementation?',
                                    'time' => '15 mins ago',
                                    'status' => 'active',
                                    'avatar' => 'JS',
                                ],
                                [
                                    'user' => 'Mike Johnson',
                                    'email' => 'mike@example.com',
                                    'last_message' => 'Can you explain machine learning basics?',
                                    'time' => '1 hour ago',
                                    'status' => 'inactive',
                                    'avatar' => 'MJ',
                                ],
                            ];
                        @endphp

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
                                    JD
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-white" id="chatUserName">John Doe</h2>
                                    <p class="text-sm text-gray-400" id="chatUserEmail">john@example.com</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full" id="chatStatus">
                                    Active
                                </span>
                                <button class="text-gray-400 hover:text-white transition-colors duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 space-y-4 max-h-[500px] overflow-y-auto" id="chatMessages">
                        <!-- Messages will be loaded here -->
                    </div>
                </div>
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
        // Sample chat messages data
        const chatMessages = {
            'John Doe': [{
                    type: 'ai',
                    message: "Hello! I'm your AI assistant. How can I help you today?",
                    time: "2:30 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
                {
                    type: 'user',
                    message: "How can I integrate AI into my website?",
                    time: "2:31 PM"
                },
                {
                    type: 'ai',
                    message: "There are several ways to integrate AI into your website. Here are some common approaches:\n\n1. Chatbots for customer support\n2. Recommendation systems\n3. Content personalization\n4. Image and text analysis",
                    time: "2:32 PM"
                },
            ],
            'Jane Smith': [{
                    type: 'ai',
                    message: "Hello Jane! How can I assist you today?",
                    time: "2:15 PM"
                },
                {
                    type: 'user',
                    message: "What are the best practices for AI implementation?",
                    time: "2:16 PM"
                },
                {
                    type: 'ai',
                    message: "Here are some key best practices for AI implementation:\n\n1. Start with clear objectives\n2. Choose the right AI model\n3. Ensure data quality\n4. Monitor and maintain regularly",
                    time: "2:17 PM"
                }
            ],
            'Mike Johnson': [{
                    type: 'ai',
                    message: "Hi Mike! What would you like to learn about?",
                    time: "1:00 PM"
                },
                {
                    type: 'user',
                    message: "Can you explain machine learning basics?",
                    time: "1:01 PM"
                },
                {
                    type: 'ai',
                    message: "Machine learning basics include:\n\n1. Supervised Learning\n2. Unsupervised Learning\n3. Neural Networks\n4. Deep Learning",
                    time: "1:02 PM"
                }
            ]
        };

        function showChat(userName, userEmail, userAvatar, userStatus) {
            // Update chat header
            document.getElementById('chatAvatar').textContent = userAvatar;
            document.getElementById('chatUserName').textContent = userName;
            document.getElementById('chatUserEmail').textContent = userEmail;

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

        // Show first chat by default
        document.addEventListener('DOMContentLoaded', () => {
            const firstChat = document.querySelector('.chat-item');
            if (firstChat) {
                const userName = firstChat.querySelector('.text-white').textContent;
                const userEmail = firstChat.querySelector('.text-gray-400').textContent;
                const userAvatar = firstChat.querySelector('.rounded-full').textContent.trim();
                const userStatus = firstChat.querySelector('.text-gray-400').textContent.includes('Active') ?
                    'active' : 'inactive';
                showChat(userName, userEmail, userAvatar, userStatus);
            }
        });
    </script>

@endsection
