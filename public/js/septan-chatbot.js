'use strict';
(function () {
  function $(id) { return document.getElementById(id); }

  var toggleBtn, chatWindow, closeBtn, minimizeBtn, bodyEl, inputEl, sendBtn;
  var isOpen = false;
  var isMinimized = false;
  var isLoading = false;
  var messages = [
    {
      role: 'assistant',
      content: 'Hello! Welcome to Septan Developers. How can I assist you today with your construction and design needs?'
    }
  ];

  function ensureEls() {
    toggleBtn = $('septan-chatbot-toggle');
    chatWindow = $('septan-chatbot-window');
    closeBtn = $('septan-chatbot-close');
    minimizeBtn = $('septan-chatbot-minimize');
    bodyEl = $('septan-chatbot-body');
    inputEl = $('septan-chatbot-input');
    sendBtn = $('septan-chatbot-send');
    return toggleBtn && chatWindow && closeBtn && minimizeBtn && bodyEl && inputEl && sendBtn;
  }

  function scrollToBottom() {
    if (!bodyEl) return;
    bodyEl.scrollTop = bodyEl.scrollHeight;
  }

  function createBubble(message) {
    var outer = document.createElement('div');
    outer.className = 'flex ' + (message.role === 'user' ? 'justify-end' : 'justify-start');

    var inner = document.createElement('div');
    inner.className = 'max-w-[80%] p-3 rounded-lg ' + (message.role === 'user'
      ? 'bg-red-600 text-white'
      : 'bg-gray-800 text-gray-100 border border-gray-700');

    var p = document.createElement('p');
    p.className = 'text-sm whitespace-pre-line';
    p.textContent = message.content;

    inner.appendChild(p);
    outer.appendChild(inner);
    return outer;
  }

  var typingEl = null;
  function showTyping() {
    if (typingEl) return;
    typingEl = document.createElement('div');
    typingEl.className = 'flex justify-start';
    typingEl.innerHTML = '\n      <div class="bg-gray-800 border border-gray-700 p-3 rounded-lg">\n        <div class="flex gap-1">\n          <div class="w-2 h-2 bg-red-600 rounded-full animate-bounce" style="animation-delay:0ms"></div>\n          <div class="w-2 h-2 bg-red-600 rounded-full animate-bounce" style="animation-delay:150ms"></div>\n          <div class="w-2 h-2 bg-red-600 rounded-full animate-bounce" style="animation-delay:300ms"></div>\n        </div>\n      </div>\n    ';
    bodyEl.appendChild(typingEl);
    scrollToBottom();
  }
  function hideTyping() {
    if (typingEl && typingEl.parentNode) typingEl.parentNode.removeChild(typingEl);
    typingEl = null;
  }

  function renderMessages() {
    if (!bodyEl) return;
    bodyEl.innerHTML = '';
    messages.forEach(function (m) {
      bodyEl.appendChild(createBubble(m));
    });
    scrollToBottom();
  }

  function setWindowSize() {
    if (!chatWindow) return;
    var classes = chatWindow.className.split(/\s+/);
    // remove size classes if present
    classes = classes.filter(function (c) { return c !== 'w-80' && c !== 'h-16' && c !== 'w-96' && c !== 'h-[600px]'; });
    if (isMinimized) {
      classes.push('w-80', 'h-16');
      if (bodyEl) bodyEl.classList.add('hidden');
      var inputWrap = chatWindow.querySelector('.border-t');
      if (inputWrap) inputWrap.classList.add('hidden');
    } else {
      classes.push('w-96', 'h-[600px]');
      if (bodyEl) bodyEl.classList.remove('hidden');
      var inputWrap2 = chatWindow.querySelector('.border-t');
      if (inputWrap2) inputWrap2.classList.remove('hidden');
    }
    chatWindow.className = classes.join(' ');
  }

  function openChat() {
    if (!chatWindow || !toggleBtn) return;
    isOpen = true;
    chatWindow.classList.remove('hidden');
    toggleBtn.classList.add('hidden');
    setWindowSize();
    renderMessages();
    setTimeout(scrollToBottom, 0);
  }

  function closeChat() {
    if (!chatWindow || !toggleBtn) return;
    isOpen = false;
    chatWindow.classList.add('hidden');
    toggleBtn.classList.remove('hidden');
  }

  function toggleMinimize() {
    isMinimized = !isMinimized;
    setWindowSize();
  }

  function getAIResponse(userMessage) {
    var lowerMessage = (userMessage || '').toLowerCase();
    if (lowerMessage.includes('service') || lowerMessage.includes('what do you')) {
      return 'We offer comprehensive construction and design services including:\n\n• Architectural Design\n• Structural Design\n• Building Information Modeling (BIM)\n• Interior Design\n• 3D Rendering & Visualization\n• Estimation & Consultation\n• Project Management\n\nWhich service interests you?';
    }
    if (lowerMessage.includes('project') || lowerMessage.includes('portfolio')) {
      return "We've completed over 300 projects across 35+ countries! Our portfolio includes eco-friendly resorts, sustainable offices, minimalist villas, and more. Visit our Projects page to see our featured work, or I can tell you more about a specific project type?";
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
    return "Thank you for your question! I'm here to help with information about our services, projects, and how we can assist with your construction needs. You can also reach our team directly at +94 76 3132675 or septandevelopers@gmail.com for personalized assistance.";
  }

  function setLoading(state) {
    isLoading = state;
    if (sendBtn) {
      if (isLoading || !inputEl.value.trim()) sendBtn.setAttribute('disabled', 'true');
      else sendBtn.removeAttribute('disabled');
    }
  }

  function onInputChanged() {
    if (!sendBtn) return;
    if (isLoading || !inputEl.value.trim()) sendBtn.setAttribute('disabled', 'true');
    else sendBtn.removeAttribute('disabled');
  }

  function handleSend() {
    if (!inputEl) return;
    var text = inputEl.value.trim();
    if (!text || isLoading) return;

    var userMessage = { role: 'user', content: text };
    messages.push(userMessage);
    inputEl.value = '';
    renderMessages();
    setLoading(true);

    setTimeout(function () {
      showTyping();
      setTimeout(function () {
        var response = getAIResponse(text);
        hideTyping();
        messages.push({ role: 'assistant', content: response });
        renderMessages();
        setLoading(false);
      }, 800);
    }, 200);
  }

  function onKeyPress(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      handleSend();
    }
  }

  function initEvents() {
    if (toggleBtn) toggleBtn.addEventListener('click', openChat);
    if (closeBtn) closeBtn.addEventListener('click', closeChat);
    if (minimizeBtn) minimizeBtn.addEventListener('click', toggleMinimize);
    if (sendBtn) sendBtn.addEventListener('click', handleSend);
    if (inputEl) inputEl.addEventListener('keypress', onKeyPress);
    if (inputEl) inputEl.addEventListener('input', onInputChanged);
  }

  function boot() {
    if (!ensureEls()) return;
    // initial render
    renderMessages();
    // initially closed (toggle visible, window hidden via HTML)
    onInputChanged();
    initEvents();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
