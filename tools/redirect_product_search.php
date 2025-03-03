<script>
  function redirectToProduct() {
    // Redirect to the desired page (products.php)
    window.location.href = './pages/products.php';

    // Use the onload event to autofocus on the product_name id after the page loads
    window.onload = function() {
      document.getElementById('product_name').focus();
    };
  }
</script>