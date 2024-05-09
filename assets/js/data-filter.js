filterSelection("all");
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn-filter");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

// Gallery image hover
$(".img-wrapper").hover(
  function () {
    $(this).find(".img-overlay").animate({ opacity: 1 }, 600);
  },
  function () {
    $(this).find(".img-overlay").animate({ opacity: 0 }, 600);
  }
);

var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");
var $prevButton = $(
  '<div id="prevButton"><i class="fa fa-chevron-left"></i></div>'
);
var $nextButton = $(
  '<div id="nextButton"><i class="fa fa-chevron-right"></i></div>'
);
var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

$overlay
  .append($image)
  .prepend($prevButton)
  .append($nextButton)
  .append($exitButton);
$("#gallery").append($overlay);
$overlay.hide();

// When an image is clicked
$(".img-overlay").click(function (event) {
  event.preventDefault();
  var imageLocation = $(this).prev().attr("href");
  $image.attr("src", imageLocation);
  $overlay.fadeIn("slow");
});

// When the overlay is clicked
$overlay.click(function () {
  $(this).fadeOut("slow");
});

// When next button is clicked
$nextButton.click(function (event) {
  $("#overlay img").hide();
  var $currentImgSrc = $("#overlay img").attr("src");
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  var $nextImg = $($currentImg.closest(".image").next().find("img"));
  var $images = $("#image-gallery img");
  if ($nextImg.length > 0) {
    $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  } else {
    $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
  }
  event.stopPropagation();
});

// When previous button is clicked
$prevButton.click(function (event) {
  $("#overlay img").hide();
  var $currentImgSrc = $("#overlay img").attr("src");
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  var $nextImg = $($currentImg.closest(".image").prev().find("img"));
  $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  event.stopPropagation();
});

// When the exit button is clicked
$exitButton.click(function () {
  $("#overlay").fadeOut("slow");
});
