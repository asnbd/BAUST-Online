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

//Siam
// Validate Add Student Form in Students Page
function validateStudentForm() {
    var studentID = document.forms["AddStudent"]["studentID"];
    var studentName = document.forms["AddStudent"]["studentName"];
    var studentEmail = document.forms["AddStudent"]["studentEmail"];
    var studentAddress = document.forms["AddStudent"]["studentAddress"];
    var studentDistrict = document.forms["AddStudent"]["studentDistrict"];
    var studentPhone = document.forms["AddStudent"]["studentPhone"];
    var studentGender = document.forms["AddStudent"]["studentGender"];
    var studentBirthdate = document.forms["AddStudent"]["studentBirthdate"];
    var studentPhoto = document.forms["AddStudent"]["studentPhoto"];
    var studentSemester = document.forms["AddStudent"]["studentSemester"];
    var studentDepartment = document.forms["AddStudent"]["studentDepartment"];

    studentID.classList.remove("invalid-input");
    studentName.classList.remove("invalid-input");
    studentEmail.classList.remove("invalid-input");
    studentAddress.classList.remove("invalid-input");
    studentDistrict.classList.remove("invalid-input");
    studentPhone.classList.remove("invalid-input");
    studentGender.classList.remove("invalid-input");
    studentBirthdate.classList.remove("invalid-input");
    studentPhoto.classList.remove("invalid-input");
    studentSemester.classList.remove("invalid-input");
    studentDepartment.classList.remove("invalid-input");

    studentID.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentName.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentEmail.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentAddress.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentDistrict.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentPhone.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentGender.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentBirthdate.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentPhoto.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentSemester.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";
    studentDepartment.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "none";

    if(studentID.value == ""){
        studentID.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentID.classList.add("invalid-input");
        studentID.focus();
        return false;
    }

    if(studentName.value == ""){
        studentName.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentName.classList.add("invalid-input");
        studentName.focus();
        return false;
    }

    if(studentEmail.value == ""){
        studentEmail.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentEmail.classList.add("invalid-input");
        studentEmail.focus();
        return false;
    }

    if(studentPhone.value == ""){
        studentPhone.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentPhone.classList.add("invalid-input");
        studentPhone.focus();
        return false;
    }

    if(studentGender.value == ""){
        studentGender.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentGender.classList.add("invalid-input");
        studentGender.focus();
        return false;
    }

    if(studentBirthdate.value == ""){
        studentBirthdate.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentBirthdate.classList.add("invalid-input");
        studentBirthdate.focus();
        return false;
    }

    if(studentAddress.value == ""){
        studentAddress.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentAddress.classList.add("invalid-input");
        studentAddress.focus();
        return false;
    }

    if(studentDistrict.value == ""){
        studentDistrict.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentDistrict.classList.add("invalid-input");
        studentDistrict.focus();
        return false;
    }

    if(studentDepartment.value == ""){
        studentDepartment.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentDepartment.classList.add("invalid-input");
        studentDepartment.focus();
        return false;
    }

    if(studentSemester.value == ""){
        studentSemester.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentSemester.classList.add("invalid-input");
        studentSemester.focus();
        return false;
    }

    if(studentPhoto.value == ""){
        studentPhoto.parentNode.getElementsByClassName("invalid-feedback")[0].style.display = "block";
        studentPhoto.classList.add("invalid-input");
        studentPhoto.focus();
        return false;
    }

    return true;
}