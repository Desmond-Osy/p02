<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Suppress PHP auto warning.
ini_set( "display_errors", 0);

// Get input from user_update.php and update the record.
$clientid = $_POST["clientid"];
$password = $_POST["password"];

// the sql string
$sql = "update login set password = '$password' where clientid = $clientid";
//echo($sql);

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  // Error handling interface.
  echo "<B>Update Failed.</B> <BR />";

  display_oracle_error_message($cursor);

  die("<i>

  <form method=\"post\" action=\"user_update?sessionid=$sessionid\">

  <input type=\"hidden\" value = \"$clientid\" name=\"clientid\">
  <input type=\"hidden\" value = \"$password\" name=\"password\">
  <input type=\"hidden\" value = \"1\" name=\"update_fail\">

  Read the error message, and then try again:
  <input type=\"submit\" value=\"Go Back\">
  </form>

  </i>
  ");
}

// Record updated.  Go back.
Header("Location:users.php?sessionid=$sessionid");
?>