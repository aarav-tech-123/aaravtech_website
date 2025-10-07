

window.addEventListener('resize', () => {
  if(window.innerWidth >= 992){
    document.querySelectorAll('.submenu.mobile').forEach(submenu => {
      submenu.classList.remove('mobile');
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

  }
})



