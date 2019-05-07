function validateForm()
{
	/*document.forms[][].value will access all forms in this
	html page and returnthe element whise name was called*/

	var fname = document.forms["user_details"]["first_name"].value; 
	var lname = document.forms["user_details"]["last_name"].value;
	var city = document.forms["user_details"]["city_name"].value;
	var uname = document.forms["user_details"]["Username"].value;
	var pword = document.forms["user_details"]["Password"].value;
	var mfile = document.forms["user_details"]["fileToUpload"].value;

	if (fname == null || lname == "" || city == "" || uname == "" || pword == "" || mfile =="")
	 {
	 	alert ("Some form details are missing...!");
	 	return false;
	 }

	 return true;
}