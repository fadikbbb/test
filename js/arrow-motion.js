function listT(section) {
    let left = document.querySelector(`${section} .show-products .arrow-left`);
    let right = document.querySelector(`${section} .show-products .arrow-right`);
    let counter = 0;
    let offer = document.querySelectorAll(`${section} .products .content`);
    right.onclick = function () {
      if (counter < offer.length - 1) {
        counter++;
        offer[counter].scrollIntoView({
          behavior: "smooth",
          block: "nearest",
          inline: "center",
        });
        updateOfferStyles();
      }
    };
    left.onclick = function () {
      if (counter > 0) {
        counter--;
        offer[counter].scrollIntoView({
          behavior: "smooth",
          block: "nearest",
          inline: "center",
        });
        updateOfferStyles();
      }
    };
    function updateOfferStyles() {
      offer.forEach((element, index) => {
        if (index === counter) {
          element.style.transform = "scale(1.2)";
        } else {
          element.style.transform = "scale(1)";
        }
      });
    }
  }
  let typeOfProduct = document.querySelectorAll("section");
  typeOfProduct.forEach((e) => {
    listT(`.${e.classList[0]}`);
  });
  