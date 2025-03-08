<?php
include "../autoload/loader.php";
$ctr = new ProductsController();
$products = $ctr->productName();
$totalProducts = $products->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emma Auto Multi Company</title>
  <!-- Bootstrap CSS (for grid and other styles) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Amazon Ember', Arial, sans-serif;
    }
    .product-card {
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
      text-align: center;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .product-card:hover {
      transform: scale(1.05);
    }
    .product-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      cursor: pointer;
    }
    .product-info {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding-top: 5px;
      width: 100%;
    }
    .product-name {
      font-size: 15px;
      color: #333;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 600;
    }
    .product-details {
      font-size: 12px;
      color: #333;
      width: 100%;
      padding: 2px 10px;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 500;
    }
    .quantity-input {
      width: 60px;
      text-align: center;
      border: 1px solid #ccc;
      padding: 5px;
      border-radius: 5px;
      margin-top: 5px;
    }
    .btn-add-cart {
      background-color: #375bf7;
      color: white;
      width: 100%;
      padding: 8px;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      margin-top: 5px;
    }
    .btn-add-cart:hover {
      background-color: #003366;
    }
    /* Custom overlay styling for the enlarged image */
    .image-frame {
      display: none; /* Hidden by default */
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.8);
      animation: fadeIn 0.5s;
    }
    .frame-content {
      margin: auto;
      display: block;
      max-width: 90%;
      max-height: 80%;
      margin-top: 5%;
      border-radius: 8px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    }
    .close {
      position: absolute;
      top: 20px;
      right: 35px;
      color: #fff;
      font-size: 40px;
      font-weight: bold;
      cursor: pointer;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>
  <?php include "../includes/_navbar.php"; ?>

  <div class="container mt-4">
    <h2 class="text-center">Product Details</h2>
    <!-- Bootstrap Grid System -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
      <?php if ($totalProducts > 0): ?>
        <?php foreach ($products as $product): ?>
          <div class="col">
            <div class="product-card">
              <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="Product Image"
                   class="product-image"
                   onclick="openImageFrame('<?php echo htmlspecialchars($product['image_path']); ?>')">
              <div class="product-info">
                <div class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></div>
                <div class="product-details">
                  <span><?php echo htmlspecialchars($product['model']); ?></span>
                  <span><?php echo htmlspecialchars($product['manufacturer']); ?></span>
                </div>
                <div class="d-flex align-items-center gap-2 text-center">
                  <label for="quantity_<?php echo $product['product_id']; ?>" class="mb-0">Qty:</label>
                  <input type="number" id="quantity_<?php echo $product['product_id']; ?>" class="quantity-input" value="1" min="1">
                </div>
                <button class="btn-add-cart" onclick="addToCart(<?php echo $product['product_id']; ?>)">Add to Cart</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No product found.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Custom Image Frame Overlay -->
  <div id="imageFrame" class="image-frame">
    <span class="close" onclick="closeImageFrame()">&times;</span>
    <img class="frame-content" id="frameImg" src="" alt="Enlarged Image">
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    document.getElementById("imageFrame").onclick = function(event) {
      if (event.target == this) {
        closeImageFrame();
      }
    }

    // Function to add product to cart
    function addToCart(productId) {
      let quantity = document.getElementById(`quantity_${productId}`).value;
      if (quantity < 1) {
        alert("Quantity must be at least 1");
        return;
      }
      fetch('cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${productId}&quantity=${quantity}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert("Added to cart successfully!");
        } else {
          alert("Failed to add to cart.");
        }
      })
      .catch(error => console.error("Error adding to cart:", error));
    }
  </script>
</body>
</html>
