var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}

// Validate Add Department Form in Departments Page
function validateDeptForm() {
    var dept_name = document.forms["AddDepartment"]["deptName"];

    dept_name.classList.remove("invalid-input");
    document.getElementById("invalid-dept").style.display = "none";

    if(dept_name.value == ""){
        document.getElementById("invalid-dept").style.display = "block";
        dept_name.classList.add("invalid-input");
        dept_name.focus();
        return false;
    }

    return true;
}

function modalDisplay(id, disp) {
    document.getElementById(id).style.display = disp;
}
// Assign Department Head in Departments Page
function assignDept(id) {
    modalDisplay('assignDeptHeadModel', 'block')
    document.forms["AssignDepartmentHead"]["deptID"].value = id;
}

// Validate Assign Department Head Form in Departments Page
function validateDeptHeadForm() {
    var dept_head = document.forms["AssignDepartmentHead"]["departmentHead"];

    document.getElementById("invalid-dept-head").style.display = "none";

    if(dept_head.value == ""){
        document.getElementById("invalid-dept-head").style.display = "block";
        dept_head.focus();
        return false;
    }

    return true;
}

// Delete Modal
var deleteDeptModal = document.getElementById("deleteDeptModel");
window.onclick = function(event) {
    if (event.target == deleteDeptModal) {
        deleteDeptModal.style.display = "none";
    }
}

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