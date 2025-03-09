document.addEventListener("DOMContentLoaded", function () {
    function showSearchResults(inputId, resultsId, buttonId) {
        const input = document.getElementById(inputId);
        const resultsBox = document.getElementById(resultsId);
        const searchButton = document.getElementById(buttonId); // Get the button explicitly

        // Auto-suggest functionality
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

        // Handle Enter key on input field
        input.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent default form submission
                processSearch(input.value);
            }
        });

        // Handle search button click
        if (searchButton) {
            searchButton.addEventListener("click", function(event) {
                event.preventDefault();
                processSearch(input.value);
            });
        }

        // Hide results when clicking outside
        document.addEventListener("click", function (event) {
            if (!input.contains(event.target) && !resultsBox.contains(event.target)) {
                resultsBox.style.display = "none";
            }
        });
    }

    // Function to process search query
    function processSearch(query) {
        query = query.trim();
        if (query === "") {
            window.location.href = "/emma_auto_online/";
        } else {
            window.location.href = "/emma_auto_online/pages/store?pname=" + encodeURIComponent(query);
        }
    }

    // Initialize search functionality for both desktop and mobile
    showSearchResults("desktopSearch", "desktopResults", "desktopSearchButton");
    showSearchResults("mobileSearch", "mobileResults", "mobileSearchButton");
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