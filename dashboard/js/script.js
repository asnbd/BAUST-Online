// (function($) {
//   "use strict";
//
//   $("#sidebarToggle").on('click', function(e) {
//     e.preventDefault();
//     $("body").toggleClass("sidebar-toggled");
//     $(".sidebar").toggleClass("toggled");
//   });
//
//   // // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
//   // $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
//   //   if ($(window).width() > 768) {
//   //     var e0 = e.originalEvent,
//   //       delta = e0.wheelDelta || -e0.detail;
//   //     this.scrollTop += (delta < 0 ? 1 : -1) * 30;
//   //     e.preventDefault();
//   //   }
//   // });
//
// })(jQuery); // End of use strict

$sidebarToggle = document.getElementById("sidebarToggle");

$sidebarToggle.onclick = function () {
  document.body.classList.toggle("sidebar-toggled");
  document.getElementsByClassName("sidebar")[0].classList.toggle("toggled");
}

// Validate Add Department Form in Departments Page
function validateDeptForm() {
  $dept_name = document.forms["AddDepartment"]["deptName"];

  $dept_name.classList.remove("is-invalid");

  if($dept_name.value == ""){
    $dept_name.classList.add("is-invalid");
    $dept_name.focus();
    return false;
  }

  return true;
}

// Validate Assign Department Head Form in Departments Page
function validateDeptHeadForm() {
  $dept_head = document.forms["AssignDepartmentHead"]["departmentHead"];

  $dept_head.classList.remove("is-invalid");

  if($dept_head.value == ""){
    $dept_head.classList.add("is-invalid");
    $dept_head.focus();
    return false;
  }

  return true;
}

// Delete Department in Departments Page
function deleteDept(id, name) {
  document.forms["DeleteDept"]["dept_id"].value = id;
  document.forms["DeleteDept"]["dept_name"].value = name;
  document.getElementById("dept_name_text").innerHTML = name;
}