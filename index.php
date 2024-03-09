<?php
include 'inc/connect.php';
include 'page-parts/header.php';
?>
<main>
    <?php
    $sql = "SELECT DISTINCT category FROM product";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if query execution was successful
    if ($result) {
        // Fetch unique categories and store them in an array
        $uniqueCategories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $uniqueCategories[] = $row['category'];
        }
        foreach ($uniqueCategories as $category) {
            echo "<section class='$category'>";
            echo " <div class='show-products'>";
            echo "<span class='arrow-left material-symbols-outlined'>arrow_back_ios_new</span>";
            echo "<a class='show-products-title' href='category/index.php?category=$category'>" . ucfirst($category) . "</a>";
            echo "<span class='arrow-right material-symbols-outlined'>arrow_forward_ios</span>";
            echo "</div>";
            $stmt = $conn->prepare("SELECT p_code, p_name, p_price, p_description, p_img FROM product WHERE category = ?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<div class='products'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='contents'>";
                echo "<div class='content'>";
                echo "<a class='product' href='category/productdetailes/index.php?product_id=" . $row['p_code'] . "'>";
                echo "<div class='container-img'>";
                echo "<img class='img-product' src='uploads/" . htmlspecialchars($row['p_img']) . "' alt='Product Image'>";
                echo "</div>";
                echo "<h3 class='name-product'>" . htmlspecialchars($row['p_name']) . "</h3>";
                echo "<p class='des-product'> " . htmlspecialchars($row['p_description']) . "</p>";
                echo "<p class='price-product'> " . htmlspecialchars($row['p_price']) . "</p>";
                echo "</a>";
                echo "<a  href='https://wa.me/+96176795291?text=" . htmlspecialchars("أرغب في طلب المنتج: " . "الصورة:" . "uploads/" . $row['p_img']) . htmlspecialchars("أرغب في طلب المنتج: " . "الاسم:" . $row['p_name']) . "الوصف:%0A" . htmlspecialchars($row['p_description']) . "%0Aالسعر:" . htmlspecialchars($row['p_price']) . "'><button class='order-button'>اطلب</button></a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</section>";
        }
    }
    ?>
</main>
<?php
include 'page-parts/footer.php';
include 'inc/close.php'
    ?>