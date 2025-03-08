<?php

include_once "../../autoload/loader.php";
$ctr = new ProductsController();

// Get search query
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query !== '') {
    $result = $ctr->fetchSearchProducts($query);

    $searchResults = [];
    while ($row = mysqli_fetch_array($result)){
        $searchResults[] = [
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name']
        ];
        
    }

    echo json_encode($searchResults);
} else {
    echo json_encode([]);
}
