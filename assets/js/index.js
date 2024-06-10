document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggle = document.getElementById('dropdown-toggle');
    var dropdownMenu = document.getElementById('dropdown-menu');
    var menuIcon = dropdownToggle.querySelector('[data-icon="mdi:menu"]');
    var closeIcon = dropdownToggle.querySelector('[data-icon="ic:baseline-close"]');

    dropdownToggle.addEventListener('click', function(event) {
        event.preventDefault();
        if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
            menuIcon.style.display = 'inline-block';
            closeIcon.style.display = 'none';
        } else {
            dropdownMenu.style.display = 'block';
            menuIcon.style.display = 'none';
            closeIcon.style.display = 'inline-block';
        }
    });
});
