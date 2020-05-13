"use strict";
// open menu
var a;
var element;
var anchor_link;
var button_open;
var button_close;
var img;
var modal;
var openModal
var closeModal;

//click menu
a = document.getElementsByClassName("icon_menu")[0].addEventListener("click", toggleMenuItem);

// toggle menu_content
function toggleMenuItem() {
  element = document.getElementsByClassName("menu-deroulant")[0];
  if (element.classList.contains("open")) {
    element.classList.remove("open");
  } else {
    element.classList.add("open");
  }
};
// scroll section anchor
document.addEventListener("scroll", detectActiveAnchor);

function detectActiveAnchor(event) {
  var scene_offset = document.getElementById('scene').offsetTop;
  var biographie_offset = document.getElementById('biographie').offsetTop;
  var photos_offset = document.getElementById('photos').offsetTop;
  var contact_offset = document.getElementById('contact').offsetTop;
  var activeAnchor = document.querySelector('.menu-bigscreen a.active');

  if (activeAnchor) {
    activeAnchor.classList.remove("active");
  }
  if (window.scrollY > contact_offset) {
    document.querySelector('a[href="#contact"]').classList.add("active")
  } else if (window.scrollY > photos_offset) {
    document.querySelector('a[href="#photos"]').classList.add("active")
  } else if (window.scrollY > scene_offset) {
    document.querySelector('a[href="#scene"]').classList.add("active")
  } else if (window.scrollY > biographie_offset) {
    document.querySelector('a[href="#biographie"]').classList.add("active")
  }
}

// open scene section content
button_open = document.getElementsByClassName("button")[0].addEventListener("click", toggleSceneContent);
button_close = document.getElementsByClassName("button_close")[0].addEventListener("click", toggleSceneContent);

function toggleSceneContent() {

  var element = document.getElementsByClassName("scene_content_hidden")[0];
  var button_open_content = document.getElementsByClassName("button_a")[0];
  var button_open_offset = document.getElementsByClassName("button")[0].offsetTop;

  if (element.classList.contains("open")) {
    element.classList.remove("open");
    window.scrollTo(0, button_open_offset);
    button_open_content.innerHTML = "Voir toutes les dates";
    button_open_content.insertAdjacentHTML('afterbegin', '<i class="fas fa-arrow-up"></i>');
  } else {
    element.classList.add("open");
    button_open_content.innerHTML = "Dates";
    button_open_content.insertAdjacentHTML('afterbegin', '<i class="fas fa-arrow-down"></i>');
  }
};

// close menu onclick item menu 
document.querySelectorAll('.anchor_link').forEach(item => {
  item.addEventListener('click', event => {
    toggleMenuItem();
  });
});

// slide  bio
var index = 0;

document.getElementById("button_backward").addEventListener("click", function(){
  var parent = document.getElementsByClassName("slider")[0];
  var pagination = document.querySelector("#pagination");
  if (index > 0 ) {
    index--;
    parent.style.left = "-" + (index * 100 ) + "%";
    pagination.innerHTML ="<span>"+ (index +1)+"</span>"+"/4";
  }
});

document.getElementById("button_foward").addEventListener("click", function(){
  var parent = document.getElementsByClassName("slider")[0];
  var pagination = document.querySelector("#pagination");
  if (index < 3) {
    index++;
    parent.style.left = "-" + (index * 100 ) + "%";
    pagination.innerHTML ="<span>"+ (index + 1)+"</span>"+"/4";
  }
}); 

//modal
closeModal = document.querySelector(".cross_modal");
img = document.querySelectorAll(".img");
 
img.forEach(function(e){
  e.addEventListener("click",function(event){
    if (screen.width >= 600) {
    modal = document.querySelector(".modal");
    openModal = document.querySelector(".modal .modal_content div");
    modal.style.display="block";
    openModal.innerHTML = "<img src='" + event.target.src + "'/>";
    document.getElementsByClassName("icon_menu")[0].removeEventListener("click", toggleMenuItem)
    }
  })
});

closeModal.addEventListener("click",function(){
  modal.style.display ="none";
  document.getElementsByClassName("icon_menu")[0].addEventListener("click", toggleMenuItem)
})

window.onclick= function(event){
  if (event.target == modal) {
    modal.style.display ="none";
    document.getElementsByClassName("icon_menu")[0].addEventListener("click", toggleMenuItem)
  }
}
