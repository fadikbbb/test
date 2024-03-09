function toggleSidebar() {
  const bar = document.querySelector("#menu-bar");
  const nav = document.querySelector(".nav");
  nav.classList.toggle("active");
  if (bar.innerHTML.trim() == "menu") {
    bar.innerHTML = "close";
  } else {
    bar.innerHTML = "menu";
  }
}
document.querySelector("#menu-bar").addEventListener("click", toggleSidebar);
