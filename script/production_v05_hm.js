document.addEventListener("DOMContentLoaded", () => {
//   function func_for_lazyload_img() {
//     let lazy_img = document.querySelectorAll(".lazyload");
//     let img_observer = new IntersectionObserver((entries, observe) => {
//       entries.forEach((entry) => {
//         if (!entry.isIntersecting) return;
//         const img = entry.target;
//         const newImg = img.getAttribute("data-src");
//         img.src = newImg;
//         observer.unobserve(img);
//         console.log("function lazyload is working");
//       });
//     });
//     lazy_img.forEach((e) => {
//       img_observer.observe(e);
//     });
//   }
function funcForLazyloadImg(){
    console.log("Working 01");
    const images = document.querySelectorAll('img.lazyload');
  function lazyLoadImage(image) {
    console.log("Working 02");
      const observer = new IntersectionObserver(entries => {
    console.log("Working 03");
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            const src = img.getAttribute('data-src');
            img.setAttribute('src', src);
            observer.disconnect();
          }
        });
      });
      observer.observe(image);
    }
images.forEach(image => lazyLoadImage(image));
}

  let true_cond = 0;
  window.addEventListener("scroll", () => {
    if (true_cond == 0) {
    //   func_for_lazyload_img();
    funcForLazyloadImg();
      true_cond++;
    }
  });
});
