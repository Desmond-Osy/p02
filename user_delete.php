<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


// Obtain input from department.php
$clientid = $_GET["clientid"];

// Retrieve the tuple to be deleted and display it.
$sql = "select clientid, password from login where clientid = $clientid";
//echo($sql);

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){ // error unlikely
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}

if (!($values = oci_fetch_array ($cursor))) {
  // Record already deleted by a separate session.  Go back.
  Header("Location:users.php?sessionid=$sessionid");
}
oci_free_statement($cursor);

$clientid = $values[0];
$password = $values[1];

// Display the tuple to be deleted
echo("
  <form method=\"post\" action=\"user_delete_action.php?sessionid=$sessionid\">
  User Id (Read-only): <input type=\"text\" readonly value = \"$clientid\" name=\"clientid\"> <br /> 
  Password: <input type=\"text\" disabled value = \"$password\" name=\"password\">  <br />
  <input type=\"submit\" value=\"Delete\">
  </form>

  <form method=\"post\" action=\"users.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>
  ");

?>