var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}

function modalDisplay(id, disp) {
    document.getElementById(id).style.display = disp;
}
// Assign Department Head in Departments Page
function assignDept(id) {
    modalDisplay('assignDeptHeadModel', 'block')
    document.forms["AssignDepartmentHead"]["deptID"].value = id;
}


var deleteDeptModal = document.getElementById("deleteDeptModel");
var logoutModal = document.getElementById("logoutModel");
var assignDeptHeadModal = document.getElementById("assignDeptHeadModel");
var deleteTeacherModal = document.getElementById("deleteTeacherModal");
window.onclick = function(event) {
    if (event.target == deleteDeptModal) {
        deleteDeptModal.style.display = "none";
    }
    if (event.target == assignDeptHeadModal) {
        assignDeptHeadModal.style.display = "none";
    }
    if (event.target == logoutModal) {
        logoutModal.style.display = "none";
    }
}

// Delete Modal
function deleteDeptModalDisplay(disp) {
    deleteDeptModal.style.display = disp;
}

// Delete Department in Departments Page
function deleteDept(id, name) {
    deleteDeptModal.style.display = "block";
    document.forms["DeleteDept"]["dept_id"].value = id;
    document.forms["DeleteDept"]["dept_name"].value = name;
    document.getElementById("dept_name_text").innerHTML = name;
}

// Delete Teacher in Departments Page
function deleteTeacher(id, name) {
    deleteTeacherModal.style.display = "block";
    document.forms["DeleteTeacher"]["teacher_id"].value = id;
    document.forms["DeleteTeacher"]["teacher_name"].value = name;
    document.getElementById("name_text").innerHTML = name;
}