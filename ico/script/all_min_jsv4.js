const minjs = () => {
  const scrollNavBackColor = () =>
    window.scrollY > 50
      ? (document.querySelector("header").style.background = "var(--b-clr)")
      : (document.querySelector("header").style.background = "transparent");
  window.addEventListener("scroll", scrollNavBackColor);
function setCount_01(data){
    document.querySelector('.total-edit-count').innerText = data;
}};
document.addEventListener("DOMContentLoaded", minjs);
