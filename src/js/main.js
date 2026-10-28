const scrollBtn = document.getElementById("scroll-top");

window.addEventListener("scroll", () => {
  scrollBtn.classList.toggle("scroll-top--visible", window.scrollY > 300);
});

scrollBtn.addEventListener("click", () => {
  window.scrollTo({ top: 0 });
});