document.addEventListener('DOMContentLoaded', function() {
    var menuItems = document.querySelectorAll('.menu-item-has-children > a');
    
    menuItems.forEach(function(menuItem) {
        menuItem.addEventListener('click', function(e) {
            var submenu = this.nextElementSibling;
            
            if (submenu && submenu.classList.contains('sub-menu')) {
                e.preventDefault();
                
                if (submenu.style.display === 'block') {
                    submenu.style.display = 'none';
                } else {
                    submenu.style.display = 'block';
                }
            }
        });
    });
});
