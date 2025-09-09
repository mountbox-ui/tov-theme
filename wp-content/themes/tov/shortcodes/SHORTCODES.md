# Homepage Shortcodes Documentation

This theme includes custom shortcodes for easy homepage content management. Your clients can use these shortcodes in the WordPress page editor to create beautiful homepage layouts.

## Welcome Slider Shortcode

Creates a responsive image slider with navigation and autoplay functionality.

### Usage:
```
[welcome_slider slides='[{"image":"https://example.com/slide1.jpg","title":"Welcome to Our Site","subtitle":"We create amazing experiences","button_text":"Learn More","button_url":"/about"},{"image":"https://example.com/slide2.jpg","title":"Our Services","subtitle":"Professional solutions for your business","button_text":"View Services","button_url":"/services"}]' height="600px" autoplay="true" duration="5000"]
```

### Parameters:
- **slides** (required): JSON array of slide objects
- **height**: Slider height (default: "500px")
- **autoplay**: Enable autoplay (default: "true")
- **duration**: Autoplay duration in milliseconds (default: "5000")

### Slide Object Properties:
- **image**: Background image URL
- **title**: Main heading text
- **subtitle**: Subheading text
- **button_text**: Call-to-action button text
- **button_url**: Button link URL

## Image Section Shortcode

Creates a two-column section with image and text content.

### Usage:
```
[image_section image="https://example.com/image.jpg" alt="About us image" position="left" title="About Our Company" content="We are a leading provider of innovative solutions that help businesses grow and succeed in today's competitive market." button_text="Learn More" button_url="/about" background="transparent"]
```

### Parameters:
- **image**: Image URL
- **alt**: Image alt text for accessibility
- **position**: Image position - "left" or "right" (default: "left")
- **title**: Section heading (recommended: ~10 words)
- **content**: Section text content (recommended: ~50 words)
- **button_text**: Optional button text
- **button_url**: Optional button URL
- **background**: Background color - "transparent", "navy", or "white" (default: "transparent")

## Text Section Shortcode

Creates a text-only section without images.

### Usage:
```
[text_section title="Our Mission Statement" content="We strive to deliver exceptional value through innovative solutions and outstanding customer service that exceeds expectations." align="center" background="navy" button_text="Contact Us" button_url="/contact"]
```

### Parameters:
- **title**: Section heading
- **content**: Section text content
- **align**: Text alignment - "left", "center", or "right" (default: "left")
- **background**: Background color - "transparent", "navy", or "white" (default: "transparent")
- **button_text**: Optional button text
- **button_url**: Optional button URL

## Example Homepage Layout

Here's an example of how to structure a complete homepage using these shortcodes:

```
[welcome_slider slides='[{"image":"https://example.com/hero1.jpg","title":"Welcome to Our Business","subtitle":"Creating exceptional experiences for our clients","button_text":"Get Started","button_url":"/contact"},{"image":"https://example.com/hero2.jpg","title":"Professional Services","subtitle":"Expert solutions tailored to your needs","button_text":"Learn More","button_url":"/services"}]' height="600px"]

[image_section image="https://example.com/about-image.jpg" alt="Our team at work" position="left" title="About Our Company" content="We are passionate professionals dedicated to delivering innovative solutions that drive business growth and success in today's competitive marketplace." button_text="Read Our Story" button_url="/about"]

[image_section image="https://example.com/services-image.jpg" alt="Our services" position="right" title="What We Offer" content="From strategic consulting to implementation, we provide comprehensive services designed to meet your unique business needs and objectives." button_text="View Services" button_url="/services" background="navy"]

[text_section title="Ready to Get Started?" content="Contact us today to discuss how we can help transform your business with our proven strategies and innovative solutions." align="center" background="white" button_text="Contact Us Now" button_url="/contact"]
```

## Tips for Clients:

1. **Image Recommendations:**
   - Use high-quality images (minimum 1200px wide)
   - Optimize images for web (under 500KB each)
   - Ensure images have good contrast for text overlay

2. **Content Guidelines:**
   - Keep titles concise (around 10 words)
   - Write engaging content (around 50 words per section)
   - Use clear, action-oriented button text

3. **Background Options:**
   - **transparent**: Uses the theme's navy background
   - **navy**: Dark navy section background
   - **white**: White background with dark text

4. **Responsive Design:**
   - All shortcodes are fully responsive
   - Content automatically adapts to mobile devices
   - Images scale appropriately on all screen sizes
