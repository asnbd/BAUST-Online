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
    var teacherUsername = document.forms["AddTeacher"]["teacherUsername"];
    var teacherName = document.forms["AddTeacher"]["teacherName"];
    var teacherEmail = document.forms["AddTeacher"]["teacherEmail"];
    var teacherAddress = document.forms["AddTeacher"]["teacherAddress"];
    var teacherDistrict = document.forms["AddTeacher"]["teacherDistrict"];
    var teacherPhone = document.forms["AddTeacher"]["teacherPhone"];
    var teacherGender = document.forms["AddTeacher"]["teacherGender"];
    var teacherBirthdate = document.forms["AddTeacher"]["teacherBirthdate"];
    var teacherPhoto = document.forms["AddTeacher"]["teacherPhoto"];
    var teacherDesignation = document.forms["AddTeacher"]["teacherDesignation"];
    var teacherDepartment = document.forms["AddTeacher"]["teacherDepartment"];

    teacherUsername.classList.remove("invalid-input");
    teacherName.classList.remove("invalid-input");
    teacherEmail.classList.remove("invalid-input");
    teacherAddress.classList.remove("invalid-input");
    teacherDistrict.classList.remove("invalid-input");
    teacherPhone.classList.remove("invalid-input");
    teacherGender.classList.remove("invalid-input");
    teacherBirthdate.classList.remove("invalid-input");
    teacherPhoto.classList.remove("invalid-input");
    teacherDesignation.classList.remove("invalid-input");
    teacherDepartment.classList.remove("invalid-input");

    teacherUsername.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherName.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherEmail.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherAddress.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherDistrict.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherPhone.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherGender.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherBirthdate.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherPhoto.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherDesignation.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherDepartment.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";

    if(teacherUsername.value == ""){
        teacherUsername.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherUsername.classList.add("invalid-input");
        teacherUsername.focus();
        return false;
    }

    if(teacherName.value == ""){
        teacherName.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherName.classList.add("invalid-input");
        teacherName.focus();
        return false;
    }

    if(teacherDesignation.value == ""){
        teacherDesignation.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherDesignation.classList.add("invalid-input");
        teacherDesignation.focus();
        return false;
    }

    if(teacherDepartment.value == ""){
        teacherDepartment.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherDepartment.classList.add("invalid-input");
        teacherDepartment.focus();
        return false;
    }

    if(teacherGender.value == ""){
        teacherGender.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherGender.classList.add("invalid-input");
        teacherGender.focus();
        return false;
    }

    if(teacherBirthdate.value == ""){
        teacherBirthdate.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherBirthdate.classList.add("invalid-input");
        teacherBirthdate.focus();
        return false;
    }

    if(teacherEmail.value == ""){
        teacherEmail.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherEmail.classList.add("invalid-input");
        teacherEmail.focus();
        return false;
    }

    if(teacherPhone.value == ""){
        teacherPhone.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherPhone.classList.add("invalid-input");
        teacherPhone.focus();
        return false;
    }

    if(teacherAddress.value == ""){
        teacherAddress.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherAddress.classList.add("invalid-input");
        teacherAddress.focus();
        return false;
    }

    if(teacherDistrict.value == ""){
        teacherDistrict.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherDistrict.classList.add("invalid-input");
        teacherDistrict.focus();
        return false;
    }

    if(teacherPhoto.value == ""){
        teacherPhoto.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherPhoto.classList.add("invalid-input");
        teacherPhoto.focus();
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

// Validate Add Student Form in Teachers Page
function validateStudentForm() {
    var teacherUsername = document.forms["AddTeacher"]["teacherUsername"];
    var teacherName = document.forms["AddTeacher"]["teacherName"];
    var teacherEmail = document.forms["AddTeacher"]["teacherEmail"];
    var teacherAddress = document.forms["AddTeacher"]["teacherAddress"];
    var teacherDistrict = document.forms["AddTeacher"]["teacherDistrict"];
    var teacherPhone = document.forms["AddTeacher"]["teacherPhone"];
    var teacherGender = document.forms["AddTeacher"]["teacherGender"];
    var teacherBirthdate = document.forms["AddTeacher"]["teacherBirthdate"];
    var teacherPhoto = document.forms["AddTeacher"]["teacherPhoto"];
    var teacherDesignation = document.forms["AddTeacher"]["teacherDesignation"];
    var teacherDepartment = document.forms["AddTeacher"]["teacherDepartment"];

    teacherUsername.classList.remove("invalid-input");
    teacherName.classList.remove("invalid-input");
    teacherEmail.classList.remove("invalid-input");
    teacherAddress.classList.remove("invalid-input");
    teacherDistrict.classList.remove("invalid-input");
    teacherPhone.classList.remove("invalid-input");
    teacherGender.classList.remove("invalid-input");
    teacherBirthdate.classList.remove("invalid-input");
    teacherPhoto.classList.remove("invalid-input");
    teacherDesignation.classList.remove("invalid-input");
    teacherDepartment.classList.remove("invalid-input");

    teacherUsername.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherName.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherEmail.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherAddress.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherDistrict.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherPhone.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherGender.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherBirthdate.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherPhoto.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherDesignation.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    teacherDepartment.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";

    if(teacherUsername.value == ""){
        teacherUsername.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherUsername.classList.add("invalid-input");
        teacherUsername.focus();
        return false;
    }

    if(teacherName.value == ""){
        teacherName.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherName.classList.add("invalid-input");
        teacherName.focus();
        return false;
    }

    if(teacherDesignation.value == ""){
        teacherDesignation.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherDesignation.classList.add("invalid-input");
        teacherDesignation.focus();
        return false;
    }

    if(teacherDepartment.value == ""){
        teacherDepartment.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherDepartment.classList.add("invalid-input");
        teacherDepartment.focus();
        return false;
    }

    if(teacherGender.value == ""){
        teacherGender.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherGender.classList.add("invalid-input");
        teacherGender.focus();
        return false;
    }

    if(teacherBirthdate.value == ""){
        teacherBirthdate.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherBirthdate.classList.add("invalid-input");
        teacherBirthdate.focus();
        return false;
    }

    if(teacherEmail.value == ""){
        teacherEmail.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherEmail.classList.add("invalid-input");
        teacherEmail.focus();
        return false;
    }

    if(teacherPhone.value == ""){
        teacherPhone.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherPhone.classList.add("invalid-input");
        teacherPhone.focus();
        return false;
    }

    if(teacherAddress.value == ""){
        teacherAddress.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherAddress.classList.add("invalid-input");
        teacherAddress.focus();
        return false;
    }

    if(teacherDistrict.value == ""){
        teacherDistrict.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherDistrict.classList.add("invalid-input");
        teacherDistrict.focus();
        return false;
    }

    if(teacherPhoto.value == ""){
        teacherPhoto.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        teacherPhoto.classList.add("invalid-input");
        teacherPhoto.focus();
        return false;
    }

    return true;
}