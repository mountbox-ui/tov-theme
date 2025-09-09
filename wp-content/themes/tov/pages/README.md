# Pages Templates Directory

This directory contains all page templates for the TOV theme. Each template provides a specific layout and functionality for different types of pages.

## File Structure

```
pages/
├── front-page.php          # Homepage template (automatic)
├── page.php                # Default page template
├── page-home.php           # Homepage template (selectable)
├── page-about.php          # About page template (selectable)
├── page-contact.php        # Contact page template (selectable)
├── page-services.php       # Services page template (selectable)
└── README.md              # This file
```

## Template Types

### 1. Automatic Templates
- **`front-page.php`** - WordPress automatically uses this for the homepage
- **`page.php`** - Default template for all pages

### 2. Selectable Templates (Template Name)
These templates appear in the WordPress admin under "Page Attributes" → "Template":

- **Homepage Template** (`page-home.php`) - For homepage-style layouts with shortcodes
- **About Page Template** (`page-about.php`) - Hero section + content layout
- **Contact Page Template** (`page-contact.php`) - Contact info + form layout
- **Services Page Template** (`page-services.php`) - Services grid + content layout

## How to Use Templates

### For Clients (WordPress Admin):

1. **Create a new page** in WordPress admin
2. **Go to Page Attributes** box on the right
3. **Select a template** from the "Template" dropdown
4. **Add your content** and publish

### For Developers:

1. **Create new template file** in this directory
2. **Add template header** comment: `Template Name: Your Template Name`
3. **Follow WordPress template hierarchy**
4. **Test and document usage**

## Template Features

### Homepage Template (`page-home.php`)
- **Purpose**: Homepage layouts with shortcodes
- **Features**: 
  - Supports all theme shortcodes
  - Clean content wrapper
  - Optimized for landing pages

### About Page Template (`page-about.php`)
- **Purpose**: Company/personal about pages
- **Features**:
  - Hero section with title and excerpt
  - Featured image support
  - Content area with typography styles
  - Responsive design

### Contact Page Template (`page-contact.php`)
- **Purpose**: Contact and location pages
- **Features**:
  - Hero section
  - Contact information display
  - Custom fields support (phone, email, address)
  - Contact form integration area
  - Two-column layout

### Services Page Template (`page-services.php`)
- **Purpose**: Service listings and portfolios
- **Features**:
  - Hero section
  - Services grid layout
  - Custom fields support for services
  - Icon support
  - Responsive grid system

## Custom Fields Support

Several templates support custom fields for enhanced functionality:

### Contact Page Fields:
- `contact_phone` - Phone number
- `contact_email` - Email address  
- `contact_address` - Physical address

### Services Page Fields:
- `services_list` - Array of service items with:
  - `title` - Service name
  - `description` - Service description
  - `icon` - Service icon URL

## Adding Custom Fields

You can add custom fields using:
1. **WordPress Custom Fields** (basic)
2. **Advanced Custom Fields (ACF)** plugin (recommended)
3. **Custom meta boxes** in functions.php

## Template Hierarchy

WordPress follows this hierarchy for page templates:

1. **Custom page template** (if selected)
2. **page-{slug}.php** (e.g., page-about.php for /about page)
3. **page-{id}.php** (e.g., page-123.php)
4. **page.php** (default page template)
5. **singular.php**
6. **index.php**

## Creating New Templates

### Template File Example:
```php
<?php
/**
 * Template Name: My Custom Template
 * 
 * Description of what this template does.
 */

get_header(); ?>

<main class="my-custom-page">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- Your custom layout here -->
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
            
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
```

### Best Practices:
- **Use descriptive template names**
- **Include template description** in header comment
- **Follow theme's CSS classes** and structure
- **Test on different screen sizes**
- **Document custom fields** and usage
- **Include fallback content** for missing data

## Integration with Shortcodes

All page templates work seamlessly with the theme's shortcodes:
- `[welcome_slider]` - Hero sliders
- `[image_section]` - Image + text sections
- `[text_section]` - Text-only sections

Simply add shortcode content in the WordPress page editor, and the template will render it properly.

## Troubleshooting

### Template Not Appearing in Dropdown:
- Check the `Template Name:` header comment
- Ensure file is in the correct directory
- Clear any caching plugins

### Template Not Loading:
- Verify file permissions
- Check for PHP errors in error logs
- Ensure proper WordPress template structure

### Styling Issues:
- Check CSS classes match theme styles
- Test responsive breakpoints
- Validate HTML structure
