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

var sidebarToggle = document.getElementById("sidebarToggle");

sidebarToggle.onclick = function () {
  document.body.classList.toggle("sidebar-toggled");
  document.getElementsByClassName("sidebar")[0].classList.toggle("toggled");
}

// Validate Add Department Form in Departments Page
function validateDeptForm() {
  var dept_name = document.forms["AddDepartment"]["deptName"];

  dept_name.classList.remove("is-invalid");

  if(dept_name.value == ""){
    dept_name.classList.add("is-invalid");
    dept_name.focus();
    return false;
  }

  return true;
}

// Validate Assign Department Head Form in Departments Page
function validateDeptHeadForm() {
  var dept_head = document.forms["AssignDepartmentHead"]["departmentHead"];

  dept_head.classList.remove("is-invalid");

  if(dept_head.value == ""){
    dept_head.classList.add("is-invalid");
    dept_head.focus();
    return false;
  }

  return true;
}

// Validate Edit Department Form in Departments Page
function validateEditDeptForm() {
  var dept_name = document.forms["EditDepartment"]["deptName"];
  var dept_head = document.forms["EditDepartment"]["departmentHead"];

  dept_name.classList.remove("is-invalid");
  dept_head.classList.remove("is-invalid");

  if(dept_name.value == ""){
    dept_name.classList.add("is-invalid");
    dept_name.focus();
    return false;
  }

  if(dept_head.value == ""){
    dept_head.classList.add("is-invalid");
    dept_head.focus();
    return false;
  }

  return true;
}

// Assign Department Head in Departments Page
function assignDept(id) {
  document.forms["AssignDepartmentHead"]["deptID"].value = id;
}

// Edit Department in Departments Page
function editDept(id, name, desc, head, head_name) {
  document.forms["EditDepartment"]["deptID"].value = id;
  document.forms["EditDepartment"]["deptName"].value = name;
  document.forms["EditDepartment"]["deptDesc"].value = desc;
}

// Delete Department in Departments Page
function deleteDept(id, name) {
  document.forms["DeleteDept"]["dept_id"].value = id;
  document.forms["DeleteDept"]["dept_name"].value = name;
  document.getElementById("dept_name_text").innerHTML = name;
}

function toggleSelect(e) {
  if(e.checked){
    e.parentNode.parentNode.classList.add("table-secondary");
  } else {
    e.parentNode.parentNode.classList.remove("table-secondary");
  }

}