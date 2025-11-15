# Flash Message System

This app now includes a comprehensive flash message system that provides user-friendly notifications with auto-dismiss functionality and manual close options.

## Features

- **Auto-dismiss**: Messages automatically disappear after 45 seconds
- **Manual close**: Users can close messages manually by clicking the X button
- **Multiple types**: Success, error, warning, info, and default message types
- **Pause on hover**: Timer pauses when user hovers over a message
- **Responsive design**: Works on all screen sizes
- **Server integration**: Automatically displays Laravel session flash messages
- **Programmatic control**: Can be triggered from JavaScript/Vue components

## Usage

### Server-Side (Laravel Controllers)

```php
// Single message
return redirect()->route('dashboard')->with('success', 'Operation completed!');

// Multiple messages
return redirect()->route('dashboard')
    ->with('success', 'Success message')
    ->with('error', 'Error message')
    ->with('warning', 'Warning message')
    ->with('info', 'Info message');
```

### Client-Side (Vue Components)

```vue
<script setup>
import { useFlashMessages } from '@/composables/useFlashMessages'

const { success, error, warning, info, message } = useFlashMessages()

// Show different types of messages
success('Operation completed successfully!')
error('Something went wrong!')
warning('Please be careful!')
info('Here is some information')
message('Default message')
</script>
```

### Message Types

1. **Success** (`success`): Green background, for successful operations
2. **Error** (`error`): Red background, for errors and failures
3. **Warning** (`warning`): Yellow background, for warnings and cautions
4. **Info** (`info`): Blue background, for informational messages
5. **Default** (`message`): Gray background, for general messages

### Customization

You can customize individual messages:

```javascript
// Custom duration (in milliseconds)
success('Message', 'Custom Title', 30000) // 30 seconds

// Disable auto-close
message('Important message', 'Title', false)

// Custom variant
addToast({
  title: 'Custom',
  description: 'Message',
  variant: 'warning',
  duration: 60000,
  autoClose: true
})
```

## Components

The system consists of several Vue components:

- `ToastProvider.vue`: Main provider that manages all toasts
- `Toast.vue`: Individual toast message component
- `ToastViewport.vue`: Container for all toasts
- `ToastTitle.vue`: Toast title component
- `ToastDescription.vue`: Toast description component
- `ToastClose.vue`: Close button component

## Styling

Toasts are styled using Tailwind CSS classes and include:

- Smooth enter/exit animations
- Responsive positioning (top on mobile, right on desktop)
- Hover effects and focus states
- Color-coded variants for different message types

## Testing

Test routes are available at:

- `/test` - Shows all message types
- `/test/success` - Success message only
- `/test/error` - Error message only
- `/test/warning` - Warning message only
- `/test/info` - Info message only

## Integration

The system is automatically integrated into:

- All authenticated pages via `AppShell.vue`
- Laravel session flash messages via `HandleInertiaRequests` middleware
- Vue components via the `useFlashMessages` composable

## Browser Support

- Modern browsers with ES6+ support
- Vue 3 Composition API
- Tailwind CSS v4
- Inertia.js v2
