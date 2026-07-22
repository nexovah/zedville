$('.togglePsw').click(function(){
    $(this).toggleClass('active');
    var input = $(this).parent('.pswtoggle').find('input');
    if (input.attr('type') == 'password') {
        input.attr('type', 'text');
    } else {
        input.attr('type', 'password');
    }
});

document.querySelectorAll('.accordion-toggle').forEach(button => {
    button.addEventListener('click', () => {
        const content = button.nextElementSibling;
        this.$refs.menu.classList.toggle('open');
        content.classList.toggle('open');
    });
});


// Admin Script
const setup = () => {
  function getSidebarStateFromLocalStorage() {
    // if it already there, use it
    if (window.localStorage.getItem('isSidebarOpen')) {
      return JSON.parse(window.localStorage.getItem('isSidebarOpen'))
    }

    // else return the initial state you want
    return (
     false
    )
  }

  function setSidebarStateToLocalStorage(value) {
    window.localStorage.setItem('isSidebarOpen', value)
  }

return {
      loading: true,
      isSidebarOpen: getSidebarStateFromLocalStorage(),
      toggleSidbarMenu() {
        this.isSidebarOpen = !this.isSidebarOpen
        setSidebarStateToLocalStorage(this.isSidebarOpen)
      },
      isSettingsPanelOpen: false,
      isSearchBoxOpen: false,
  }
}

// Page loader: show while navigating away from a sidebar menu link,
// fade out once the destination page has fully loaded.
(function () {
  function hidePageLoader() {
    var loader = document.getElementById('pageLoader');
    if (!loader) return;
    loader.classList.add('opacity-0');
    loader.classList.remove('opacity-100');
    window.setTimeout(function () {
      loader.classList.add('hidden');
    }, 300);
  }

  function showPageLoader() {
    var loader = document.getElementById('pageLoader');
    if (!loader) return;
    loader.classList.remove('hidden');
    // force reflow so the opacity transition replays on repeated clicks
    void loader.offsetWidth;
    loader.classList.remove('opacity-0');
    loader.classList.add('opacity-100');
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sidenav a[href]').forEach(function (link) {
      link.addEventListener('click', function () {
        var href = link.getAttribute('href');
        if (!href || href === '#' || href.indexOf('javascript:') === 0 || link.target === '_blank') {
          return;
        }
        showPageLoader();
      });
    });
  });

  window.addEventListener('load', hidePageLoader);

  // restored from bfcache (browser back/forward) - loader must not stay stuck
  window.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      hidePageLoader();
    }
  });
})();

// Tooltip Script

document.querySelectorAll('[data-tooltip]').forEach(el => {
  const text = el.getAttribute('data-tooltip');
  const placement = el.getAttribute('data-tooltip-placement') || 'top';

  const tooltip = document.createElement('div');
  tooltip.className = `
    fixed z-50 px-2 py-1 text-sm text-white bg-gray-900 rounded shadow-md 
    opacity-0 pointer-events-none transition-opacity duration-200 whitespace-nowrap
  `;
  tooltip.textContent = text;

  // Add arrow
  const arrow = document.createElement('div');
  arrow.className = 'tooltip-arrow';
  tooltip.appendChild(arrow);

  document.body.appendChild(tooltip); // Append outside clipping

  const showTooltip = () => {
    // Sidebar menu tooltips should only appear when the menu is collapsed
    // (i.e. its text label is hidden) - skip them while the sidebar is open.
    const sidebarLabel = el.querySelector('.sidebarLabel');
    if (sidebarLabel && sidebarLabel.offsetWidth > 0) {
      return;
    }

    tooltip.style.opacity = 1;

    // Clear old arrow direction classes
    arrow.classList.remove('tooltip-arrow-top', 'tooltip-arrow-bottom', 'tooltip-arrow-left', 'tooltip-arrow-right');

    const rect = el.getBoundingClientRect();
    const tooltipRect = tooltip.getBoundingClientRect();

    let top = 0, left = 0;

    switch (placement) {
      case 'top':
        top = rect.top - tooltipRect.height - 10;
        left = rect.left + rect.width / 2 - tooltipRect.width / 2;
        arrow.classList.add('tooltip-arrow-top');
        break;
      case 'bottom':
        top = rect.bottom + 10;
        left = rect.left + rect.width / 2 - tooltipRect.width / 2;
        arrow.classList.add('tooltip-arrow-bottom');
        break;
      case 'left':
        top = rect.top + rect.height / 2 - tooltipRect.height / 2;
        left = rect.left - tooltipRect.width - 10;
        arrow.classList.add('tooltip-arrow-left');
        break;
      case 'right':
        top = rect.top + rect.height / 2 - tooltipRect.height / 2;
        left = rect.right + 10;
        arrow.classList.add('tooltip-arrow-right');
        break;
    }

    tooltip.style.top = `${top}px`;
    tooltip.style.left = `${left}px`;
  };

  const hideTooltip = () => {
    tooltip.style.opacity = 0;
  };

  el.addEventListener('mouseenter', showTooltip);
  el.addEventListener('mouseleave', hideTooltip);
});


// Tab & Accordion Script
document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll('.tab-button');
  const tabContents = document.querySelectorAll('.tab-content');

  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const tabId = button.getAttribute('data-tab');

      // Remove active class from all buttons
      tabButtons.forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('inactive');
      });

      // Hide all content
      tabContents.forEach(content => content.classList.add('hidden'));

      // Show current tab content
      document.getElementById(tabId).classList.remove('hidden');

      // Add active class to clicked button
      button.classList.add('active');
      button.classList.remove('inactive');
    });
  });

  if (tabButtons.length) {
    tabButtons[0].click();
  }
});

// Dropdown Script
  document.addEventListener("DOMContentLoaded", () => {
    const dropdownToggles = document.querySelectorAll("[data-dropdown-toggle]");

    dropdownToggles.forEach(toggle => {
      const dropdownId = toggle.getAttribute("data-dropdown-toggle");
      const dropdown = document.getElementById(dropdownId);

      if (!dropdown) return;

      // Toggle dropdown on button click
      toggle.addEventListener("click", (e) => {
        e.stopPropagation(); // prevent click from bubbling
        // Close others
        document.querySelectorAll("[id^='dropdown']").forEach(d => {
          if (d !== dropdown) d.classList.add("hidden");
        });
        // Toggle current
        dropdown.classList.toggle("hidden");
      });

      // Close dropdown on outside click
      document.addEventListener("click", (event) => {
        if (!dropdown.contains(event.target) && !toggle.contains(event.target)) {
          dropdown.classList.add("hidden");
        }
      });
    });
  });

  // Price Show Hide

$('.priceValueshowHide').on('click', function () {
  $(this).toggleClass('active');              // toggle class on button
  $(this).parent('.priceValueSe').toggleClass('active');  // toggle class on parent
});

// Card Value Show hide
$('#cardshowHidebtn').on('click', function () {
  $(this).toggleClass('active');              // toggle class on button
  $('.cardNoSec, .cardCVVSection').toggleClass('active');  // toggle class on parent
});

// Transfer Section Dropdown div show hide

$(document).ready(function(){
    $('#transferSchedule').on('change', function(){
      var value = $(this).val();
      if(value === 'once'){
        $('#onetimmeDate').show();
        $('#recurringDate').hide();
      } else if(value === 'weekly' || value === 'monthly' || value === 'quarterly'){
        $('#recurringDate').show();
        $('#onetimmeDate').hide();
      } else {
        $('#onetimmeDate, #recurringDate').hide();
      }
    });
  });
  //  Add new transfer Details Section
$('#addnewtransferBtn').on('click', function () {
  $('#addNewTransfer').removeClass('hidden');
});
$('#cancelBaneficary').on('click', function () {
  $('#addNewTransfer').addClass('hidden');
});