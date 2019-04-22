// Validate Assign Department Head Form in Departments Page
function validateDeptHeadForm() {
    var dept_head = document.forms["AssignDepartmentHead"]["departmentHead"];

    document.getElementById("invalid-dept-head").style.display = "none";
    dept_head.classList.remove("invalid-input");

    if(dept_head.value == ""){
        document.getElementById("invalid-dept-head").style.display = "block";
        dept_head.classList.add("invalid-input");
        dept_head.focus();
        return false;
    }

    return true;
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

// Validate Add Teacher Form in Teachers Page
function validateTeacherForm() {
    var teacher_name = document.forms["AddTeacher"]["teacherName"];

    teacher_name.classList.remove("invalid-input");
    teacher_name.getElementsByClassName("").style.display = "none";

    if(dept_name.value == ""){
        document.getElementById("invalid-dept").style.display = "block";
        dept_name.classList.add("invalid-input");
        dept_name.focus();
        return false;
    }

    return true;
}

// Validate Edit Department Form in Departments Page
function validateEditDeptForm() {
    var dept_name = document.forms["EditDepartment"]["deptName"];
    var dept_head = document.forms["EditDepartment"]["deptHead"];

    document.getElementById("invalid-dept-head").style.display = "none";
    document.getElementById("invalid-dept").style.display = "none";
    dept_name.classList.remove("invalid-input");
    dept_head.classList.remove("invalid-input");

    if(dept_name.value == ""){
        document.getElementById("invalid-dept").style.display = "block";
        dept_name.classList.add("invalid-input");
        dept_name.focus();
        return false;
    }

    if(dept_head.value == ""){
        document.getElementById("invalid-dept-head").style.display = "block";
        dept_head.classList.add("invalid-input");
        dept_head.focus();
        return false;
    }

    return true;
}