<div id="septan-chatbot-root">
  <!-- Chat Toggle Button -->
  <button
    id="septan-chatbot-toggle"
    aria-label="Open chat"
    class="fixed bottom-6 right-6 bg-gradient-to-r from-red-600 to-red-700 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 z-50"
  >
    <!-- Message icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V5a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
    </svg>
  </button>

  <!-- Chat Window -->
  <div
    id="septan-chatbot-window"
    class="hidden fixed bottom-6 right-6 bg-black border border-gray-800 rounded-lg shadow-2xl z-50 flex flex-col transition-all duration-300 w-96 h-[600px]"
  >
    <!-- Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 p-4 rounded-t-lg flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center font-bold text-red-600">S</div>
        <div>
          <h3 class="font-bold text-white">Septan AI Assistant</h3>
          <p class="text-xs text-red-100">Online • Typically replies instantly</p>
        </div>
      </div>
      <div class="flex gap-2">
        <button id="septan-chatbot-minimize" class="text-white hover:bg-red-800 p-1 rounded transition-colors" aria-label="Minimize">
          <!-- Minimize icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 14H4"/>
          </svg>
        </button>
        <button id="septan-chatbot-close" class="text-white hover:bg-red-800 p-1 rounded transition-colors" aria-label="Close">
          <!-- Close icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Messages Container -->
    <div id="septan-chatbot-body" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-950">
      <!-- Initial message inserted by JS -->
    </div>

    <!-- Input Area -->
    <div class="p-4 bg-black border-t border-gray-800">
      <div class="flex gap-2">
        <input
          id="septan-chatbot-input"
          type="text"
          placeholder="Type your message..."
          class="flex-1 bg-gray-900 border border-gray-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-red-600 transition-colors"
        />
        <button
          id="septan-chatbot-send"
          class="bg-red-600 text-white p-2 rounded-lg hover:bg-red-700 disabled:bg-gray-700 disabled:cursor-not-allowed transition-colors"
        >
          <!-- Send icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="22" y1="2" x2="11" y2="13"/>
            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
          </svg>
        </button>
      </div>
      <p class="text-xs text-gray-500 mt-2 text-center">Powered by Septan AI • Press Enter to send</p>
    </div>
  </div>
</div>

<script src="{{ asset('js/septan-chatbot.js') }}" defer></script>
