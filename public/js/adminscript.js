$(document).ready(function () {
  console.log("JavaScript is loaded and ready!");
  $(".nav-link.active .sub-menu").slideDown();
  // $("p").slideUp();

  $("#sidebar-menu .arrow").click(function () {
    $(this).parents("li").children(".sub-menu").slideToggle();
    $(this).toggleClass("fa-angle-right fa-angle-down");
  });

  $("input[name='checkall']").click(function () {
    var checked = $(this).is(":checked");
    $(".table-checkall tbody tr td input:checkbox").prop("checked", checked);
  });
});
function openNav() {
  document.getElementById("mySidebar").style.width = "205px";
  document.getElementById("main").style.marginLeft = "205px";
  document.getElementById("main-content").style.marginLeft = "205px";
  document.getElementById("main").style.display = "none";
  document.getElementById("navbar-text").classList.add("active");
}

let originalMarginLeft =
  document.getElementById("main-content").style.marginLeft;

function closeNav() {
  document.getElementById("mySidebar").style.width = "0"; // Đóng sidebar
  document.getElementById("main").style.marginLeft = "0"; // Đặt lại margin cho main
  document.getElementById("main").style.display = "block"; // Hiển thị main
  document.getElementById("main-content").style.marginLeft = originalMarginLeft; // Khôi phục margin-left
  document.getElementById("navbar-text").classList.add("active");
}


