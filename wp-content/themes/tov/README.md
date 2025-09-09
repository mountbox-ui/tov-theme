# Tov WordPress Theme

A modern, responsive WordPress theme built with Tailwind CSS.

## Features

- 🎨 **Modern Design**: Clean, professional design with Tailwind CSS
- 📱 **Fully Responsive**: Optimized for all devices and screen sizes
- ⚡ **Fast Performance**: Lightweight and optimized for speed
- ♿ **Accessible**: Built with accessibility best practices
- 🔍 **SEO Friendly**: Semantic HTML and proper meta tags
- 🎯 **Customizable**: Easy to customize colors, fonts, and layouts
- 📝 **Blog Ready**: Full blog functionality with comments support
- 🔧 **Developer Friendly**: Clean, well-documented code

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Node.js and npm (for development)

## Installation

1. Download or clone this repository
2. Upload the theme folder to your WordPress `/wp-content/themes/` directory
3. Install dependencies: `npm install`
4. Build the CSS: `npm run build`
5. Activate the theme in your WordPress admin panel

## Development

### Building CSS

To build the Tailwind CSS for production:
```bash
npm run build
```

To watch for changes during development:
```bash
npm run dev
```

### File Structure

```
tov-theme/
├── assets/
│   ├── css/
│   │   └── style.css (generated)
│   └── js/
│       └── main.js
├── inc/
├── src/
│   └── style.css (Tailwind source)
├── template-parts/
│   ├── content-none.php
│   ├── pagination.php
│   └── post-navigation.php
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── search.php
├── searchform.php
├── sidebar.php
├── single.php
├── style.css (WordPress required)
├── package.json
└── tailwind.config.js
```

## Customization

### Colors

The theme uses a custom color palette defined in `tailwind.config.js`. You can customize the primary colors by modifying the `colors.primary` section.

### Typography

The theme uses Inter for sans-serif text and Merriweather for serif text. You can change these fonts in `tailwind.config.js` and update the Google Fonts link in `header.php`.

### Layout

The theme includes several layout options:
- Full-width pages
- Sidebar layouts
- Grid-based post layouts
- Responsive navigation

## Theme Support

This theme includes support for:
- Custom logo
- Featured images
- Custom menus
- Widgets
- Comments
- Post thumbnails
- HTML5 markup
- Responsive embeds

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This theme is licensed under the GPL v2 or later.

## Credits

- Built with [Tailwind CSS](https://tailwindcss.com/)
- Icons from [Heroicons](https://heroicons.com/)
- Fonts from [Google Fonts](https://fonts.google.com/)

## Support

For support and documentation, please visit the theme repository or contact the developer.
