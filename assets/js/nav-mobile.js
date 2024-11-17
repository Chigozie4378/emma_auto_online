function toggleSidebar() {
    const sidebar = document.getElementById("mobileSidebar");
    sidebar.style.display = sidebar.style.display === "none" || sidebar.style.display === "" ? "flex" : "none";
}


document.addEventListener('DOMContentLoaded', function () {
    // Function to clear all active states
    function clearActiveStates() {
        document.querySelectorAll('.nav-link.active, .mega-menu a.active').forEach(function (link) {
            link.classList.remove('active');
        });
    }

    // Function to set active state across all corresponding elements
    function setActive(category, subcategory) {
        // Set active state on mega menu links
        document.querySelectorAll('.mega-menu a').forEach(function (link) {
            if (link.textContent.trim() === subcategory) {
                link.classList.add('active');
            }
        });

        // Set active state on desktop sidebar links
        document.querySelectorAll('#categoryAccordion .nav-link').forEach(function (link) {
            if (link.textContent.trim() === subcategory) {
                link.classList.add('active');
            }
        });

        // Set active state on mobile sidebar links
        document.querySelectorAll('#mobileSidebar a').forEach(function (link) {
            if (link.textContent.trim() === subcategory) {
                link.classList.add('active');
            }
        });
    }

    // Event listeners for mega menu
    document.querySelectorAll('.mega-menu a').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            clearActiveStates();
            setActive(e.target.closest('.dropdown-item').querySelector('a').textContent.trim(), e.target.textContent.trim());
        });
    });

    // Event listeners for desktop sidebar
    document.querySelectorAll('#categoryAccordion .nav-link').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            clearActiveStates();
            setActive(e.target.closest('.accordion-item').querySelector('.accordion-button').textContent.trim(), e.target.textContent.trim());
        });
    });

    // Event listeners for mobile sidebar
    document.querySelectorAll('#mobileSidebar a').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            clearActiveStates();
            setActive(e.target.closest('div').previousElementSibling.textContent.trim(), e.target.textContent.trim());
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const categoryToggles = document.querySelectorAll('.category-toggle');

    categoryToggles.forEach(toggle => {
        const arrowIcon = toggle.querySelector('.arrow');

        toggle.addEventListener('click', () => {
            // Toggle arrow direction
            arrowIcon.classList.toggle('fa-chevron-up');
            arrowIcon.classList.toggle('fa-chevron-down');
        });
    });
});
