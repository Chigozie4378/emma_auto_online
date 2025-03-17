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
        input.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent default form submission
                processSearch(input.value);
            }
        });

        // Handle search button click
        if (searchButton) {
            searchButton.addEventListener("click", function (event) {
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
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
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


// Search Filter
$(document).ready(function () {
    // Initialize the Bootstrap modal instance
    var filterModal = new bootstrap.Modal(document.getElementById('filterModal'));

    // Open the modal when either filter button is clicked
    $("#desktopFilterButton, #mobileFilterButton").on("click", function () {
        filterModal.show();
    });
});


$(document).ready(function () {
    // Initialize Chosen on the select boxes
    $(".chosen").chosen({ width: "100%" });

    // When a product is selected, fetch related models
    $("#productSelect").on("change", function () {
        var productName = $(this).val();
        if (productName !== "") {
            var ajaxUrl = window.location.href.includes("/pages")
                ? "../ajax/products/model"
                : "./ajax/products/model";
            $.ajax({
                url: ajaxUrl,
                method: "POST",
                data: { product_name: productName },
                success: function (data) {
                    // Populate modelSelect with returned <option> tags
                    $("#modelSelect").html(data).trigger("chosen:updated");
                    // Reset brandSelect
                    $("#brandSelect")
                        .html('<option value="">Select a Brand</option>')
                        .trigger("chosen:updated");
                }
            });
        } else {
            // Reset if no product selected
            $("#modelSelect").html('<option value="">Select a Model</option>').trigger("chosen:updated");
            $("#brandSelect").html('<option value="">Select a Brand</option>').trigger("chosen:updated");
        }
    });

    // When a model is selected, fetch related manufacturers/brands
    $("#modelSelect").on("change", function () {
        var model = $(this).val();
        var productName = $("#productSelect").val();
        if (model !== "") {
            var ajaxUrl = window.location.href.includes("/pages")
                ? "../ajax/products/brand"
                : "./ajax/products/brand";
            $.ajax({
                url: ajaxUrl,
                method: "POST",
                data: { model: model, product_name: productName },
                success: function (data) {
                    $("#brandSelect").html(data).trigger("chosen:updated");
                }
            });
        } else {
            $("#brandSelect").html('<option value="">Select a Brand</option>').trigger("chosen:updated");
        }
    });

    // When the Search button is clicked, aggregate the selected values and redirect
    $("#filterSearchBtn").on("click", function () {
        var productVal = $("#productSelect").val() || "";
        var modelVal = $("#modelSelect").val() || "";
        var brandVal = $("#brandSelect").val() || "";
        var queryString = "?product=" + encodeURIComponent(productVal) +
            "&model=" + encodeURIComponent(modelVal) +
            "&manufacturer=" + encodeURIComponent(brandVal);
        window.location.href = "/emma_auto_online/pages/filter" + queryString;
    });
});


$('#filterModal').on('hidden.bs.modal', function () {
    $('.modal-backdrop').remove();
});


// navbar

document.addEventListener("DOMContentLoaded", function () {
    var navbarHeight = document.querySelector(".main-nav").offsetHeight;
    document.body.style.paddingTop = navbarHeight + "px";
});






document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const mobileSearchContainer = document.querySelector(".mobile-search-container");
    const mobileNavbar = document.getElementById("mobileNavbar");

    navbarToggler.addEventListener("click", function () {
        setTimeout(() => {
            if (mobileNavbar.classList.contains("show")) {
                mobileSearchContainer.style.marginTop = "80px"; // Push down when expanded
            } else {
                mobileSearchContainer.style.marginTop = "0"; // Reset margin when collapsed
            }
        }, 300); // Small delay to allow animation to complete
    });
});




