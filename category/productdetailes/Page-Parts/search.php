
<form class="search-form" action="#" method="get"> <!-- Change method to "get" -->
    <span id="search-icon" class="notclick icons material-symbols-outlined">search</span>
    <i class="notclick fa-solid fa-caret-down"></i>
    <input type="search" name="search" id="searchInput" placeholder="Search..." class="notclick search"
        oninput="searchProducts(this.value)" />
</form>

<div id="productList">
    <?php

  $conn = mysqli_connect('localhost', 'root', '', 'alharmyn');
  if (!$conn) {
      die('error: ' . mysqli_error($conn));
  }
    if (isset($_GET['search'])) { // Change to check for $_GET['search']
        $search = mysqli_real_escape_string($conn, $_GET['search']); // Retrieve search query from $_GET

        $sql = "SELECT * FROM product WHERE p_name LIKE '%$search%'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<a class='product' href='index.php?product_id=" . $row['p_code'] . "'>";
                echo "<div >";
                echo "<div class='container-img'>";
                echo "<img class='img-product' src='" . htmlspecialchars($row['p_img']) . "' alt='Product Image'>";
                echo "</div>";
                echo "<h3 class='name-product'>" . htmlspecialchars($row['p_name']) . "</h3>";
                echo "<p class='des-product'> " . htmlspecialchars($row['p_description']) . "</p>";
                echo "<p class='price-product'> " . htmlspecialchars($row['p_price']) . "</p>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            // Display a message if no products are found
            echo "No products found matching your search.";
        }
    }
    ?>
</div>

