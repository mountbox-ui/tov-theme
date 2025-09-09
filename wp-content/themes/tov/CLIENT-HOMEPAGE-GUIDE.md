# Homepage Editing Guide for Clients

## Quick Start

Your homepage uses special "shortcodes" that make it easy to edit content without touching any code. Simply copy and paste the examples below into your WordPress page editor and customize the text and images.

## 🎯 Step-by-Step Instructions

### 1. Access Your Homepage
1. Log into your WordPress admin
2. Go to **Pages** → **All Pages**
3. Find your homepage (usually called "Home" or "Front Page")
4. Click **Edit**

### 2. Replace Content
1. Delete the existing content in the editor
2. Copy the template content from `homepage-content-template.txt`
3. Paste it into your page editor
4. Customize the content (see instructions below)
5. Click **Update**

## 🎨 Customization Options

### Hero Slider Section
```
[welcome_slider slides='[...]' height="600px" autoplay="true" duration="5000"]
```

**What you can change:**
- **Images**: Replace URLs with your own photos
- **Titles**: Main headlines for each slide
- **Subtitles**: Supporting text under titles  
- **Buttons**: Text and where they link to
- **Height**: Make slider taller or shorter
- **Duration**: How long each slide shows (in milliseconds)

### Image + Text Sections
```
[image_section image="..." title="..." content="..." button_text="..." button_url="..." position="left" background="transparent"]
```

**What you can change:**
- **Image**: Your company photos
- **Title**: Section headline
- **Content**: Descriptive text (keep to 30-50 words)
- **Button**: Call-to-action text and link
- **Position**: "left" or "right" (where image appears)
- **Background**: "transparent", "navy", or "white"

### Text-Only Sections
```
[text_section title="..." content="..." align="center" background="white" button_text="..." button_url="..."]
```

**What you can change:**
- **Title**: Section headline
- **Content**: Your message
- **Align**: "left", "center", or "right"
- **Background**: "transparent", "navy", or "white"
- **Button**: Optional call-to-action

## 📸 Image Guidelines

### Best Practices
- **Size**: Minimum 1200px wide
- **File Size**: Under 500KB each
- **Quality**: High-resolution, professional photos
- **Format**: JPG or PNG

### Recommended Dimensions
- **Slider images**: 1920x600px
- **Section images**: 800x600px

### Free Stock Photos
- [Unsplash](https://unsplash.com) - Free high-quality photos
- [Pexels](https://pexels.com) - Free stock photography
- [Pixabay](https://pixabay.com) - Free images and graphics

## 📝 Content Writing Tips

### Headlines (Titles)
- Keep short: 5-10 words maximum
- Make them action-oriented
- Focus on benefits to customers

### Body Text (Content)
- Aim for 30-50 words per section
- Write in active voice
- Focus on what you do for customers
- Avoid jargon and technical terms

### Button Text
- Use action words: "Get Started", "Learn More", "Contact Us"
- Keep it short: 1-3 words
- Make it clear what happens when clicked

## 🎨 Background Options

### Transparent (Default)
- Uses your theme's navy background
- White text automatically applied
- Good for most content

### Navy Background
```
background="navy"
```
- Dark blue section background
- White text for contrast
- Great for highlighting important sections

### White Background
```
background="white"
```
- Clean white background
- Dark text for readability
- Perfect for call-to-action sections

## 🔧 Common Tasks

### Adding a New Section
1. Copy one of the existing shortcodes
2. Paste it where you want the new section
3. Update the content, image, and settings
4. Save the page

### Changing Image Position
- Use `position="left"` to put image on the left
- Use `position="right"` to put image on the right

### Removing a Section
- Simply delete the entire shortcode from the editor

### Changing Colors
- Use `background="navy"` for dark sections
- Use `background="white"` for light sections  
- Use `background="transparent"` for default theme background

## ❓ Need Help?

If you need assistance:
1. Refer to the `SHORTCODES.md` file for detailed technical documentation
2. Contact your web developer
3. The shortcodes are designed to be forgiving - if something doesn't work, check for missing quotes or brackets

## 🚀 Going Live

After making changes:
1. Click **Preview** to see how it looks
2. Test on mobile devices
3. Click **Update** when you're happy with the results
4. Clear any caching plugins you might have

---

**Remember**: You can always go back to previous versions using WordPress's revision history if you need to undo changes!
