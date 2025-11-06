/**
 * Septan AI Chatbot - Vanilla JavaScript Implementation
 * Compatible with Laravel/Blade templates
 */

(function() {
  'use strict';

  // Chatbot state
  const chatbotState = {
    isOpen: false,
    isMinimized: false,
    messages: [
      {
        role: 'assistant',
        content: 'Hello! Welcome to Septan Developers. How can I assist you today with your construction and design needs?'
      }
    ],
    isLoading: false
  };

  // AI Response Logic (extracted from React component)
  function getAIResponse(userMessage) {
    const lowerMessage = userMessage.toLowerCase();
    
    if (lowerMessage.includes('service') || lowerMessage.includes('what do you')) {
      return 'We offer comprehensive construction and design services including:\n\n• Architectural Design\n• Structural Design\n• Building Information Modeling (BIM)\n• Interior Design\n• 3D Rendering & Visualization\n• Estimation & Consultation\n• Project Management\n\nWhich service interests you?';
    }
    
    if (lowerMessage.includes('project') || lowerMessage.includes('portfolio')) {
      return 'We\'ve completed over 300 projects across 35+ countries! Our portfolio includes eco-friendly resorts, sustainable offices, minimalist villas, and more. Visit our Projects page to see our featured work, or I can tell you more about a specific project type?';
    }
    
    if (lowerMessage.includes('contact') || lowerMessage.includes('reach') || lowerMessage.includes('phone')) {
      return 'You can reach us at:\n\n📍 Septan Developers (Pvt) Ltd\nAmbalangoda, Sri Lanka\n\n📞 +94 76 3132675\n\n📧 septandevelopers@gmail.com\n\nWould you like to schedule a consultation?';
    }
    
    if (lowerMessage.includes('price') || lowerMessage.includes('cost') || lowerMessage.includes('quote')) {
      return 'Project costs vary based on scope, size, and requirements. We offer free initial consultations and detailed estimates. Would you like to request a quote? Please provide some details about your project.';
    }
    
    if (lowerMessage.includes('sustainable') || lowerMessage.includes('eco') || lowerMessage.includes('green')) {
      return 'Sustainability is at the heart of what we do! We specialize in eco-friendly designs featuring:\n\n• Passive ventilation systems\n• Solar integration\n• Rainwater harvesting\n• Biophilic design\n• Locally sourced materials\n\nWould you like to know more about our sustainable practices?';
    }
    
    if (lowerMessage.includes('timeline') || lowerMessage.includes('how long')) {
      return 'Project timelines depend on complexity and scale. Typically:\n\n• Design phase: 2-4 weeks\n• Planning approval: 4-8 weeks\n• Construction: 3-12 months\n\nWe provide detailed schedules during consultation. Would you like to discuss your project timeline?';
    }
    
    return 'Thank you for your question! I\'m here to help with information about our services, projects, and how we can assist with your construction needs. You can also reach our team directly at +94 76 3132675 or septandevelopers@gmail.com for personalized assistance.';
  }

  // DOM Elements
  let chatbotContainer = null;
  let toggleButton = null;
  let chatWindow = null;
  let messagesContainer = null;
  let inputField = null;
  let sendButton = null;
  let minimizeButton = null;
  let closeButton = null;

  // Initialize chatbot
  function initChatbot() {
    // Check if already initialized
    if (document.getElementById('septan-chatbot-container')) {
      return;
    }

    // Create chatbot HTML structure
    createChatbotHTML();
    
    // Get DOM references
    toggleButton = document.getElementById('septan-chatbot-toggle');
    chatWindow = document.getElementById('septan-chatbot-window');
    messagesContainer = document.getElementById('septan-chatbot-messages');
    inputField = document.getElementById('septan-chatbot-input');
    sendButton = document.getElementById('septan-chatbot-send');
    minimizeButton = document.getElementById('septan-chatbot-minimize');
    closeButton = document.getElementById('septan-chatbot-close');

    // Attach event listeners
    if (toggleButton) {
      toggleButton.addEventListener('click', openChatbot);
    }
    
    if (closeButton) {
      closeButton.addEventListener('click', closeChatbot);
    }
    
    if (minimizeButton) {
      minimizeButton.addEventListener('click', toggleMinimize);
    }
    
    if (sendButton) {
      sendButton.addEventListener('click', handleSend);
    }
    
    if (inputField) {
      inputField.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
          e.preventDefault();
          handleSend();
        }
      });
      
      inputField.addEventListener('input', updateSendButton);
    }

    // Render initial messages
    renderMessages();
    
    // Initial button state
    updateSendButton();
  }

  // Create chatbot HTML structure
  function createChatbotHTML() {
    chatbotContainer = document.createElement('div');
    chatbotContainer.id = 'septan-chatbot-container';
    chatbotContainer.innerHTML = `
      <!-- Chat Toggle Button -->
      <button id="septan-chatbot-toggle" class="septan-chatbot-toggle" aria-label="Open chat">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
      </button>

      <!-- Chat Window -->
      <div id="septan-chatbot-window" class="septan-chatbot-window">
        <!-- Header -->
        <div class="septan-chatbot-header">
          <div class="septan-chatbot-header-info">
            <div class="septan-chatbot-avatar">S</div>
            <div>
              <h3>Septan AI Assistant</h3>
              <p>Online • Typically replies instantly</p>
            </div>
          </div>
          <div class="septan-chatbot-header-actions">
            <button id="septan-chatbot-minimize" class="septan-chatbot-btn-icon" aria-label="Minimize">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"></path>
              </svg>
            </button>
            <button id="septan-chatbot-close" class="septan-chatbot-btn-icon" aria-label="Close">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
        </div>

        <!-- Messages Container -->
        <div id="septan-chatbot-messages" class="septan-chatbot-messages"></div>

        <!-- Input Area -->
        <div class="septan-chatbot-input-area">
          <div class="septan-chatbot-input-wrapper">
            <input 
              type="text" 
              id="septan-chatbot-input" 
              class="septan-chatbot-input" 
              placeholder="Type your message..."
              autocomplete="off"
            />
            <button id="septan-chatbot-send" class="septan-chatbot-send-btn" aria-label="Send message">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
              </svg>
            </button>
          </div>
          <p class="septan-chatbot-footer-text">Powered by Septan AI • Press Enter to send</p>
        </div>
      </div>
    `;
    
    document.body.appendChild(chatbotContainer);
  }

  // Render messages
  function renderMessages() {
    if (!messagesContainer) return;
    
    messagesContainer.innerHTML = '';
    
    chatbotState.messages.forEach(function(message) {
      const messageEl = createMessageElement(message);
      messagesContainer.appendChild(messageEl);
    });
    
    // Show loading indicator if loading
    if (chatbotState.isLoading) {
      const loadingEl = createLoadingElement();
      messagesContainer.appendChild(loadingEl);
    }
    
    // Scroll to bottom
    scrollToBottom();
  }

  // Create message element
  function createMessageElement(message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'septan-chatbot-message ' + (message.role === 'user' ? 'septan-chatbot-message-user' : 'septan-chatbot-message-assistant');
    
    const contentDiv = document.createElement('div');
    contentDiv.className = 'septan-chatbot-message-content';
    contentDiv.textContent = message.content;
    
    // Preserve line breaks
    contentDiv.style.whiteSpace = 'pre-line';
    
    messageDiv.appendChild(contentDiv);
    return messageDiv;
  }

  // Create loading element
  function createLoadingElement() {
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'septan-chatbot-message septan-chatbot-message-assistant';
    
    const contentDiv = document.createElement('div');
    contentDiv.className = 'septan-chatbot-message-content septan-chatbot-loading';
    
    for (let i = 0; i < 3; i++) {
      const dot = document.createElement('div');
      dot.className = 'septan-chatbot-loading-dot';
      dot.style.animationDelay = (i * 150) + 'ms';
      contentDiv.appendChild(dot);
    }
    
    loadingDiv.appendChild(contentDiv);
    return loadingDiv;
  }

  // Scroll to bottom
  function scrollToBottom() {
    if (messagesContainer) {
      setTimeout(function() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
      }, 100);
    }
  }

  // Open chatbot
  function openChatbot() {
    chatbotState.isOpen = true;
    if (chatWindow) {
      chatWindow.classList.add('septan-chatbot-open');
    }
    if (toggleButton) {
      toggleButton.style.display = 'none';
    }
    if (inputField) {
      setTimeout(function() {
        inputField.focus();
      }, 100);
    }
  }

  // Close chatbot
  function closeChatbot() {
    chatbotState.isOpen = false;
    chatbotState.isMinimized = false;
    if (chatWindow) {
      chatWindow.classList.remove('septan-chatbot-open', 'septan-chatbot-minimized');
    }
    if (toggleButton) {
      toggleButton.style.display = 'flex';
    }
  }

  // Toggle minimize
  function toggleMinimize() {
    chatbotState.isMinimized = !chatbotState.isMinimized;
    if (chatWindow) {
      if (chatbotState.isMinimized) {
        chatWindow.classList.add('septan-chatbot-minimized');
      } else {
        chatWindow.classList.remove('septan-chatbot-minimized');
        if (inputField) {
          setTimeout(function() {
            inputField.focus();
          }, 100);
        }
      }
    }
  }

  // Handle send message
  function handleSend() {
    if (!inputField || chatbotState.isLoading) return;
    
    const message = inputField.value.trim();
    if (!message) return;

    // Add user message
    chatbotState.messages.push({
      role: 'user',
      content: message
    });

    // Clear input
    inputField.value = '';
    updateSendButton();

    // Render messages
    renderMessages();

    // Set loading state
    chatbotState.isLoading = true;
    renderMessages();

    // Simulate API delay and get response
    setTimeout(function() {
      const response = getAIResponse(message);
      
      chatbotState.messages.push({
        role: 'assistant',
        content: response
      });

      chatbotState.isLoading = false;
      renderMessages();
    }, 1000);
  }

  // Update send button state
  function updateSendButton() {
    if (sendButton && inputField) {
      const hasText = inputField.value.trim().length > 0;
      sendButton.disabled = !hasText || chatbotState.isLoading;
    }
  }

  // Initialize when DOM is ready
  function ready(fn) {
    if (document.readyState !== 'loading') {
      fn();
    } else {
      document.addEventListener('DOMContentLoaded', fn);
    }
  }

  // Start initialization
  ready(function() {
    // Small delay to ensure body exists
    setTimeout(function() {
      if (document.body) {
        try {
          initChatbot();
          console.log('Septan Chatbot initialized successfully');
        } catch (error) {
          console.error('Error initializing Septan Chatbot:', error);
        }
      } else {
        // Fallback: wait for body
        var observer = new MutationObserver(function(mutations) {
          if (document.body) {
            observer.disconnect();
            try {
              initChatbot();
              console.log('Septan Chatbot initialized successfully');
            } catch (error) {
              console.error('Error initializing Septan Chatbot:', error);
            }
          }
        });
        observer.observe(document.documentElement, { childList: true });
      }
    }, 100);
  });

})();

