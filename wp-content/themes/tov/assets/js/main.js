document.addEventListener('DOMContentLoaded', function() {
  var mobileMenuButton = document.getElementById('mobile-menu-button');
  var mobileNavigation = document.getElementById('mobile-navigation');

  function setIcon(isOpen) {
    var svg = mobileMenuButton ? mobileMenuButton.querySelector('svg') : null;
    if (!svg) return;
    if (isOpen) {
      svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
    } else {
      svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
    }
  }

  if (mobileMenuButton && mobileNavigation) {
    mobileMenuButton.addEventListener('click', function() {
      var expanded = this.getAttribute('aria-expanded') === 'true';
      var next = !expanded;
      this.setAttribute('aria-expanded', String(next));
      mobileNavigation.classList.toggle('hidden', !next);
      setIcon(next);
    });

    // Toggle submenus on click in mobile nav
    mobileNavigation.addEventListener('click', function(e) {
      var toggle = e.target.closest('.menu-item-has-children > a');
      if (toggle) {
        // Only in mobile view
        if (window.matchMedia('(max-width: 1023.98px)').matches) {
          var parentLi = toggle.closest('li');
          if (parentLi) {
            e.preventDefault();
            parentLi.classList.toggle('submenu-open');
          }
        }
      }
    });

    // Close when clicking outside
    document.addEventListener('click', function(e) {
      var isClickInside = (mobileNavigation && mobileNavigation.contains(e.target)) || (mobileMenuButton && mobileMenuButton.contains(e.target));
      if (!isClickInside && mobileNavigation && !mobileNavigation.classList.contains('hidden')) {
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        mobileNavigation.classList.add('hidden');
        setIcon(false);
      }
    });

    // Close on Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && mobileNavigation && !mobileNavigation.classList.contains('hidden')) {
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        mobileNavigation.classList.add('hidden');
        setIcon(false);
      }
    });
  }
});
