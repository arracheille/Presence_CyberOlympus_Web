<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('.dropdown');
        function closeAllDropdowns() {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('clicked');
            });
        }
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('.link');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            const closeButton = dropdownMenu.querySelector('.close');
            link.addEventListener('click', function(event) {
                event.stopPropagation();
                closeAllDropdowns();
                dropdown.classList.toggle('clicked');
            });
            dropdownMenu.addEventListener('click', function(event) {
                event.stopPropagation();
            });
            closeButton.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdown.classList.remove('clicked');
            });
        });
        document.addEventListener('click', function() {
            closeAllDropdowns();
        });
    });
</script>
