import { generateText } from './gemini.js';
if (!localStorage.getItem('visitor_id')) {
    localStorage.setItem('visitor_id', crypto.randomUUID());
}

localStorage.setItem('admin_control', 'false');

const visitor_id = localStorage.getItem('visitor_id');

var pusher = new Pusher('57d1bf302023911c127a', {
    cluster: 'ap2'
});

var channel = pusher.subscribe('chatbot');
var channel2 = pusher.subscribe('chat.' + visitor_id);

let chatbotController = localStorage.getItem('admin_control') === 'true';
console.log('chatbotController', chatbotController);

channel2.bind('take.control', (data) => {
    console.log('take control', data);
    chatbotController = data.admin_control;
    localStorage.setItem('admin_control', data.admin_control.toString());

    // Update chatbot name and logo when admin takes control
    const container = document.querySelector('.chatbot-container');
    const titleElement = container.querySelector('.chatbot-title');
    const avatar = container.querySelector('.chatbot-avatar');
    const bubbleIcon = avatar.querySelector('.chat-bubble-icon');
    const botImg = avatar.querySelector('.bot-avatar-img');

    if (data.admin_control) {
        // Change title to show admin name if available
        const adminName = data.admin_name || 'Support Team';
        titleElement.innerHTML = `
            <div class="chatbot-avatar">
                <span class="chat-bubble-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.477 2 2 6.477 2 12c0 1.511.38 2.955 1.037 4.207L2 22l5.793-1.037C9.045 21.62 10.489 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" fill="#fff" stroke="#4F46E5" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <img src="https://cdn-icons-gif.flaticon.com/17576/17576964.gif" alt="Support Team" class="bot-avatar-img" style="display:none;" />
            </div>
            <span class="chatbot-status"></span>
            ${adminName}
        `;

        // Add notification message when admin takes control
        const messagesContainer = document.querySelector('.chatbot-messages');
        const messageElement = document.createElement('div');
        messageElement.className = 'chatbot-message bot-message';
        messageElement.innerHTML = `
            <div class="bot-avatar">
                <img src="https://cdn-icons-gif.flaticon.com/17576/17576964.gif" alt="Support Team" />
            </div>
            <div class="message-content">
                <span class="typing-text">You are now connected with our contact team support. How can we assist you?</span>
            </div>
        `;
        messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    } else {
        // Remove existing typing indicator if any
        const existingTypingIndicator = document.querySelector('.typing-indicator');
        if (existingTypingIndicator) {
            existingTypingIndicator.remove();
        }
        // Reset to default Harmony bot
        titleElement.innerHTML = `
            <div class="chatbot-avatar">
                <span class="chat-bubble-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.477 2 2 6.477 2 12c0 1.511.38 2.955 1.037 4.207L2 22l5.793-1.037C9.045 21.62 10.489 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" fill="#fff" stroke="#4F46E5" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <img src="/images/bot-avatar.svg" alt="Harmony Bot" class="bot-avatar-img" style="display:none;" />
            </div>
            <span class="chatbot-status"></span>
            Harmony
        `;

        // Add notification message when control is released back to AI
        const messagesContainer = document.querySelector('.chatbot-messages');
        const messageElement = document.createElement('div');
        messageElement.className = 'chatbot-message bot-message';
        messageElement.innerHTML = `
            <div class="bot-avatar">
                <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
            </div>
            <div class="message-content">
                <span class="typing-text">I'm back! How can I help you continue our conversation? 🤖</span>
            </div>
        `;
        messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});
var adminMessageChannel = pusher.subscribe('admin-chat.' + visitor_id);





class Chatbot {
    constructor() {
        this.isOpen = false;
        this.messages = [];
        this.hasInitialized = false;
        this.isFirstClick = true;
        this.conversationHistory = []; // Array to store conversation history
        this.profanityWords = [
            'fuck', 'shit', 'ass', 'bitch', 'damn',
            'crap', 'piss', 'dick', 'cock', 'pussy', 'bastard',
            'fucking', 'shitty', 'asshole', 'bitchy', 'damned'
        ];
        this.initializeChatbot();

        // Bind to Pusher channel for real-time messages
        channel.bind('chatbot-message', (data) => {
            console.log('user message is broadcasted', data.message);
            console.log(data);
            // Only show AI messages from admin panel
            if (data.sender === 'ai' || data.sender === 'admin') {
                this.addBotMessage(data.message);
            }
        });
        adminMessageChannel.bind('admin.message', (data) => {
            console.log('admin message', data);
            // Remove existing typing indicator if any
            const existingTypingIndicator = document.querySelector('.typing-indicator');
            if (existingTypingIndicator) {
                existingTypingIndicator.remove();
            }

            // Show typing indicator for admin message
            const messagesContainer = document.querySelector('.chatbot-messages');
            const typingIndicator = document.createElement('div');
            typingIndicator.className = 'chatbot-message bot-message typing-indicator';
            typingIndicator.innerHTML = `
                <div class="bot-avatar">
                    <img src="https://cdn-icons-gif.flaticon.com/17576/17576964.gif" alt="Support Team" />
                </div>
                <div class="message-content">
                    <div class="typing-dots">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            `;
            messagesContainer.appendChild(typingIndicator);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

            // Transform typing indicator into response
            typingIndicator.className = 'chatbot-message bot-message';
            const messageContent = typingIndicator.querySelector('.message-content');
            messageContent.innerHTML = `<span class="typing-text"></span>`;
            const typingText = messageContent.querySelector('.typing-text');

            // Type out the message
            let index = 0;
            const typeInterval = setInterval(() => {
                if (index < data.message.length) {
                    typingText.textContent += data.message[index];
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    index++;
                } else {
                    clearInterval(typeInterval);
                    // Store admin message in database
                    this.storeMessage('ai', data.message)
                        .catch(error => {
                            console.error('Error storing admin message:', error);
                            typingIndicator.classList.add('error-message');
                        });
                }
            }, 30);

            // Store message in conversation history
            this.conversationHistory.push({
                role: 'assistant',
                content: data.message,
                timestamp: new Date().toISOString()
            });
        });
    }

    initializeChatbot() {
        // Check if chatbot already exists
        if (document.querySelector('.chatbot-container')) {
            return;
        }

        // Create chatbot container
        this.createChatbotContainer();

        // Add event listeners
        this.addEventListeners();

        // Start minimized
        const container = document.querySelector('.chatbot-container');
        container.classList.add('chatbot-minimized');
    }

    createChatbotContainer() {
        const container = document.createElement('div');
        container.className = 'chatbot-container chatbot-minimized';
        container.innerHTML = `
        
            <div class="chatbot-header">
                <div class="chatbot-title">
                    <div class="chatbot-avatar">
                        <span class="chat-bubble-icon">
                            <svg width="38" height="38" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.477 2 2 6.477 2 12c0 1.511.38 2.955 1.037 4.207L2 22l5.793-1.037C9.045 21.62 10.489 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" fill="#fff" stroke="#4F46E5" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <img src="/images/bot-avatar.svg" alt="Harmony Bot" class="bot-avatar-img" style="display:none;" />
                    </div>
                    <span class="chatbot-status"></span>
                    Harmony
                </div>
                <button class="chatbot-minimize">−</button>
            </div>
            <div class="chatbot-messages"></div>
            <div class="chatbot-input-container">
                <input type="text" class="chatbot-input" placeholder="Type your message...">
                <button class="chatbot-send">Send</button>
            </div>
        `;
        document.body.appendChild(container);
    }

    addEventListeners() {
        const container = document.querySelector('.chatbot-container');
        const minimizeBtn = container.querySelector('.chatbot-minimize');
        const sendBtn = container.querySelector('.chatbot-send');
        const input = container.querySelector('.chatbot-input');
        const header = container.querySelector('.chatbot-header');

        // Toggle chatbot on header click when minimized
        header.addEventListener('click', async (e) => {
            console.log('the chatbot clicked')

            if (e.target === header || e.target === header.querySelector('.chatbot-title')) {
                if (container.classList.contains('chatbot-minimized')) {
                    if (this.isFirstClick) {
                        this.showMessageLogo();
                        this.isFirstClick = false;
                    } else {
                        await this.getTheOldChat();
                        this.toggleChatbot();
                    }
                }
            }
        });

        minimizeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleChatbot();
        });

        sendBtn.addEventListener('click', () => this.handleUserInput());
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.handleUserInput();
        });

        // Prevent event bubbling for input and buttons
        input.addEventListener('click', (e) => e.stopPropagation());
        sendBtn.addEventListener('click', (e) => e.stopPropagation());
    }

    async getTheOldChat() {
        try {
            const response = await fetch(`/user-chats/${visitor_id}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Failed to fetch chat history');
            }

            const chatHistory = await response.json();
            const messagesContainer = document.querySelector('.chatbot-messages');
            messagesContainer.innerHTML = '';

            // Clear conversation history
            this.conversationHistory = [];

            if (chatHistory && chatHistory.length > 0) {
                // Add "Previous Messages" tag
                const tagElement = document.createElement('div');
                tagElement.className = 'chatbot-message-tag';
                tagElement.innerHTML = 'Previous Messages';
                messagesContainer.appendChild(tagElement);

                // Add each message to the UI and conversation history
                chatHistory.forEach(chat => {
                    const messageElement = document.createElement('div');
                    messageElement.className = `chatbot-message ${chat.sender}-message`;

                    if (chat.sender === 'ai') {
                        messageElement.innerHTML = `
                            <div class="bot-avatar">
                                <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
                            </div>
                            <div class="message-content">
                                <span class="typing-text">${chat.message}</span>
                            </div>
                        `;
                    } else {
                        messageElement.innerHTML = chat.message;
                    }

                    messagesContainer.appendChild(messageElement);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;

                    // Add to conversation history
                    this.conversationHistory.push({
                        role: chat.sender === 'user' ? 'user' : 'assistant',
                        content: chat.message,
                        timestamp: new Date().toISOString()
                    });
                });

                // Add "New Messages" tag
                const newTagElement = document.createElement('div');
                newTagElement.className = 'chatbot-message-tag';
                newTagElement.innerHTML = 'New Messages';
                messagesContainer.appendChild(newTagElement);

                // Show continuation message
                setTimeout(() => {
                    const messageElement = document.createElement('div');
                    messageElement.className = 'chatbot-message bot-message';
                    messageElement.innerHTML = `
                        <div class="bot-avatar">
                            <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
                        </div>
                        <div class="message-content">
                            <span class="typing-text">I remember our previous conversation. How can I help you continue?</span>
                        </div>
                    `;
                    messagesContainer.appendChild(messageElement);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }, 500);
            } else {
                // Show terms notice for new users
                this.showTermsNotice();

                // Show welcome message after terms notice with a delay
                setTimeout(() => {
                    const messageElement = document.createElement('div');
                    messageElement.className = 'chatbot-message bot-message';
                    messageElement.innerHTML = `
                        <div class="bot-avatar">
                            <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
                        </div>
                        <div class="message-content">
                            <span class="typing-text">Hello! 👋 I'm Harmony, your WebNodez assistant. How can I help you today?</span>
                        </div>
                    `;
                    messagesContainer.appendChild(messageElement);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    this.hasInitialized = true;
                }, 1000);
            }
        } catch (error) {
            console.error('Error fetching chat history:', error);
            // Show terms notice and welcome message even if there's an error
            this.showTermsNotice();

            // Show welcome message after terms notice with a delay
            setTimeout(() => {
                const messageElement = document.createElement('div');
                messageElement.className = 'chatbot-message bot-message';
                messageElement.innerHTML = `
                    <div class="bot-avatar">
                        <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
                    </div>
                    <div class="message-content">
                        <span class="typing-text">Hello! 👋 I'm Harmony, your WebNodez assistant. How can I help you today?</span>
                    </div>
                `;
                messagesContainer.appendChild(messageElement);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                this.hasInitialized = true;
            }, 1000);
        }
    }

    toggleChatbot() {
        const container = document.querySelector('.chatbot-container');
        this.isOpen = !this.isOpen;
        const avatar = container.querySelector('.chatbot-avatar');
        const bubbleIcon = avatar.querySelector('.chat-bubble-icon');
        const botImg = avatar.querySelector('.bot-avatar-img');
        if (!this.isOpen) {
            container.classList.add('chatbot-minimized');
            if (bubbleIcon) bubbleIcon.style.display = '';
            if (botImg) botImg.style.display = 'none';
        } else {
            container.classList.remove('chatbot-minimized');
            if (bubbleIcon) bubbleIcon.style.display = 'none';
            if (botImg) botImg.style.display = '';
            // Focus input when opening
            const input = container.querySelector('.chatbot-input');
            setTimeout(() => input.focus(), 300);
            // Auto scroll to bottom when opening chatbox
            setTimeout(() => {
                const messagesContainer = document.querySelector('.chatbot-messages');
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }, 100);
        }
    }

    showMessageLogo() {
        const container = document.querySelector('.chatbot-container');
        const avatar = container.querySelector('.chatbot-avatar');

        // Add animation class
        avatar.classList.add('message-logo-animation');

        // After animation completes, expand the chatbot
        setTimeout(() => {
            avatar.classList.remove('message-logo-animation');
            this.toggleChatbot();
        }, 1000);
    }

    async storeMessage(sender, message) {
        const messageData = {
            visitor_id: visitor_id,
            sender: sender,
            message: message
        };

        try {
            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!token) {
                throw new Error('CSRF token not found');
            }

            const response = await fetch('/user-chats', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(messageData)
            });

            if (!response.ok) {
                throw new Error(`Server error: ${response.status} ${response.statusText}`);
            }

            return await response.json();
        } catch (error) {
            console.error('Error storing message:', error);
            throw error; // Re-throw the error to be caught by the caller
        }
    }

    addUserMessage(message) {
        const messagesContainer = document.querySelector('.chatbot-messages');
        // const messageElement = document.createElement('div');
        // messageElement.className = 'chatbot-message user-message';
        // messageElement.innerHTML = message;
        // messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Store user message in conversation history
        this.conversationHistory.push({
            role: 'user',
            content: message,
            timestamp: new Date().toISOString()
        });

        // Store message in database
        return this.storeMessage('user', message)
            .then(() => {
                // Only process response if message was stored successfully
                this.processUserMessage(message, 'user');
            })
            .catch(error => {
                console.error('Error storing message:', error);
                // Find the last user message and add error state
                const userMessages = messagesContainer.querySelectorAll('.user-message');
                const lastUserMessage = userMessages[userMessages.length - 1];
                if (lastUserMessage) {
                    lastUserMessage.classList.add('error-message');
                    // Add error message after the failed message
                    const errorElement = document.createElement('div');
                    errorElement.className = 'chatbot-message bot-message';
                    errorElement.innerHTML = `
                        <div class="bot-avatar">
                            <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
                        </div>
                        <div class="message-content">
                            <span class="typing-text">Sorry, there was an error saving your message. Please try again.</span>
                        </div>
                    `;
                    messagesContainer.appendChild(errorElement);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            });
    }

    addBotMessage(message) {
        const messagesContainer = document.querySelector('.chatbot-messages');
        // c
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Store bot message in conversation history
        this.conversationHistory.push({
            role: 'assistant',
            content: message,
            timestamp: new Date().toISOString()
        });

        // Store message in database
        this.storeMessage('ai', message);

    }

    handleUserInput() {
        const input = document.querySelector('.chatbot-input');
        const message = input.value.trim();

        if (message) {
            // Add user message instantly with sending animation
            const messagesContainer = document.querySelector('.chatbot-messages');
            const messageElement = document.createElement('div');
            messageElement.className = 'chatbot-message user-message sending-animation';
            messageElement.innerHTML = message;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

            // Clear input immediately
            input.value = '';

            // First broadcast the message
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!token) {
                console.warn('CSRF token not found');
            }
            fetch(`/user-chats/broadcast`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token || ''
                },
                body: JSON.stringify({
                    message: message,
                    sender: 'user',
                    visitor_id: visitor_id
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('data is broadcasted', data);
                    // Remove sending animation after successful broadcast
                    messageElement.classList.remove('sending-animation');
                    // Add user message after successful broadcast
                    this.addUserMessage(message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Remove sending animation and add error state
                    messageElement.classList.remove('sending-animation');
                    messageElement.classList.add('error-message');
                    // Add error message after the failed message
                    const errorElement = document.createElement('div');
                    errorElement.className = 'chatbot-message bot-message';
                    errorElement.innerHTML = `
                        <div class="bot-avatar">
                            <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
                        </div>
                        <div class="message-content">
                            <span class="typing-text">Sorry, there was an error sending your message. Please try again.</span>
                        </div>
                    `;
                    messagesContainer.appendChild(errorElement);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });
        }
    }

    processUserMessage(message, user) {
        // Show typing indicator
        const messagesContainer = document.querySelector('.chatbot-messages');
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'chatbot-message bot-message typing-indicator';
        typingIndicator.innerHTML = `
            <div class="bot-avatar">
                <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
            </div>
            <div class="message-content">
                <div class="typing-dots">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        `;
        messagesContainer.appendChild(typingIndicator);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        if (chatbotController) {
            if (user != 'ai') {
                return;
            }

            if (message) {
                // Transform typing indicator into response
                typingIndicator.className = 'chatbot-message bot-message';
                const messageContent = typingIndicator.querySelector('.message-content');
                messageContent.innerHTML = `<span class="typing-text"></span>`;
                const typingText = messageContent.querySelector('.typing-text');

                // Type out the message
                let index = 0;
                const typeInterval = setInterval(() => {
                    if (index < message.length) {
                        typingText.textContent += message[index];
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        index++;
                    } else {
                        clearInterval(typeInterval);
                        // Broadcast the AI response after typing is complete
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        if (!token) {
                            console.warn('CSRF token not found');
                        }
                        fetch(`/user-chats/broadcast`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token || ''
                            },
                            body: JSON.stringify({
                                message: message,
                                sender: 'ai',
                                visitor_id: visitor_id
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log('data is broadcasted', data);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                typingIndicator.classList.add('error-message');
                            });
                    }
                }, 30);

                // Store bot message in conversation history
                this.conversationHistory.push({
                    role: 'assistant',
                    content: message,
                    timestamp: new Date().toISOString()
                });
            }
        } else {
            // Process the message and generate response
            this.generateResponse(message).then(response => {
                if (response) {
                    // Transform typing indicator into response
                    typingIndicator.className = 'chatbot-message bot-message';
                    const messageContent = typingIndicator.querySelector('.message-content');
                    messageContent.innerHTML = `<span class="typing-text"></span>`;
                    const typingText = messageContent.querySelector('.typing-text');

                    // Type out the message
                    let index = 0;
                    const typeInterval = setInterval(() => {
                        if (index < response.length) {
                            typingText.textContent += response[index];
                            messagesContainer.scrollTop = messagesContainer.scrollHeight;
                            index++;
                        } else {
                            clearInterval(typeInterval);
                            // Broadcast the AI response after typing is complete
                            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                            if (!token) {
                                console.warn('CSRF token not found');
                            }
                            fetch(`/user-chats/broadcast`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': token || ''
                                },
                                body: JSON.stringify({
                                    message: response,
                                    sender: 'ai',
                                    visitor_id: visitor_id
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('data is broadcasted', data);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    typingIndicator.classList.add('error-message');
                                });
                        }
                    }, 30);

                    // Store bot message in conversation history
                    this.conversationHistory.push({
                        role: 'assistant',
                        content: response,
                        timestamp: new Date().toISOString()
                    });
                }
            }).catch(error => {
                console.error('Error generating response:', error);
                // Transform typing indicator into error message
                typingIndicator.className = 'chatbot-message bot-message';
                const messageContent = typingIndicator.querySelector('.message-content');
                messageContent.innerHTML = `<span class="typing-text">I'm having trouble right now. Please try again or contact support.</span>`;
                typingIndicator.classList.add('error-message');
            });
        }
    }

    async generateResponse(message) {
        const lowerMessage = message.toLowerCase();

        // Check for profanity
        if (this.profanityWords.some(word => lowerMessage.includes(word))) {
            const profanityResponses = [
                "I'd be happy to help you, but could you please rephrase your question without using inappropriate language? Let's keep our conversation professional and respectful.",
                "I'm here to assist you, and I'd appreciate if we could communicate in a professional manner. Could you please rephrase your question?",
                "I'm ready to help you with your inquiry. To ensure a productive conversation, could you please rephrase your question without using inappropriate language?"
            ];
            return profanityResponses[Math.floor(Math.random() * profanityResponses.length)];
        }

        try {
            // Format entire conversation history for the prompt
            const conversationContext = this.conversationHistory
                .map(msg => `${msg.role === 'user' ? 'User' : 'Assistant'}: ${msg.content}`)
                .join('\n');

            const prompt = `
            You are Harmony, a friendly and professional AI assistant for WebNodez, a technology company.
            WebNodez provides web-development, app-development, UI/UX design, and e-commerce solutions.
            WebNodez has 3 years of experience, 100+ clients, and a 98% success rate. WebNodez has blogs and portfolio on website. We have many projects on website.
            After successful communication you can ask for email or number for contact. If user wants to contact, ask for email or number.
            WebNodez is a software development company.

            Complete conversation history:
            ${conversationContext}

            Response Guidelines:
            1. Answer ONLY what the user specifically asks for
            2. Keep responses short and to the point
            3. Don't add extra information unless asked
            4. For greetings (hello, hi, hey):
               - Only say hello once at the start of conversation
               - Don't repeat greetings in follow-up responses
               - Just answer the question directly
            5. For thank you: Just say you're welcome
            6. For questions you can't answer: Simply say you can't help with that
            7. Use natural, friendly language
            8. Add an emoji only when appropriate (greetings, thank you)
            9. Maximum 2-3 sentences per response
            10. If the question is not about WebNodez, politely redirect to WebNodez services
            11. If user shows interest in contact, ask for their email or number
            12. Consider the conversation history for context-aware responses
            13. Don't repeat information already mentioned in the conversation
            14. If asked about your name, just say "I'm Harmony" without adding extra questions
            15. If discussing a project, focus on the project details before asking for contact info

            User's question: ${message}
            `;

            const [response, title] = await generateText(prompt);
            return response;
        } catch (error) {
            console.error('Error generating AI response:', error);
            return "I'm having trouble right now. Please try again or contact support.";
        }
    }

    // Add new method for showing welcome message
    showWelcomeMessage() {
        if (!this.hasInitialized) {
            const messagesContainer = document.querySelector('.chatbot-messages');
            const messageElement = document.createElement('div');
            messageElement.className = 'chatbot-message bot-message';
            messageElement.innerHTML = `
                <div class="bot-avatar">
                    <img src="/images/bot-avatar.svg" alt="Harmony Bot" />
                </div>
                <div class="message-content">
                    <span class="typing-text">Hello! 👋 I'm Harmony, your WebNodez assistant. How can I help you today?</span>
                </div>
            `;
            messagesContainer.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            this.hasInitialized = true;
        }
    }

    // Add this method to the Chatbot class
    showTermsNotice() {
        const messagesContainer = document.querySelector('.chatbot-messages');
        const termsNotice = document.createElement('div');
        termsNotice.className = 'chatbot-terms-notice';
        termsNotice.innerHTML = `
            <div class="terms-content">
                <p class="terms-text">
                    By continuing this chat, you agree that your conversation may be recorded and monitored for quality assurance purposes. 
                    <a href="/terms-conditions#chatbot" class="terms-link" target="_blank">Read our Terms & Conditions</a>
                </p>
            </div>
        `;
        messagesContainer.appendChild(termsNotice);
    }
}

// Initialize chatbot when the page loads
document.addEventListener('DOMContentLoaded', async () => {
    // Prevent multiple instances
    if (!window.chatbotInstance) {
        window.chatbotInstance = new Chatbot();
        // Get old chat when user first visits
        await window.chatbotInstance.getTheOldChat();
    }
});