<script>
    var debounceTimer;

    function searchProducts(searchInput) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var parser = new DOMParser();
                    var responseDoc = parser.parseFromString(
                        this.responseText,
                        "text/html"
                    );
                    var productCards = responseDoc.querySelectorAll(".product");
                    var productList = document.getElementById("productList");
                    productList.innerHTML = "";
                    productCards.forEach(function (productCard) { // Replace 'links' with 'productCards'
                        productList.appendChild(productCard);
                    });
                }
            };
            xmlhttp.open("GET", "index.php?search=" + searchInput, true);
            xmlhttp.send();
        }, 300);
    }
</script>
