<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


// Obtain the inputs from dept_add_action.php
$clientid = $_POST["clientid"];
$password = $_POST["password"];

// display the insertion form.
echo("
  <form method=\"post\" action=\"user_add_action.php?sessionid=$sessionid\">
  Id (up to 12 digits): <input type=\"text\" value = \"$clientid\" size=\"5\" maxlength=\"5\" name=\"clientid\"> <br /> 
  Password (Required): <input type=\"text\" value = \"$password\" size=\"50\" maxlength=\"50\" name=\"password\">  <br />

  User Type (Required):
  <select name=\"user_type\">
  <option value=\"student\">Student</option>
  <option value=\"admin\">Administrator</option>
  </select>

  <input type=\"submit\" value=\"Add\">
  <input type=\"reset\" value=\"Reset to Original Value\">
  </form>

  <form method=\"post\" action=\"users.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>");

?>