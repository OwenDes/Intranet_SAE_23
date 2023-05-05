let valueDisplays = document.querySelectorAll(".num");
let interval = 400;


function easeInOutQuad(t) {
  return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
}

function startAnimations() {
  let duration = Math.floor(interval / 4);
  valueDisplays.forEach((valueDisplay) => {
    let startValue = 0;
    let endValue = parseInt(valueDisplay.getAttribute("data-val"));
    let progress = 0;
    let counter = setInterval(function () {
      progress += 1 / duration;
      let interpolation = easeInOutQuad(progress);
      let currentValue = Math.floor(interpolation * endValue);
      valueDisplay.textContent = currentValue;
      if (progress >= 1) {
        clearInterval(counter);
      }
    }, 16.7);
  });
}

function checkScrollPosition() {
  let scrollPosition = window.pageYOffset;
  let threshold = 500;
  if (scrollPosition >= threshold) {
    startAnimations();
    window.removeEventListener("scroll", checkScrollPosition);
  }
}

//lol

window.addEventListener("scroll", checkScrollPosition);