// Mobile menu functionality
function initMobileMenu() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileNavigation = document.getElementById('mobile-navigation');
    const menuIcon = mobileMenuButton.querySelector('svg');

    if (mobileMenuButton && mobileNavigation) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = mobileNavigation.classList.contains('hidden');
            
            // Toggle menu visibility
            mobileNavigation.classList.toggle('hidden');
            
            // Update aria-expanded
            this.setAttribute('aria-expanded', !isExpanded);
        });
    }
}

// Mobile submenu functionality
function initMobileSubmenu() {
    const menuItemsWithChildren = document.querySelectorAll('.mobile-navigation .menu-item-has-children');
    
    menuItemsWithChildren.forEach(item => {
        const link = item.querySelector('a');
        const submenu = item.querySelector('.sub-menu');
        
        // Add dropdown indicator
        if (link && !link.querySelector('.dropdown-icon')) {
            const dropdownIcon = document.createElement('span');
            dropdownIcon.className = 'dropdown-icon ml-2';
            dropdownIcon.innerHTML = '▼';
            link.appendChild(dropdownIcon);
        }
        
        if (link && submenu) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Toggle open class
                item.classList.toggle('open');
                
                // Toggle submenu visibility
                if (item.classList.contains('open')) {
                    submenu.style.display = 'block';
                    link.querySelector('.dropdown-icon').style.transform = 'rotate(180deg)';
                } else {
                    submenu.style.display = 'none';
                    link.querySelector('.dropdown-icon').style.transform = 'rotate(0)';
                }
            });
        }
    });
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initMobileMenu();
    initMobileSubmenu();
});