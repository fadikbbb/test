<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Alharmyn</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Katibeh&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/category.css" />
</head>

<body>
    <header>
        <div class="space">
            <div class="top-nav">
                <h1 class="logo">
                    <a href="#">
                        <span class="icons material-symbols-outlined">home</span>
                    </a>
                    <form class="search-form" action="#" method="get">
                        <span id="search-icon" class="notclick icons material-symbols-outlined">search</span>
                        <i class="notclick fa-solid fa-caret-down"></i>
                        <input type="search" name="search" id="searchInput" placeholder="Search..." class="notclick search" oninput="searchProducts(this.value)" />
                        <div id="productList"></div>
                    </form>
                </h1>
                <ul class="nav">
                    <nav class="menu">
                        <a id="main-page" class="menu-links" href="#">صفحة رئيسية</a>
                        <?php
                        include '../inc/connect.php'; // Include database connection script

                        $sql = "SELECT DISTINCT category FROM product";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $category = htmlspecialchars($row['category']);
                                $encodedCategory = urlencode($category);
                                echo "<a id='$category' class='menu-links' href='index.php?category=$encodedCategory'>$category</a>";
                            }
                        } else {
                            echo "Error fetching categories";
                        }
                        ?>
                    </nav>
                </ul>
                <span id="menu-bar" class="icons material-symbols-outlined">menu</span>
            </div>
        </div>
    </header>

    <?php
    if (isset($_GET['category'])) {
        $categoryName = $_GET['category'];
        $stmt = $conn->prepare('SELECT * FROM product WHERE category = ?');
        $stmt->bind_param("s", $categoryName);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<div id='$categoryName' class='contentOfCategory'>";
        echo "<h2 class='show-products-title'>$categoryName</h2>";
        echo "<div class='products'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='contents'>";
            echo "<div class='content'>";
            echo "<a class='product' href='productdetailes/index.php?product_id="
                . $row['p_code'] . "'>";
            echo "<div class='container-img'>";
            echo "<img class='img-product' src='../uploads/"
                . htmlspecialchars($row['p_img'])
                . " alt='Product Image'>";
            echo "</div>";
            echo "<h3 class='name-product'>"
                . htmlspecialchars($row['p_name'])
                . "</h3>";
            echo "<p class='des-product'> "
                . htmlspecialchars($row['p_description'])
                . "</p>";
            echo "<p class='price-product'> "
                . htmlspecialchars($row['p_price'])
                . "</p>";
            echo "<a  href='https://wa.me/+96176795291?text="
                . urlencode("أرغب في طلب المنتج: الصورة:uploads/" . $row['p_img']
                    . " الاسم:" . $row['p_name'] . " الوصف:" . $row['p_description']
                    . " السعر:" . $row['p_price'])
                . "'><button class='order-button'>اطلب</button></a>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
    ?>

    <h1 class="contact-title">للتواصل</h1>
    <div class="information">
        <ul class="social-media">
            <p class="media-title">تواصل معنا</p>
            <div class="media-icons">
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
            </div>
        </ul>
        <ul class="contact">
            <p class="media-title">مراجعاتك</p>
            <div class="email">
                <a href="https://www.google.com/maps/search/?api=1&query=33.6498012,36.437377">
                    <span class="icons material-symbols-outlined">location_on</span>
                </a>
                <a href="mailto:fadikbb2004@gmail.com">
                    <span class="icons material-symbols-outlined">support_agent</span>
                </a>
            </div>
        </ul>
        <ul class="about-us">
            <p class="media-title">من نحن</p>
            <p class="contact-paragraph">
                نحن أفخم وأقوى محمصة في شرق الأوسط معروفة بسمعتها الطيبة. ونحن متواجدون لأكثر من عشرين سنة.
            </p>
        </ul>
    </div>
    <footer>
        <div class="footer-content">
            <div class="cont-title">
                <div class="media-title">أقسام</div>
            </div>
            <ul class="all-list">
                <?php
                $sql = "SELECT DISTINCT category FROM product";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $category = htmlspecialchars($row['category']);
                        $encodedCategory = urlencode($category);
                        echo "<li><a id='$category' class='list-content' href='index.php?category=$encodedCategory'>$category</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </footer>

    <script src="../js/menu1.js"></script>
    <script src="search.js"></script>
    <script src="../js/arrow-motion.js"></script>
</body>

</html>
<?php 
// include '../inc/close.php'; ?>
