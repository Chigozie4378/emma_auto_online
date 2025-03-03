<?php

include_once "../../autoload/loader.php";
$ctr = new ProductsController();
// Get search query
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
if ($query !== '') {
    $result = $ctr->fetchSearchProducts($query );

    $searchResults = [];
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row['product_name'];
    }

    echo json_encode($searchResults);
} else {
    echo json_encode([]);
}
