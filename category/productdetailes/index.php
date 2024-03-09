<?php include 'inc/connect.php';

include 'Page-Parts/header.php'; ?>


<main>
    <?php
    // Check if product ID is provided in URL parameter
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        // Query to fetch product details based on product ID
        $stmt = $conn->prepare("SELECT * FROM product WHERE p_code = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if product exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display product details
            echo "<div>";
            echo "<div class='container-img'>";
            echo "<img class='img-product' src='" . htmlspecialchars($row['p_img']) . "' alt='Product Image'>";
            echo "</div>";
            echo "<h3 class='name-product'>" . htmlspecialchars($row['p_name']) . "</h3>";
            echo "<p class='des-product'> " . htmlspecialchars($row['p_description']) . "</p>";
            echo "<p class='price-product'> " . htmlspecialchars($row['p_price']) . "</p>";
            echo "</div>";
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Product ID not provided.";
    }
    ?>
</main>

<?php 
include 'page-parts/search-call.php';
include 'page-parts/footer.php'?>