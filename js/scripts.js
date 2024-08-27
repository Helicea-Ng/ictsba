function showMenu() {
  menuDiv = document.getElementById("menuDiv");
  menu = document.getElementById("menu");
  menuDiv.className = "appear";
  menuDiv.classList.remove("invis");
  menu.setAttribute("onclick", "offMenu()");
  menu.innerHTML = "<img src='UI/cross.png' height='24px'>";
}

function offMenu() {
  menuDiv = document.getElementById("menuDiv");
  menu = document.getElementById("menu");
  menuDiv.classList.remove("appear");
  menuDiv.className = "leave";
  menu.setAttribute("onclick", "showMenu()");
  menu.innerHTML = "<img src='UI/menu.png' height='24px'>";
}


function change(k){
  let x = document.getElementById("quantity").innerText;
  if (x > 0) {
    x = Number(x) + k;
    document.getElementById("quantity").innerText = x;
  }
  if (x==0) {
    document.getElementById("quantity").innerText = 1;
  }
}

function expand(x) {
  lang = document.getElementById("lang");
  alang = document.getElementById("alang");
  alangImg = document.getElementById("alangImg");
  if (x==0) {
    lang.classList.remove("invis");  
    alang.setAttribute("onclick", "expand(1)");
    alangImg.setAttribute("src", "UI/up.png");
  } else {
    lang.className = "invis";
    alang.setAttribute("onclick", "expand(0)");
    alangImg.setAttribute("src", "UI/down.png");
  }
}

function mode(x) {
  mswitch = document.getElementById("mswitch");
  if (x==1) {
    document.body.className = "darkMode";
    mswitch.setAttribute("onclick", "mode(0)");
  } else if (x==0) {
    document.body.classList.remove("darkMode");
    mswitch.setAttribute("onclick", "mode(1)");
  } 
  
}
function goBack() {
  window.history.back();
}
/*
function darkMode() {
  document.body.style.backgroundColor = "#04080f" ;
  mswitch = document.getElementById("mswitch");
  mswitch.setAttribute("onclick", "lightMode()");
}

function lightMode() {
  document.body.style.backgroundColor = "#e3e3e3" ;
  mswitch = document.getElementById("mswitch");
  mswitch.setAttribute("onclick", "darkMode()");
}
*/