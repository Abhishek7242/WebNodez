/******/ (() => { // webpackBootstrap
/*!*********************************!*\
  !*** ./resources/js/chatbot.js ***!
  \*********************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var Chatbot = /*#__PURE__*/function () {
  function Chatbot() {
    _classCallCheck(this, Chatbot);
    this.isOpen = false;
    this.messages = [];
    this.hasInitialized = false;
    this.isFirstClick = true;
    this.profanityWords = ['fuck', 'shit', 'ass', 'bitch', 'damn', 'crap', 'piss', 'dick', 'cock', 'pussy', 'bastard', 'fucking', 'shitty', 'asshole', 'bitchy', 'damned'];
    this.initializeChatbot();
  }
  return _createClass(Chatbot, [{
    key: "initializeChatbot",
    value: function initializeChatbot() {
      // Check if chatbot already exists
      if (document.querySelector('.chatbot-container')) {
        return;
      }

      // Create chatbot container
      this.createChatbotContainer();

      // Add event listeners
      this.addEventListeners();

      // Start minimized
      var container = document.querySelector('.chatbot-container');
      container.classList.add('chatbot-minimized');
    }
  }, {
    key: "createChatbotContainer",
    value: function createChatbotContainer() {
      var container = document.createElement('div');
      container.className = 'chatbot-container chatbot-minimized';
      container.innerHTML = "\n        \n            <div class=\"chatbot-header\">\n                <div class=\"chatbot-title\">\n                    <div class=\"chatbot-avatar\">\n                        <span class=\"chat-bubble-icon\">\n                            <svg width=\"38\" height=\"38\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n                                <path d=\"M12 2C6.477 2 2 6.477 2 12c0 1.511.38 2.955 1.037 4.207L2 22l5.793-1.037C9.045 21.62 10.489 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z\" fill=\"#fff\" stroke=\"#4F46E5\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n                            </svg>\n                        </span>\n                        <img src=\"/images/bot-avatar.svg\" alt=\"Harmony Bot\" class=\"bot-avatar-img\" style=\"display:none;\" />\n                    </div>\n                    <span class=\"chatbot-status\"></span>\n                    Harmony\n                </div>\n                <button class=\"chatbot-minimize\">\u2212</button>\n            </div>\n            <div class=\"chatbot-messages\"></div>\n            <div class=\"chatbot-input-container\">\n                <input type=\"text\" class=\"chatbot-input\" placeholder=\"Type your message...\">\n                <button class=\"chatbot-send\">Send</button>\n            </div>\n        ";
      document.body.appendChild(container);
    }
  }, {
    key: "addEventListeners",
    value: function addEventListeners() {
      var _this = this;
      var container = document.querySelector('.chatbot-container');
      var minimizeBtn = container.querySelector('.chatbot-minimize');
      var sendBtn = container.querySelector('.chatbot-send');
      var input = container.querySelector('.chatbot-input');
      var header = container.querySelector('.chatbot-header');

      // Toggle chatbot on header click when minimized
      header.addEventListener('click', function (e) {
        if (e.target === header || e.target === header.querySelector('.chatbot-title')) {
          if (container.classList.contains('chatbot-minimized')) {
            if (_this.isFirstClick) {
              _this.showMessageLogo();
              _this.isFirstClick = false;
            } else {
              _this.toggleChatbot();
            }
          }
        }
      });
      minimizeBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        _this.toggleChatbot();
      });
      sendBtn.addEventListener('click', function () {
        return _this.handleUserInput();
      });
      input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') _this.handleUserInput();
      });

      // Prevent event bubbling for input and buttons
      input.addEventListener('click', function (e) {
        return e.stopPropagation();
      });
      sendBtn.addEventListener('click', function (e) {
        return e.stopPropagation();
      });
    }
  }, {
    key: "toggleChatbot",
    value: function toggleChatbot() {
      var container = document.querySelector('.chatbot-container');
      this.isOpen = !this.isOpen;
      var avatar = container.querySelector('.chatbot-avatar');
      var bubbleIcon = avatar.querySelector('.chat-bubble-icon');
      var botImg = avatar.querySelector('.bot-avatar-img');
      if (!this.isOpen) {
        container.classList.add('chatbot-minimized');
        if (bubbleIcon) bubbleIcon.style.display = '';
        if (botImg) botImg.style.display = 'none';
      } else {
        container.classList.remove('chatbot-minimized');
        if (bubbleIcon) bubbleIcon.style.display = 'none';
        if (botImg) botImg.style.display = '';
        // Focus input when opening
        var input = container.querySelector('.chatbot-input');
        setTimeout(function () {
          return input.focus();
        }, 300);
      }
    }
  }, {
    key: "showMessageLogo",
    value: function showMessageLogo() {
      var _this2 = this;
      var container = document.querySelector('.chatbot-container');
      var avatar = container.querySelector('.chatbot-avatar');

      // Add animation class
      avatar.classList.add('message-logo-animation');

      // After animation completes, expand the chatbot
      setTimeout(function () {
        avatar.classList.remove('message-logo-animation');
        _this2.toggleChatbot();
        // Add greeting message
        setTimeout(function () {
          _this2.addBotMessage("Hello! 👋 I'm Harmony, your WebNodez assistant. How can I help you today?");
        }, 300);
      }, 1000);
    }
  }, {
    key: "addBotMessage",
    value: function addBotMessage(message) {
      var messagesContainer = document.querySelector('.chatbot-messages');
      var messageElement = document.createElement('div');
      messageElement.className = 'chatbot-message bot-message';
      messageElement.innerHTML = "\n            <div class=\"bot-avatar\">\n                <img src=\"/images/bot-avatar.svg\" alt=\"Harmony Bot\" />\n            </div>\n            <div class=\"message-content\">".concat(message, "</div>\n        ");
      messagesContainer.appendChild(messageElement);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
  }, {
    key: "addUserMessage",
    value: function addUserMessage(message) {
      var messagesContainer = document.querySelector('.chatbot-messages');
      var messageElement = document.createElement('div');
      messageElement.className = 'chatbot-message user-message';
      messageElement.innerHTML = message;
      messagesContainer.appendChild(messageElement);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
  }, {
    key: "handleUserInput",
    value: function handleUserInput() {
      var input = document.querySelector('.chatbot-input');
      var message = input.value.trim();
      if (message) {
        this.addUserMessage(message);
        input.value = '';
        this.processUserMessage(message);
      }
    }
  }, {
    key: "processUserMessage",
    value: function processUserMessage(message) {
      var _this3 = this;
      // Show typing indicator
      var messagesContainer = document.querySelector('.chatbot-messages');
      var typingIndicator = document.createElement('div');
      typingIndicator.className = 'typing-indicator';
      typingIndicator.innerHTML = "\n            <div class=\"typing-dot\"></div>\n            <div class=\"typing-dot\"></div>\n            <div class=\"typing-dot\"></div>\n        ";
      messagesContainer.appendChild(typingIndicator);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;

      // Simulate response delay
      setTimeout(function () {
        // Remove typing indicator
        messagesContainer.removeChild(typingIndicator);

        // Process the message and generate response
        var response = _this3.generateResponse(message);
        _this3.addBotMessage(response);
      }, 1000);
    }
  }, {
    key: "generateResponse",
    value: function generateResponse(message) {
      var lowerMessage = message.toLowerCase();

      // Check for profanity
      if (this.profanityWords.some(function (word) {
        return lowerMessage.includes(word);
      })) {
        var profanityResponses = ["I'd be happy to help you, but could you please rephrase your question without using inappropriate language? Let's keep our conversation professional and respectful.", "I'm here to assist you, and I'd appreciate if we could communicate in a professional manner. Could you please rephrase your question?", "I'm ready to help you with your inquiry. To ensure a productive conversation, could you please rephrase your question without using inappropriate language?", "I'm here to provide the best assistance possible. To help you better, could you please rephrase your question in a professional manner?", "I'd love to help you with your question. To make our conversation more effective, could you please rephrase it without using inappropriate language?"];
        return profanityResponses[Math.floor(Math.random() * profanityResponses.length)];
      }

      // Enterprise Solutions
      if (lowerMessage.includes('enterprise') || lowerMessage.includes('large') || lowerMessage.includes('corporate')) {
        var enterpriseResponses = ["Our enterprise solutions are designed for scalability and reliability:\n• Custom Enterprise Software\n• Cloud Infrastructure\n• Digital Transformation\n• Enterprise Security\n• Business Intelligence\n• System Integration\nWould you like to know more about our enterprise capabilities?", "We specialize in enterprise-grade solutions:\n• Scalable Architecture\n• High Availability Systems\n• Enterprise Security\n• Performance Optimization\n• Disaster Recovery\n• 24/7 Support\nWould you like to discuss your enterprise requirements?", "Our enterprise services include:\n• Digital Transformation\n• Legacy System Modernization\n• Enterprise Cloud Solutions\n• Business Process Automation\n• Enterprise Security\n• Compliance & Governance\nWould you like to schedule a consultation?"];
        return enterpriseResponses[Math.floor(Math.random() * enterpriseResponses.length)];
      }

      // Technology Stack
      if (lowerMessage.includes('tech') || lowerMessage.includes('technology') || lowerMessage.includes('stack') || lowerMessage.includes('framework')) {
        var techResponses = ["Our modern tech stack includes:\n• Frontend: React, Vue.js, Angular\n• Backend: Node.js, Python, Java\n• Mobile: React Native, Flutter\n• Cloud: AWS, Azure, GCP\n• DevOps: Docker, Kubernetes\n• Database: PostgreSQL, MongoDB\nWhich technology interests you?", "We use cutting-edge technologies:\n• Progressive Web Apps (PWA)\n• Microservices Architecture\n• Serverless Computing\n• AI/ML Integration\n• Blockchain Solutions\n• IoT Development\nWould you like to know more about our technical capabilities?", "Our technology expertise covers:\n• Full-Stack Development\n• Cloud-Native Solutions\n• DevOps & CI/CD\n• Security & Compliance\n• Performance Optimization\n• Scalable Architecture\nWhat specific technology are you interested in?"];
        return techResponses[Math.floor(Math.random() * techResponses.length)];
      }

      // Website Development
      if (lowerMessage.includes('website') || lowerMessage.includes('web development') || lowerMessage.includes('create website') || lowerMessage.includes('build website')) {
        var websiteResponses = ["Our website development services include:\n• Custom Web Applications\n• E-commerce Solutions\n• Progressive Web Apps (PWA)\n• Content Management Systems\n• SEO Optimization\n• Performance Optimization\nWould you like to know more about our web development process?", "We create modern, responsive websites:\n• User-Centric Design\n• Mobile-First Approach\n• Fast Loading Times\n• SEO-Friendly Structure\n• Secure Hosting\n• Regular Maintenance\nWould you like to discuss your website requirements?", "Our web development process includes:\n• Requirements Analysis\n• UX/UI Design\n• Development\n• Quality Assurance\n• Deployment\n• Ongoing Support\nWould you like to schedule a consultation?"];
        return websiteResponses[Math.floor(Math.random() * websiteResponses.length)];
      }

      // App Development
      if (lowerMessage.includes('app') || lowerMessage.includes('application') || lowerMessage.includes('mobile app') || lowerMessage.includes('create app')) {
        var appResponses = ["Our app development services include:\n• Native iOS & Android Apps\n• Cross-Platform Solutions\n• Progressive Web Apps\n• App Store Optimization\n• Push Notifications\n• Analytics Integration\nWould you like to know more about our app development process?", "We develop powerful mobile applications:\n• User-Centric Design\n• Performance Optimization\n• Secure Backend Integration\n• Real-time Features\n• Offline Functionality\n• Regular Updates\nWould you like to discuss your app idea?", "Our app development process includes:\n• Requirements Analysis\n• UI/UX Design\n• Development\n• Testing\n• App Store Submission\n• Post-Launch Support\nWould you like to schedule a consultation?"];
        return appResponses[Math.floor(Math.random() * appResponses.length)];
      }

      // Digital Marketing
      if (lowerMessage.includes('marketing') || lowerMessage.includes('seo') || lowerMessage.includes('digital') || lowerMessage.includes('promotion')) {
        var marketingResponses = ["Our digital marketing services include:\n• Search Engine Optimization (SEO)\n• Social Media Marketing\n• Content Marketing\n• Pay-Per-Click (PPC)\n• Email Marketing\n• Analytics & Reporting\nWould you like to know more about our marketing services?", "We help businesses grow online:\n• SEO Strategy\n• Social Media Management\n• Content Creation\n• PPC Campaigns\n• Email Marketing\n• Performance Analytics\nWould you like to discuss your marketing goals?", "Our digital marketing solutions:\n• Custom Marketing Strategy\n• SEO Optimization\n• Social Media Campaigns\n• Content Marketing\n• PPC Management\n• Analytics & Reporting\nWould you like to schedule a consultation?"];
        return marketingResponses[Math.floor(Math.random() * marketingResponses.length)];
      }

      // Cloud Services
      if (lowerMessage.includes('cloud') || lowerMessage.includes('hosting') || lowerMessage.includes('server') || lowerMessage.includes('infrastructure')) {
        var cloudResponses = ["Our cloud services include:\n• Cloud Migration\n• Cloud Infrastructure\n• Serverless Computing\n• DevOps Automation\n• Cloud Security\n• 24/7 Monitoring\nWould you like to know more about our cloud solutions?", "We provide comprehensive cloud solutions:\n• AWS, Azure, GCP\n• Cloud Architecture\n• Serverless Applications\n• DevOps & CI/CD\n• Cloud Security\n• Performance Optimization\nWould you like to discuss your cloud needs?", "Our cloud expertise covers:\n• Cloud Strategy\n• Migration Services\n• Infrastructure Management\n• Security & Compliance\n• Cost Optimization\n• 24/7 Support\nWould you like to schedule a consultation?"];
        return cloudResponses[Math.floor(Math.random() * cloudResponses.length)];
      }

      // Security Services
      if (lowerMessage.includes('security') || lowerMessage.includes('secure') || lowerMessage.includes('protect') || lowerMessage.includes('safety')) {
        var securityResponses = ["Our security services include:\n• Security Assessment\n• Penetration Testing\n• Security Architecture\n• Compliance Management\n• Incident Response\n• Security Monitoring\nWould you like to know more about our security solutions?", "We provide comprehensive security:\n• Application Security\n• Infrastructure Security\n• Data Protection\n• Compliance & Governance\n• Security Monitoring\n• Incident Response\nWould you like to discuss your security needs?", "Our security expertise covers:\n• Security Strategy\n• Risk Assessment\n• Compliance Management\n• Security Architecture\n• Incident Response\n• 24/7 Monitoring\nWould you like to schedule a consultation?"];
        return securityResponses[Math.floor(Math.random() * securityResponses.length)];
      }

      // Combined website and app queries
      if (lowerMessage.includes('both') || lowerMessage.includes('website and app') || lowerMessage.includes('app and website')) {
        var combinedResponses = ["Perfect! We can create both a website and mobile app for your business. Our comprehensive solution includes:\n• Responsive Website\n• Mobile App (iOS & Android)\n• Shared Backend\n• Unified Design\n• Cross-Platform Features\n• Integrated Analytics\nWould you like to know more about our combined solutions?", "We offer complete digital solutions! When you choose both website and app development, you get:\n• Consistent Brand Experience\n• Seamless User Journey\n• Unified Management System\n• Cross-Platform Features\n• Integrated Analytics\n• Complete Support Package\nWould you like to discuss your project requirements?", "Great choice! Our combined website and app development service includes:\n• Responsive Website\n• Native Mobile Apps\n• Shared Backend System\n• Unified Design Language\n• Cross-Platform Features\n• Complete Support\nWould you like to schedule a consultation to discuss your project?"];
        return combinedResponses[Math.floor(Math.random() * combinedResponses.length)];
      }

      // Greeting patterns
      if (lowerMessage.includes('hello') || lowerMessage.includes('hi') || lowerMessage.includes('hey')) {
        var greetings = ["Hello! 👋 I'm Harmony. How can I assist you today?", "Hi there! I'm Harmony. How are you doing? I'm here to help!", "Hey! I'm Harmony. Great to see you. What can I do for you today?", "Hello! I'm Harmony, your WebNodez assistant. How can I make your day better?", "Hi! I'm Harmony. Welcome to WebNodez. How may I help you today?", "Hello there! I'm Harmony, excited to help you explore our services. What interests you?", "Hey! I'm Harmony. Thanks for reaching out. What brings you to WebNodez today?"];
        return greetings[Math.floor(Math.random() * greetings.length)];
      }

      // Service related queries
      if (lowerMessage.includes('service') || lowerMessage.includes('services') || lowerMessage.includes('offer') || lowerMessage.includes('solutions')) {
        var serviceResponses = ["We offer a comprehensive range of services including:\n• Website Design & Development\n• E-commerce Solutions\n• Mobile App Development\n• Digital Marketing\n• Cloud Services\n• IT Consulting\nWhich area interests you the most?", "At WebNodez, we provide cutting-edge solutions including web development, mobile apps, cloud services, and digital marketing. Would you like to know more about any specific service?", "Our solutions are designed to help businesses grow through technology. We specialize in web development, mobile apps, and digital transformation. What aspect would you like to explore?", "Here's what we can do for you:\n• Custom Website Development\n• E-commerce Platforms\n• Mobile Applications\n• SEO & Digital Marketing\n• Cloud Infrastructure\n• Business Process Automation\nWhat would you like to learn more about?", "We're experts in:\n• Web Development\n• Mobile App Development\n• Digital Marketing\n• Cloud Solutions\n• IT Infrastructure\n• Business Intelligence\nWhich service aligns with your needs?"];
        return serviceResponses[Math.floor(Math.random() * serviceResponses.length)];
      }

      // Business growth related queries
      if (lowerMessage.includes('grow') || lowerMessage.includes('business') || lowerMessage.includes('help') || lowerMessage.includes('growth')) {
        var growthResponses = ["WebNodez can help grow your business through:\n• Custom Digital Solutions\n• Enhanced Online Presence\n• Improved Customer Engagement\n• Streamlined Operations\n• Data-Driven Insights\nWould you like to know more about any of these aspects?", "We help businesses grow by providing tailored digital solutions that increase efficiency, reach, and customer satisfaction. What's your current business challenge?", "Our expertise in digital transformation can help your business reach new heights. We focus on creating solutions that drive real business value. What are your growth goals?", "Let's grow your business together! We offer:\n• Digital Strategy Consulting\n• Market Expansion Solutions\n• Customer Experience Enhancement\n• Operational Efficiency Tools\n• Revenue Growth Strategies\nWhich area would you like to explore?", "We specialize in helping businesses scale through:\n• Digital Transformation\n• Market Penetration\n• Customer Acquisition\n• Process Optimization\n• Revenue Growth\nWhat's your primary growth objective?"];
        return growthResponses[Math.floor(Math.random() * growthResponses.length)];
      }

      // Price related queries
      if (lowerMessage.includes('price') || lowerMessage.includes('cost') || lowerMessage.includes('pricing') || lowerMessage.includes('budget')) {
        var pricingResponses = ["Our pricing is customized based on your specific needs. For detailed pricing information, please contact our sales team at sales@webnodez.com", "We offer flexible pricing models to suit different business needs. Would you like to schedule a consultation to discuss your requirements?", "Our solutions are competitively priced and tailored to your business needs. Let's connect you with our sales team for a detailed quote.", "We provide customized pricing based on:\n• Project Scope\n• Timeline\n• Technical Requirements\n• Support Level\nWould you like to discuss your specific needs?", "Our pricing structure is designed to be transparent and value-driven. Let's schedule a call to understand your requirements and provide a detailed quote."];
        return pricingResponses[Math.floor(Math.random() * pricingResponses.length)];
      }

      // Contact related queries
      if (lowerMessage.includes('contact') || lowerMessage.includes('support') || lowerMessage.includes('reach') || lowerMessage.includes('help')) {
        var contactResponses = ["You can reach us through:\n• Email: support@webnodez.com\n• Phone: +1-XXX-XXX-XXXX\n• Live Chat: Available 24/7\nHow would you like to connect?", "Our support team is available 24/7 to assist you. You can contact us via email, phone, or live chat. What's the best way to reach you?", "We're here to help! You can reach our team through multiple channels. Would you like me to connect you with a specific department?", "Connect with us:\n• Technical Support: support@webnodez.com\n• Sales Inquiries: sales@webnodez.com\n• General Questions: info@webnodez.com\nWhich department would you like to contact?", "Our team is ready to assist you:\n• Customer Support: 24/7\n• Sales Team: Mon-Fri, 9-5\n• Technical Support: 24/7\nHow can we help you today?"];
        return contactResponses[Math.floor(Math.random() * contactResponses.length)];
      }

      // Project related queries
      if (lowerMessage.includes('project') || lowerMessage.includes('timeline') || lowerMessage.includes('delivery') || lowerMessage.includes('process')) {
        var projectResponses = ["Our project process includes:\n• Requirements Gathering\n• Design & Planning\n• Development\n• Testing\n• Deployment\n• Support\nWould you like to know more about any phase?", "We follow an agile methodology to ensure timely delivery and quality results. Would you like to discuss your project timeline?", "Our development process is transparent and collaborative. Let's discuss your project requirements and timeline."];
        return projectResponses[Math.floor(Math.random() * projectResponses.length)];
      }

      // Complex or specific technical queries
      if (lowerMessage.includes('how to') || lowerMessage.includes('can you') || lowerMessage.includes('specific') || lowerMessage.includes('detailed')) {
        var complexResponses = ["I apologize, but I'm not able to provide detailed technical guidance on this specific topic. For specialized assistance, please contact our technical team at tech@webnodez.com or call our support line at +1-XXX-XXX-XXXX.", "I'm sorry, but this requires more detailed technical knowledge. Our expert team would be happy to help you with this. You can reach them at support@webnodez.com or through our 24/7 support line.", "For this specific technical question, I recommend reaching out to our technical support team. They can provide detailed guidance and solutions. Contact them at tech@webnodez.com"];
        return complexResponses[Math.floor(Math.random() * complexResponses.length)];
      }

      // Thank you responses
      if (lowerMessage.includes('thank')) {
        var thankResponses = ["You're welcome! Is there anything else I can help you with?", "Happy to help! Don't hesitate to ask if you need anything else.", "My pleasure! Feel free to reach out if you have more questions.", "You're welcome! I'm here whenever you need assistance.", "Glad I could help! Let me know if you need anything else."];
        return thankResponses[Math.floor(Math.random() * thankResponses.length)];
      }

      // Default response for unrecognized queries
      var defaultResponses = ["I apologize, but I'm not sure I can help with that specific question. For detailed assistance, please contact our support team at support@webnodez.com or call +1-XXX-XXX-XXXX. They'll be happy to help!", "I'm sorry, but I don't have enough information to answer that question accurately. Our technical team can provide detailed assistance. You can reach them at tech@webnodez.com", "For this specific query, I recommend reaching out to our expert team. They can provide the detailed information you need. Contact them at support@webnodez.com", "I want to ensure you get accurate information. For this question, please contact our support team at support@webnodez.com. They're available 24/7 to assist you.", "To provide you with the most accurate information, I suggest contacting our technical team. They can be reached at tech@webnodez.com or through our support line."];
      return defaultResponses[Math.floor(Math.random() * defaultResponses.length)];
    }
  }]);
}(); // Initialize chatbot when the page loads
document.addEventListener('DOMContentLoaded', function () {
  // Prevent multiple instances
  if (!window.chatbotInstance) {
    window.chatbotInstance = new Chatbot();
  }
});
/******/ })()
;