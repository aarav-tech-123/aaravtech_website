

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





