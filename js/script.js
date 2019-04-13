function validateLoginForm(){
    var userID = document.forms["LoginForm"]["UserID"];
    var password = document.forms["LoginForm"]["Password"];

	if (userID.value == "")	{
		window.alert("Please enter your User ID.");
		userID.focus();
		return false;
	}

	if (password.value == "") {
		window.alert("Please enter your password");
		password.focus();
		return false;
	}
}

function validateRegForm(){
    var password = document.forms["regForm"]["password"];
    var confirmPassword = document.forms["regForm"]["cpassword"];

    var password_vtext = document.getElementById("password_vtext");
    var confirm_password_vtext = document.getElementById("confirm_password_vtext");

    password_vtext.style.display = "none";
    confirm_password_vtext.style.display = "none";

    if (password.value.length < 8) {
        password_vtext.innerHTML = "<strong>Password must be 8 characters long</strong>";
        password_vtext.style.display = "block";
        password.focus();
        return false;
    }

    if (password.value.search(/[a-z]/) == -1
        || password.value.search(/[A-Z]/) == -1
        || password.value.search(/[0-9]/) == -1
        || password.value.search(/[!@#\$%\^\&*\)\(+=,._-]/) == -1) {
        password_vtext.innerHTML = "<strong>Password must be 8 characters long & must contain at least one digit,<br>uppercase, lowercase letter & special symbol</strong>";
        password_vtext.style.display = "block";
        password.focus();
        return false;
    }

    if (password.value != confirmPassword.value) {
        confirm_password_vtext.style.display = "block";
        confirmPassword.focus();
        return false;
    }

    return true;
}
