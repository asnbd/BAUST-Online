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

}
