<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Katibeh&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css" />
    <title>Alharmyn</title>
</head>

<body>
    <header>
        <div class="space">
            <div class="top-nav">
                <h1 class="logo">
                    <a href="#">
                        <span class="icons material-symbols-outlined">home</span>
                    </a>
                    <form class="search-form" action="#" method="get"> <!-- Change method to "get" -->
                        <span id="search-icon" class="notclick icons material-symbols-outlined">search</span>
                        <i class="notclick fa-solid fa-caret-down"></i>
                        <input type="search" name="search" id="searchInput" placeholder="Search..."
                            class="notclick search" oninput="searchProducts(this.value)" />
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
                                        echo "<a class='search-product' href='category/productdetailes/index.php?product_id=" . $row['p_code'] . "'>";
                                        echo "<div class='search-product-container'>";
                                        // echo "<div class='container-img'>";
                                        echo "<img class='img-product' src='" ."uploads/". htmlspecialchars($row['p_img']) . "' alt='Product Image'>";
                                        echo "</div>";
                                        echo "<h3 class='name-product'>" . htmlspecialchars($row['p_name']) . "</h3>";
                                        echo "<p class='des-product'> " . htmlspecialchars($row['p_description']) . "</p>";
                                        echo "<p class='price-product'> " . htmlspecialchars($row['p_price']) . "</p>";
                                        // echo "</div>";
                                        echo "</a>";
                                    }
                                } else {
                                    echo "<h3 class='noproduct-message'>No products found matching your search.</h3>";
                                }
                            }
                            ?>
                        </div>
                    </form>
                </h1>
                <ul class="nav">
                    <nav class="menu">
                        <a id="main-page" class="menu-links" href="#">صفحة رئيسية</a>
                        <?php
                        $sql = "SELECT DISTINCT category FROM product";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $uniqueCategories = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $uniqueCategories[] = $row['category'];
                            }
                            foreach ($uniqueCategories as $category) {
                                echo "<a id='$category' class='menu-links' href='category/index.php?category=" . urlencode($category) . "'>$category</a>";
                            }
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }
                        ?>
                    </nav>
                </ul>
                <span id="menu-bar" class="icons material-symbols-outlined">menu</span>
            </div>
        </div>
    </header>