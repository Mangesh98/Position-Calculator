let changeIcon = function (icon) {
  let c = document.querySelector(":root");
  if (icon.classList.contains("fa-sun")) {
    icon.classList.remove("fa-sun");
    icon.classList.add("fa-moon");

    c.style.setProperty("--color", '#1d2b3a');
    c.style.setProperty("--text", '#fff');
    c.style.setProperty("--lable", 'rgba(255, 255, 255, 0.25)');
    c.style.setProperty("--title", '#fff');
    
  } else {
    icon.classList.remove("fa-moon");
    icon.classList.add("fa-sun");

    c.style.setProperty("--color", 'white');
    c.style.setProperty("--text", 'black');
    c.style.setProperty("--lable", 'royalblue');
    c.style.setProperty("--title", 'royalblue');
    
  }
//   --color: white;
//   --text: black;
//   --lable: royalblue;

  //     --color:#1d2b3a;
  //     --text:#fff;
  //     --lable:rgba(255, 255, 255, 0.25);
};
