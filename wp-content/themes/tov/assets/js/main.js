document.addEventListener('DOMContentLoaded', function() {
  // Hero video modal (background keeps looping; modal plays on demand)
  const heroTrigger = document.getElementById('hero-video-trigger');
  const heroOverlay = document.getElementById('hero-video-overlay');
  const heroClose   = document.getElementById('hero-video-close');
  const heroIframe  = document.getElementById('hero-video-iframe');
  const heroSection = document.getElementById('support-center');

  function closeHeroVideo() {
    if (heroOverlay) heroOverlay.classList.add('hidden');
    if (heroIframe) heroIframe.src = '';
  }

  if (heroTrigger && heroOverlay && heroIframe && heroSection) {
    heroTrigger.addEventListener('click', function(e) {
      e.preventDefault();
      const vid = heroSection.getAttribute('data-video-id');
      if (!vid) return;
      const url = 'https://www.youtube.com/embed/' + vid + '?autoplay=1&mute=0&controls=1&playsinline=1&rel=0&modestbranding=1';
      heroIframe.src = url;
      heroOverlay.classList.remove('hidden');
    });
  }

  if (heroClose) {
    heroClose.addEventListener('click', closeHeroVideo);
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeHeroVideo();
  });
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

  // Load More News AJAX functionality
  var loadMoreNewsButton = document.getElementById('load-more-news');
  if (loadMoreNewsButton) {
    loadMoreNewsButton.addEventListener('click', function() {
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
              // Append new news to the grid
              var newsGrid = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3.gap-6');
              if (newsGrid) {
                newsGrid.insertAdjacentHTML('beforeend', response.data.html);
              }
              
              // Update page number
              currentPage++;
              loadMoreNewsButton.setAttribute('data-page', currentPage);
              
              // Hide button if no more pages
              if (currentPage >= maxPages) {
                loadMoreNewsButton.style.display = 'none';
              }
            } else {
              console.error('Error loading news:', response.data);
            }
          } else {
            console.error('AJAX request failed');
          }
          
          // Reset button state
          loadMoreNewsButton.disabled = false;
          buttonText.classList.remove('hidden');
          loadingText.classList.add('hidden');
        }
      };
      
      var nonce = (typeof ajax_object !== 'undefined' ? ajax_object.ajax_nonce : '');
      xhr.send('action=load_more_news&page=' + (currentPage + 1) + '&nonce=' + nonce);
    });
  }

  // Load More Blog AJAX functionality
  var loadMoreBlogButton = document.getElementById('load-more-blog');
  if (loadMoreBlogButton) {
    loadMoreBlogButton.addEventListener('click', function() {
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
              // Append new blog posts to the grid
              var blogGrid = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3.gap-6');
              if (blogGrid) {
                blogGrid.insertAdjacentHTML('beforeend', response.data.html);
              }
              
              // Update page number
              currentPage++;
              loadMoreBlogButton.setAttribute('data-page', currentPage);
              
              // Hide button if no more pages
              if (currentPage >= maxPages) {
                loadMoreBlogButton.style.display = 'none';
              }
            } else {
              console.error('Error loading blog posts:', response.data);
            }
          } else {
            console.error('AJAX request failed');
          }
          
          // Reset button state
          loadMoreBlogButton.disabled = false;
          buttonText.classList.remove('hidden');
          loadingText.classList.add('hidden');
        }
      };
      
      var nonce = (typeof ajax_object !== 'undefined' ? ajax_object.ajax_nonce : '');
      xhr.send('action=load_more_blog&page=' + (currentPage + 1) + '&nonce=' + nonce);
    });
  }
});


document.addEventListener("scroll", function () {
  const header = document.getElementById("masthead");
  if (!header) return;

  const isHomePage = document.body.classList.contains('home') || document.body.classList.contains('front-page');

  if (isHomePage) {
    if (window.scrollY > 10) {
      header.classList.add('header-solid');
      header.classList.remove('bg-transparent');
    } else {
      header.classList.remove('header-solid');
      header.classList.add('bg-transparent');
    }
  } else {
    // Non-home: ensure solid header
    header.classList.add('header-solid');
    header.classList.remove('bg-transparent');
  }
});