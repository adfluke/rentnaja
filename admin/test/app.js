const next = document.querySelector("#next");
const prev = document.querySelector("#prev");
const progress = document.querySelector(".progress");
const circles = document.querySelectorAll(".circle");
var image_x = document.getElementById('image_X');
let counter = 1;
let a =1;
next.addEventListener("click", () => {
  counter++;
  update();
});

prev.addEventListener("click", () => {
  counter--;
  update();
});
function update() {
  circles.forEach((circle, index) => {
    if (index < counter) {
      circle.classList.add("active");
    } else {
      circle.classList.remove("active");
    }
  });

  if (counter === 1) {
    prev.disabled = true;
  } else if (counter === circles.length) {
    next.disabled = true;
  } else {
    prev.disabled = false;
    next.disabled = false;
  }

  const actives = document.querySelectorAll('.active');
  progress.style.width = (actives.length - 1) / (circles.length - 1) * 100 + '%'

}
// og
const block = document.querySelectorAll('.block');
  window.addEventListener('load', function(){
    block.forEach(item => {
      let numElement = item.querySelector('.num');
      let num = parseInt(numElement.innerText);
      let count = 0;
      let time = 2000 / num;
      let circle = item.querySelector('.circle');
      setInterval(() => {
        if(count == num){
          clearInterval();
        } else {
          count += 1;
          numElement.innerText = count;
        }
      }, time)
      circle.style.strokeDashoffset 
        = 503 - ( 503 * ( num / 100 ));
      let dots = item.querySelector('.dots');
      dots.style.transform = 
        `rotate(${360 * (num / 100)}deg)`;
      if(num == 100){
        dots.style.opacity = 0;
      }
    })
  });

