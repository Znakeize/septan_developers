# Chatbot Troubleshooting Guide

## Quick Fix Checklist

If the chatbot is not appearing, check these items in order:

### 1. Verify Files Exist
- ✅ `public/assets/js/chatbot.js` - Should exist
- ✅ `public/assets/css/chatbot.css` - Should exist  
- ✅ `resources/views/partials/chatbot.blade.php` - Should exist

### 2. Check Home.blade.php Integration

The chatbot should be included in `resources/views/Home.blade.php`:

**In the `<head>` section (around line 11):**
```blade
<link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
```

**Before closing `</body>` tag (around line 1156):**
```blade
@include('partials.chatbot')
```

### 3. Clear Browser Cache
- Hard refresh: `Ctrl + F5` (Windows) or `Cmd + Shift + R` (Mac)
- Or clear browser cache completely

### 4. Check Browser Console
1. Open browser DevTools (F12)
2. Go to Console tab
3. Look for:
   - ✅ "Septan Chatbot initialized successfully" - Good!
   - ❌ Any red error messages - Bad, note the error

### 5. Verify Asset Paths
Check that these URLs work in your browser:
- `http://your-domain/assets/css/chatbot.css`
- `http://your-domain/assets/js/chatbot.js`

If using Laravel's `asset()` helper, make sure:
- `APP_URL` is set correctly in `.env`
- Public storage is linked: `php artisan storage:link`

### 6. Check for JavaScript Errors
Common issues:
- **jQuery conflicts**: The chatbot uses vanilla JS, shouldn't conflict
- **Z-index conflicts**: Chatbot uses z-index 9999, should be highest
- **CSS conflicts**: Check if other styles override chatbot styles

### 7. Check File Permissions
Ensure files are readable:
```bash
chmod 644 public/assets/js/chatbot.js
chmod 644 public/assets/css/chatbot.css
chmod 644 resources/views/partials/chatbot.blade.php
```

## Manual Testing Steps

1. **Open Home Page**
   - Navigate to your homepage
   - Look for red circular button in bottom-right corner

2. **Check Element Exists**
   - Right-click page → Inspect
   - Search for `septan-chatbot-toggle`
   - Should find: `<button id="septan-chatbot-toggle">`

3. **Check CSS Loaded**
   - In DevTools → Network tab
   - Reload page
   - Look for `chatbot.css` - should load with status 200

4. **Check JavaScript Loaded**
   - In DevTools → Network tab
   - Reload page  
   - Look for `chatbot.js` - should load with status 200

5. **Check Console Messages**
   - Should see: "Septan Chatbot initialized successfully"
   - No red error messages

## Common Issues & Solutions

### Issue: Chatbot button not visible
**Solution**: 
- Check z-index (should be 9999)
- Check if footer/nav is covering it
- Verify CSS file loaded

### Issue: Console shows "Chatbot initialized" but no button
**Solution**:
- Check CSS file loaded correctly
- Verify `.septan-chatbot-toggle` styles applied
- Check for CSS conflicts

### Issue: JavaScript errors in console
**Solution**:
- Check for syntax errors in chatbot.js
- Verify no conflicts with other scripts
- Check browser compatibility

### Issue: Button appears but doesn't open chat
**Solution**:
- Check event listeners attached
- Verify `chatbot.js` loaded completely
- Check for JavaScript errors

### Issue: Chat opens but messages don't send
**Solution**:
- Check input field exists
- Verify send button event listener
- Check console for errors

## Debug Mode

To enable more detailed logging, add this to `chatbot.js` after line 7:

```javascript
window.septanChatbotDebug = true;
```

Then check console for detailed initialization logs.

## Still Not Working?

1. **Verify Laravel Asset Helper**
   ```php
   // In browser console, check:
   console.log('{{ asset("assets/js/chatbot.js") }}');
   ```

2. **Check File Contents**
   - Open `public/assets/js/chatbot.js` in browser
   - Should see JavaScript code, not 404 error

3. **Test Direct Include**
   Instead of using `@include`, try direct inclusion:
   ```blade
   <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
   <script src="{{ asset('assets/js/chatbot.js') }}"></script>
   ```

4. **Check Laravel Cache**
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

5. **Verify Server Configuration**
   - Ensure `.htaccess` allows JS/CSS files
   - Check web server (Apache/Nginx) logs

## Expected Behavior

When working correctly:
1. ✅ Red circular button appears bottom-right
2. ✅ Button has hover effect (scales up)
3. ✅ Clicking opens chat window
4. ✅ Can type and send messages
5. ✅ Messages appear correctly
6. ✅ Minimize/close buttons work
7. ✅ Responsive on mobile

## Contact Support

If none of these solutions work:
1. Note the exact error message from console
2. Check which step failed in the checklist
3. Verify Laravel version compatibility
4. Check server logs for errors

