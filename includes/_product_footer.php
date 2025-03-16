    <!-- Bootstrap JS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/chosen/chosen.js"></script>
    <script src="../assets/js/navbar.js"></script>

    <script>
        // Open the custom image frame with the clicked image source
        function openImageFrame(imageSrc) {
            document.getElementById("frameImg").src = imageSrc;
            document.getElementById("imageFrame").style.display = "block";
        }

        // Close the image frame
        function closeImageFrame() {
            document.getElementById("imageFrame").style.display = "none";
        }

        // Optional: Close the image frame if the user clicks outside the image content
        document.getElementById("imageFrame").onclick = function (event) {
            if (event.target == this) {
                closeImageFrame();
            }
        }

        // Function to add product to cart

        function addToCart(productId) {
            let quantityInput = document.getElementById(`quantity_${productId}`);
            let quantity = quantityInput.value.trim();

            if (!quantity || quantity <= 0) {
                alert("Please enter a valid quantity.");
                return;
            }

            fetch('../tools/cart_session', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=add&product_id=${productId}&quantity=${quantity}`
            }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        quantityInput.value = ""; 
                        updateCartCount(); //

                        // Hide "Add to Cart" and show "See in Cart"
                        document.getElementById(`add-cart-btn-${productId}`).classList.add("d-none");
                        document.getElementById(`see-cart-btn-${productId}`).classList.remove("d-none");
                    } else {
                        alert("Error adding to cart.");
                    }
                }).catch(error => console.error("Fetch error:", error));
        }



        function updateCartCount() {
            fetch('../tools/cart_session', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=count'
            })
                .then(response => response.json())
                .then(data => {
                    let cartCountElements = document.querySelectorAll(".cart-count");
                    cartCountElements.forEach(el => el.innerText = data.cart_count);
                })
                .catch(error => console.error("Error updating cart count:", error));
        }



    </script>
</body>

</html>