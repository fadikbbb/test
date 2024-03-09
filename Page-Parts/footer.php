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
            نحنا افخم واقوى محمصة بشرق الاوسط معروف بالسمعة الطيبة وصلنا فاتحين
            لاكتر من عشرين سنة
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
            if ($result) {
                $uniqueCategories = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $uniqueCategories[] = $row['category'];
                }
                foreach ($uniqueCategories as $category) {
                    echo "<li><a id='$category' class='list-content' href='category/index.php?category=" . urlencode($category) . "'>$category</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</footer>
<script src="js/menu1.js"></script>
<script src="js/search.js"></script>
<script src="js/arrow-motion.js"></script>
</body>

</html>