# Septan AI Chatbot Integration Guide

This guide explains how to integrate the Septan AI Chatbot into your Laravel/Blade templates.

## Overview

The chatbot is a vanilla JavaScript implementation (no React required) that provides an AI assistant interface for your website visitors. It includes:

- **Open/Close functionality** - Toggle button to show/hide the chat window
- **Minimize feature** - Collapse the chat window to a header bar
- **Message history** - Maintains conversation state
- **AI responses** - Rule-based responses for common questions
- **Responsive design** - Works on desktop and mobile devices

## Files Created

1. **`public/assets/js/chatbot.js`** - Main JavaScript logic
2. **`public/assets/css/chatbot.css`** - Chatbot styles
3. **`resources/views/partials/chatbot.blade.php`** - Blade partial for easy inclusion

## Quick Integration

### Method 1: Using the Blade Partial (Recommended)

Simply include the partial in any Blade template where you want the chatbot to appear:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content -->
</head>
<body>
    <!-- Your page content -->
    
    <!-- Include chatbot before closing body tag -->
    @include('partials.chatbot')
</body>
</html>
```

### Method 2: Manual Inclusion

If you prefer to include the files manually:

```blade
<!-- In your <head> section -->
<link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">

<!-- Before closing </body> tag -->
<script src="{{ asset('assets/js/chatbot.js') }}" defer></script>
```

## Example: Adding to Home Page

To add the chatbot to your home page (`resources/views/Home.blade.php`):

```blade
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Add chatbot here -->
    @include('partials.chatbot')
</body>
</html>
```

## Customization

### Changing AI Responses

Edit the `getAIResponse()` function in `public/assets/js/chatbot.js` to customize the chatbot's responses.

### Styling

Modify `public/assets/css/chatbot.css` to change colors, sizes, or layout. The chatbot uses:
- **Primary color**: Red (#dc2626) - matches Septan Developers branding
- **Background**: Black (#000) with dark gray accents
- **Text**: White/light gray for contrast

### Initial Message

Change the initial welcome message by editing the `messages` array in `chatbotState`:

```javascript
messages: [
  {
    role: 'assistant',
    content: 'Your custom welcome message here'
  }
]
```

## Features

### Current Features

- ✅ Open/Close chat window
- ✅ Minimize/Restore chat window
- ✅ Send messages via button or Enter key
- ✅ Loading indicator while processing
- ✅ Auto-scroll to latest message
- ✅ Responsive design for mobile
- ✅ Rule-based AI responses for:
  - Services information
  - Project/Portfolio queries
  - Contact information
  - Pricing/Quotes
  - Sustainability topics
  - Timeline questions

### Future Enhancements

To integrate with a real AI service (OpenAI, Claude, etc.), modify the `handleSend()` function in `chatbot.js`:

```javascript
// Replace the setTimeout with actual API call
async function handleSend() {
  // ... existing code ...
  
  try {
    const response = await fetch('/api/chatbot', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ message: message })
    });
    
    const data = await response.json();
    chatbotState.messages.push({
      role: 'assistant',
      content: data.response
    });
  } catch (error) {
    console.error('Error:', error);
  }
  
  // ... rest of code ...
}
```

## Browser Compatibility

The chatbot works in all modern browsers:
- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Troubleshooting

### Chatbot not appearing

1. Check that the CSS and JS files are being loaded
2. Verify the file paths are correct
3. Check browser console for JavaScript errors
4. Ensure the partial is included before the closing `</body>` tag

### Styling issues

1. Check for CSS conflicts with existing styles
2. Verify the chatbot CSS is loaded after your main CSS
3. Use browser DevTools to inspect element styles

### Messages not sending

1. Check browser console for errors
2. Verify the input field and send button are properly initialized
3. Ensure JavaScript is enabled in the browser

## Support

For issues or questions, refer to the main project documentation or contact the development team.

