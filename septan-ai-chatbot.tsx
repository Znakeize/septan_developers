import React, { useState, useRef, useEffect } from 'react';
import { Send, X, MessageCircle, Minimize2 } from 'lucide-react';

const SeptanChatbot = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [isMinimized, setIsMinimized] = useState(false);
  const [messages, setMessages] = useState([
    {
      role: 'assistant',
      content: 'Hello! Welcome to Septan Developers. How can I assist you today with your construction and design needs?'
    }
  ]);
  const [inputValue, setInputValue] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const messagesEndRef = useRef(null);

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' });
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  // Simulated AI responses - Replace with actual API call
  const getAIResponse = async (userMessage) => {
    // This is where you'd integrate with your AI service (OpenAI, Claude, etc.)
    // For now, using rule-based responses
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
  };

  const handleSend = async () => {
    if (!inputValue.trim()) return;

    const userMessage = {
      role: 'user',
      content: inputValue
    };

    setMessages(prev => [...prev, userMessage]);
    setInputValue('');
    setIsLoading(true);

    // Simulate API delay
    setTimeout(async () => {
      const response = await getAIResponse(inputValue);
      const assistantMessage = {
        role: 'assistant',
        content: response
      };
      setMessages(prev => [...prev, assistantMessage]);
      setIsLoading(false);
    }, 1000);
  };

  const handleKeyPress = (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      handleSend();
    }
  };

  return (
    <>
      {/* Chat Toggle Button */}
      {!isOpen && (
        <button
          onClick={() => setIsOpen(true)}
          className="fixed bottom-6 right-6 bg-gradient-to-r from-red-600 to-red-700 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 z-50"
        >
          <MessageCircle className="w-6 h-6" />
        </button>
      )}

      {/* Chat Window */}
      {isOpen && (
        <div 
          className={`fixed bottom-6 right-6 bg-black border border-gray-800 rounded-lg shadow-2xl z-50 flex flex-col transition-all duration-300 ${
            isMinimized ? 'w-80 h-16' : 'w-96 h-[600px]'
          }`}
        >
          {/* Header */}
          <div className="bg-gradient-to-r from-red-600 to-red-700 p-4 rounded-t-lg flex items-center justify-between">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 bg-white rounded-full flex items-center justify-center font-bold text-red-600">
                S
              </div>
              <div>
                <h3 className="font-bold text-white">Septan AI Assistant</h3>
                <p className="text-xs text-red-100">Online • Typically replies instantly</p>
              </div>
            </div>
            <div className="flex gap-2">
              <button
                onClick={() => setIsMinimized(!isMinimized)}
                className="text-white hover:bg-red-800 p-1 rounded transition-colors"
              >
                <Minimize2 className="w-5 h-5" />
              </button>
              <button
                onClick={() => setIsOpen(false)}
                className="text-white hover:bg-red-800 p-1 rounded transition-colors"
              >
                <X className="w-5 h-5" />
              </button>
            </div>
          </div>

          {/* Messages Container */}
          {!isMinimized && (
            <>
              <div className="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-950">
                {messages.map((message, index) => (
                  <div
                    key={index}
                    className={`flex ${message.role === 'user' ? 'justify-end' : 'justify-start'}`}
                  >
                    <div
                      className={`max-w-[80%] p-3 rounded-lg ${
                        message.role === 'user'
                          ? 'bg-red-600 text-white'
                          : 'bg-gray-800 text-gray-100 border border-gray-700'
                      }`}
                    >
                      <p className="text-sm whitespace-pre-line">{message.content}</p>
                    </div>
                  </div>
                ))}
                
                {isLoading && (
                  <div className="flex justify-start">
                    <div className="bg-gray-800 border border-gray-700 p-3 rounded-lg">
                      <div className="flex gap-1">
                        <div className="w-2 h-2 bg-red-600 rounded-full animate-bounce" style={{ animationDelay: '0ms' }}></div>
                        <div className="w-2 h-2 bg-red-600 rounded-full animate-bounce" style={{ animationDelay: '150ms' }}></div>
                        <div className="w-2 h-2 bg-red-600 rounded-full animate-bounce" style={{ animationDelay: '300ms' }}></div>
                      </div>
                    </div>
                  </div>
                )}
                
                <div ref={messagesEndRef} />
              </div>

              {/* Input Area */}
              <div className="p-4 bg-black border-t border-gray-800">
                <div className="flex gap-2">
                  <input
                    type="text"
                    value={inputValue}
                    onChange={(e) => setInputValue(e.target.value)}
                    onKeyPress={handleKeyPress}
                    placeholder="Type your message..."
                    className="flex-1 bg-gray-900 border border-gray-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-red-600 transition-colors"
                  />
                  <button
                    onClick={handleSend}
                    disabled={!inputValue.trim() || isLoading}
                    className="bg-red-600 text-white p-2 rounded-lg hover:bg-red-700 disabled:bg-gray-700 disabled:cursor-not-allowed transition-colors"
                  >
                    <Send className="w-5 h-5" />
                  </button>
                </div>
                <p className="text-xs text-gray-500 mt-2 text-center">
                  Powered by Septan AI • Press Enter to send
                </p>
              </div>
            </>
          )}
        </div>
      )}
    </>
  );
};

export default SeptanChatbot;