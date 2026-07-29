document.addEventListener('DOMContentLoaded', () => {
    const searchBar = document.getElementById('search-bar');
    const dropdowns = document.querySelectorAll('.dropdown');

    searchBar.addEventListener('keyup', (e) => {
        const searchTerm = e.target.value.toLowerCase();

        dropdowns.forEach(dropdown => {
            const links = dropdown.querySelectorAll('.dropdown-content a');
            let hasVisibleLink = false;

            links.forEach(link => {
                const linkText = link.textContent.toLowerCase();
                if (linkText.includes(searchTerm)) {
                    link.style.display = 'block';
                    hasVisibleLink = true;
                } else {
                    link.style.display = 'none';
                }
            });

            const dropdownButton = dropdown.querySelector('.dropbtn');
            if(hasVisibleLink) {
                dropdown.style.display = 'inline-block';
            } else {
                dropdown.style.display = 'none';
            }
        });
    });
});
