<?php
require_once 'config.php';

$productId = isset($_GET['productId']) ? intval($_GET['productId']) : 0;

if ($productId > 0) {
  $sql = "SELECT name FROM products WHERE product_id = :productId";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
  $stmt->execute();

  $product = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($product) {
    echo htmlspecialchars($product['name']);
  } else {
    echo 'Product not found';
  }
} else {
  echo 'Invalid product ID';
}
?>