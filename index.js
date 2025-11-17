const navLinks = document.querySelectorAll('.nav-link');


window.addEventListener('resize', () => {
  if(window.innerWidth >= 992){
    document.querySelectorAll('.submenu.mobile').forEach(submenu => {
      submenu.classList.remove('mobile');
    });
    navLinks.forEach((item) => {
      item.setAttribute('style','color: var(--bs-white) !important;')
    })
    const navLinkBtns = document.querySelectorAll('.nav-link-btn');

      navLinkBtns.forEach(item => {
        item.classList.remove('btn', true);
        item.classList.remove('btn-primary', true);
        item.classList.remove('rounded-pill', true);
        item.classList.add('glass-btn', true);
      });
  }
  document.querySelectorAll('.submenu.desktop').forEach(submenu => {
    submenu.classList.remove('desktop');
  });


});


document.querySelectorAll('.submenu-parent').forEach(item => {
  console.log("query selector working")
  item.addEventListener('click', function(e) {
    if(window.innerWidth < 992){
      e.preventDefault();
      e.stopPropagation();
      const submenu = this.nextElementSibling;
      if (!submenu) return;
      submenu.classList.toggle('mobile');

      // Close other submenus
      document.querySelectorAll('.submenu.mobile').forEach(openSubmenu => {
        if (openSubmenu !== submenu) {
          openSubmenu.classList.remove('mobile');
        }
      });

    } else {
      e.preventDefault();
      e.stopPropagation();
      const submenu = this.nextElementSibling;
      if (!submenu) return;
      submenu.classList.toggle('desktop');

      // Close other submenus
      document.querySelectorAll('.submenu.desktop').forEach(openSubmenu => {
        if (openSubmenu !== submenu) {
          openSubmenu.classList.remove('desktop');
        }
      });
    }
  });

});

const navbarButton = document.querySelector('.navbar-toggler');
navbarButton.addEventListener('click',() => {
  console.log('clicked');
  const navbar = document.querySelector('.navbar');
  if(window.innerWidth < 992){
      navbarButton.classList.toggle('navbar-primary');
      navbar.classList.toggle('navbar-white');
      const navLinkBtns = document.querySelectorAll('.nav-link-btn');

      navLinkBtns.forEach(item => {
        item.classList.toggle('btn', true);
        item.classList.toggle('btn-primary', true);
        item.classList.toggle('rounded-pill', true);
        item.classList.toggle('glass-btn', true);
      });
      const img = document.getElementById('toggleImg');
      img.src =   img.src.includes('company_logo_white.svg') ? 'img/company_logo_primary.svg' : 'img/company_logo_white.svg'
      navLinks.forEach((item) => {
        item.removeAttribute('style')
      })
  }
})


// document.addEventListener("DOMContentLoaded", function () {

//     /* ------------------------------
//     1) TOGGLE MAIN "SERVICES" DROPDOWN
//     ------------------------------ */
//     const servicesTrigger = document.querySelector('.nav-item.dropdown');
//     const servicesMenu = document.querySelector('.nav-item.dropdown');

//     if (servicesTrigger) {
//         servicesTrigger.addEventListener("click", function (e) {
//             e.preventDefault();
//             e.stopPropagation();

//             servicesMenu.classList.toggle("open");

//             // Close all submenus when Services closes
//             if (!servicesMenu.classList.contains("open")) {
//                 document.querySelectorAll(".submenu").forEach(sub => sub.classList.remove("open"));
//             }

//             // Close other open dropdowns if any
//             document.querySelectorAll(".dropdown.open").forEach(menu => {
//                 if (menu !== servicesMenu) menu.classList.remove("open");
//             });
//         });
//     }


//     /* ------------------------------
//        2) TOGGLE SUBMENU WHEN CLICKING ARROW BUTTON
//     ------------------------------ */
//     document.querySelectorAll(".submenu-toggle").forEach(toggle => {

//         toggle.addEventListener("click", function (e) {
//             e.preventDefault();
//             e.stopPropagation();

//             const wrapper = this.closest(".submenu-wrapper");
//             const submenu = wrapper.querySelector(".submenu");

//             submenu.classList.toggle("open");

//             // Close other submenus
//             document.querySelectorAll(".submenu.open").forEach(other => {
//                 if (other !== submenu) other.classList.remove("open");
//             });
//         });

//     });


//     /* ------------------------------
//        3) CLOSE EVERYTHING WHEN CLICKING OUTSIDE
//     ------------------------------ */
//     document.addEventListener("click", function (e) {

//         if (!e.target.closest(".nav-item.dropdown")) {
//             servicesMenu.classList.remove("open");
//             document.querySelectorAll(".submenu").forEach(sub => sub.classList.remove("open"));
//         }

//     });

// });

/* Robust nav script (mobile + desktop, pointer-friendly)
   - Remove data-bs-toggle to prevent Bootstrap dropdown interference
   - Use pointerdown + click delegation so taps are handled reliably
*/
document.addEventListener("DOMContentLoaded", () => {
  const nav = document.querySelector(".navbar");

  // Remove Bootstrap toggle attributes to avoid interference
  document.querySelectorAll('.nav-item.dropdown > .nav-link[data-bs-toggle]')
    .forEach(el => el.removeAttribute('data-bs-toggle'));

  const servicesTrigger = document.querySelector('.nav-item.dropdown > .nav-link');
  const servicesMenu = document.querySelector('.nav-item.dropdown .dropdown-menu');

  function closeAll() {
    document.querySelectorAll('.dropdown-menu.open').forEach(m => m.classList.remove('open'));
    document.querySelectorAll('.submenu.open').forEach(s => s.classList.remove('open'));
    document.querySelectorAll('.submenu-toggle.open').forEach(t => t.classList.remove('open'));
    document.querySelectorAll('.nav-item.dropdown.open').forEach(d => d.classList.remove('open'));
  }

  function toggleServices(e) {
    e.preventDefault();
    e.stopPropagation();

    const willOpen = !servicesMenu.classList.contains('open');

    closeAll();

    servicesMenu.classList.toggle('open', willOpen);
    servicesTrigger.parentElement.classList.toggle('open', willOpen);
  }

  function onPointer(ev) {
    const target = ev.target;

    // submenu toggle click
    const toggleBtn = target.closest('.submenu-toggle');
    if (toggleBtn) {
      ev.preventDefault();
      ev.stopPropagation();

      const wrapper = toggleBtn.closest('.submenu-wrapper');
      const submenu = wrapper.querySelector('.submenu');
      const willOpen = !submenu.classList.contains('open');

      document.querySelectorAll('.submenu.open').forEach(s => {
        if (s !== submenu) s.classList.remove('open');
      });
      document.querySelectorAll('.submenu-toggle.open').forEach(t => {
        if (t !== toggleBtn) t.classList.remove('open');
      });

      submenu.classList.toggle('open', willOpen);
      toggleBtn.classList.toggle('open', willOpen);
      return;
    }

    // top-level dropdown (Services)
    const top = target.closest('.nav-item.dropdown > .nav-link');
    if (top) {
      toggleServices(ev);
      return;
    }
  }

  // FIX: use ONLY pointerdown for mobile
  nav.addEventListener('pointerdown', onPointer);

  // clicking outside closes everything
  document.addEventListener('pointerdown', (e) => {
    if (!e.target.closest('.navbar')) {
      closeAll();
    }
  });
});
document.addEventListener("DOMContentLoaded", function () {
    // Toggle SUBMENU when clicking the arrow button
    document.querySelectorAll(".submenu-toggle").forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.stopPropagation(); // prevent dropdown from closing
            const submenu = this.closest(".submenu-parent").nextElementSibling;
            submenu.classList.toggle("show");
        });
    });

    // Prevent submenu-parent <a> click from closing dropdown
    document.querySelectorAll(".submenu-parent > a").forEach(a => {
        a.addEventListener("click", function (e) {
            e.stopPropagation(); // keeps dropdown open
            // allow navigation — do NOT preventDefault()
        });
    });

    // Allow submenu links to navigate normally
    document.querySelectorAll(".submenu a").forEach(link => {
        link.addEventListener("click", function (e) {
            // do NOT stopPropagation
            // Bootstrap will close dropdown after navigation anyway
        });
    });

    // MOBILE FIX: Prevent parent dropdown from instantly closing
    document.querySelectorAll('.nav-item.dropdown .nav-link').forEach(link => {
        link.addEventListener("click", function (e) {
            const dropdown = this.parentElement;

            if (window.innerWidth < 992) {
                e.preventDefault(); // prevent bootstrap auto toggle
                dropdown.classList.toggle("show");
                dropdown.querySelector(".dropdown-menu").classList.toggle("show");
            }
        });
    });
});
