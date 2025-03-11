<div class="container mt-4">
        <h2 class="text-center">Results</h2>
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
                                <div class="product-name"># <?php echo htmlspecialchars($product['price']); ?></div>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <label for="quantity_<?php echo $product['product_id']; ?>" class="mb-0">Qty:</label>
                                    <input type="text" id="quantity_<?php echo $product['product_id']; ?>"
                                        class="quantity-input">
                                </div>
                                <?php
                                $inCart = isset($_SESSION['cart'][$product['product_id']]);
                                ?>
                                <button class="btn-add-cart <?php echo $inCart ? 'd-none' : ''; ?>"
                                    onclick="addToCart('<?php echo $product['product_id']; ?>')"
                                    id="add-cart-btn-<?php echo $product['product_id']; ?>">
                                    Add to Cart
                                </button>

                                <a href="cart" class="mt-1 btn btn-success <?php echo $inCart ? '' : 'd-none'; ?>"
                                    id="see-cart-btn-<?php echo $product['product_id']; ?>">
                                    See in Cart
                                </a>



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