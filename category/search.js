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
                var productCards = responseDoc.querySelectorAll(".search-product");
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
try {
  const searchInput = document.querySelector(".search");
  const searchSign = document.querySelector(".fa-caret-down");
  const obj = document.querySelector("#productList");
  const iconSearch = document.querySelector("#search-icon");
  iconSearch.addEventListener("click", () => {
    searchInput.classList.toggle("research");
    searchInput.style.display = searchInput.classList.contains("research")
      ? "flex"
      : "none";
    searchInput.style.display = searchInput.classList.contains("research")
      ? "flex"
      : "none";
    searchSign.style.cssText = searchInput.classList.contains("research")
      ? `display:flex;
        color:#ff7300;`
      : "none";
    obj.style.display = searchInput.classList.contains("research")
      ? "flex"
      : "none";
    obj.style.height = searchInput.classList.contains("research")
      ? "170px"
      : "0px";
    obj.style.flexDirection = searchInput.classList.contains("research")
      ? "column"
      : "";
    iconSearch.style.cssText = searchInput.classList.contains("research")
      ? `color:#ff7300`
      : "";
  });
} catch (error) {}
