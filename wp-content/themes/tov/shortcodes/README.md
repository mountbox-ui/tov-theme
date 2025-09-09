# Shortcodes Directory

This directory contains all custom shortcodes for the TOV theme.

## File Structure

```
shortcodes/
├── loader.php              # Loads all shortcode files
├── welcome-slider.php      # Hero slider shortcode
├── image-section.php       # Image + text section shortcode  
├── text-section.php        # Text-only section shortcode
└── README.md              # This file
```

## Available Shortcodes

### 1. Welcome Slider (`[welcome_slider]`)
- **File**: `welcome-slider.php`
- **Purpose**: Creates responsive image sliders with navigation
- **Usage**: `[welcome_slider slides='[...]' height="600px"]`

### 2. Image Section (`[image_section]`)
- **File**: `image-section.php`  
- **Purpose**: Two-column layout with image and text
- **Usage**: `[image_section image="..." title="..." content="..."]`

### 3. Text Section (`[text_section]`)
- **File**: `text-section.php`
- **Purpose**: Text-only sections with various alignments
- **Usage**: `[text_section title="..." content="..." align="center"]`

## Adding New Shortcodes

1. **Create new PHP file** in this directory
2. **Follow naming convention**: `shortcode-name.php`
3. **Add to loader.php** in the `$shortcode_files` array
4. **Include security check**: `if (!defined('ABSPATH')) { exit; }`
5. **Register shortcode**: `add_shortcode('shortcode_name', 'function_name');`

## Example Shortcode File Template

```php
<?php
/**
 * My Custom Shortcode
 * Description of what this shortcode does
 * 
 * Usage: [my_shortcode param="value"]
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function my_custom_shortcode($atts) {
    $atts = shortcode_atts(array(
        'param' => 'default_value',
    ), $atts);
    
    // Your shortcode logic here
    
    return 'Your HTML output';
}

// Register the shortcode
add_shortcode('my_shortcode', 'my_custom_shortcode');
```

## Best Practices

- **Security**: Always escape output with `esc_html()`, `esc_attr()`, `esc_url()`
- **Validation**: Validate and sanitize input parameters
- **Documentation**: Include clear usage examples in comments
- **Error Handling**: Provide fallback content for missing parameters
- **Performance**: Use `ob_start()` and `ob_get_clean()` for complex HTML output

## Loading System

All shortcodes are automatically loaded via `loader.php` which is included in `functions.php`. This keeps the main functions file clean and makes shortcodes modular and maintainable.
