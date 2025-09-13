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

  // Load More Events AJAX functionality
  var loadMoreButton = document.getElementById('load-more-events');
  if (loadMoreButton) {
    loadMoreButton.addEventListener('click', function() {
      var currentPage = parseInt(this.getAttribute('data-page'));
      var maxPages = parseInt(this.getAttribute('data-max-pages'));
      var buttonText = this.querySelector('.button-text');
      var loadingText = this.querySelector('.loading-text');
      
      if (currentPage >= maxPages) {
        this.style.display = 'none';
        return;
      }
      
      // Show loading state
      this.disabled = true;
      buttonText.classList.add('hidden');
      loadingText.classList.remove('hidden');
      
      // Make AJAX request
      var xhr = new XMLHttpRequest();
      xhr.open('POST', (typeof ajax_object !== 'undefined' ? ajax_object.ajax_url : '/wp-admin/admin-ajax.php'), true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              // Append new events to the grid
              var eventsGrid = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3.gap-6');
              if (eventsGrid) {
                eventsGrid.insertAdjacentHTML('beforeend', response.data.html);
              }
              
              // Update page number
              currentPage++;
              loadMoreButton.setAttribute('data-page', currentPage);
              
              // Hide button if no more pages
              if (currentPage >= maxPages) {
                loadMoreButton.style.display = 'none';
              }
            } else {
              console.error('Error loading events:', response.data);
            }
          } else {
            console.error('AJAX request failed');
          }
          
          // Reset button state
          loadMoreButton.disabled = false;
          buttonText.classList.remove('hidden');
          loadingText.classList.add('hidden');
        }
      };
      
      var nonce = (typeof ajax_object !== 'undefined' ? ajax_object.ajax_nonce : '');
      xhr.send('action=load_more_events&page=' + (currentPage + 1) + '&nonce=' + nonce);
    });
  }
});
