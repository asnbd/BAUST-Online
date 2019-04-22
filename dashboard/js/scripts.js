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