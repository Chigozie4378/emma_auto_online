
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".collapse .list-unstyled a, .dropdown-menu .dropdown-item, .navbar-nav .nav-link")
        .forEach(el => el.style.textDecoration = "none");
});



document.addEventListener("DOMContentLoaded", function () {
    function showSearchResults(inputId, resultsId) {
        const input = document.getElementById(inputId);
        const resultsBox = document.getElementById(resultsId);

        input.addEventListener("input", function () {
            let query = this.value.trim();
            if (query.length === 0) {
                resultsBox.style.display = "none";
                return;
            }

            // Fetch search results from PHP
            fetch(`../ajax/products/fetch_search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        resultsBox.innerHTML = data.map(item =>
                            `<a href="store?pname=${item.product_name}">${item.product_name}</a>`
                        ).join("");
                        resultsBox.style.display = "block";
                    } else {
                        resultsBox.style.display = "none";
                    }
                })
                .catch(error => console.error("Error fetching search results:", error));

        });

        // Hide results when clicking outside
        document.addEventListener("click", function (event) {
            if (!input.contains(event.target) && !resultsBox.contains(event.target)) {
                resultsBox.style.display = "none";
            }
        });
    }

    showSearchResults("desktopSearch", "desktopResults");
    showSearchResults("mobileSearch", "mobileResults");
});


document.addEventListener('DOMContentLoaded', function () {
    // Select the header cart icon in the mobile nav.
    var menuCart = document.querySelector('.main-nav.d-lg-none a.text-dark.position-relative');
    var floatingCart = document.querySelector('.floating-cart');
  
    if (!menuCart || !floatingCart) return;
  
    // Create an Intersection Observer to check if the header cart is visible.
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          // Header cart is visible, so hide the floating cart.
          floatingCart.style.display = 'none';
        } else {
          // Header cart is not visible, so show the floating cart.
          floatingCart.style.display = 'block';
        }
      });
    }, { threshold: 0 });
  
    observer.observe(menuCart);
  });

