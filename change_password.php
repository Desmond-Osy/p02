<?
include "utility_functions.php";
$sessionid =$_GET["sessionid"];
verify_session($sessionid);

$client_id = $_GET["client_id"];
$user = $_GET["user"];
// Generate the query section
echo("
  <form method=\"post\" action=\"change_password_action.php?sessionid=$sessionid&client_id=$client_id&user=$user\">
  Old Password: <input type=\"text\" size=\"12\" maxlength=\"12\" name=\"old_password\">
 
  $new_password;
  New Password: <input type=\"text\" size=\"12\" maxlength=\"12\" name=\"new_password\">
  <input type=\"submit\" value=\"Change\">
  </form>
  ");


?>