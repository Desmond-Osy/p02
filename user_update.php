<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Verify how we reach here
if (!isset($_POST["update_fail"])) { // from welceomeadmin.php
  // Get the clientid, fetch the record to be updated from the database
  $q_clientid = $_GET["clientid"];

  // the sql string
  $sql = "select clientid, password from login where clientid = $q_clientid";
  //echo($sql);

  $result_array = execute_sql_in_oracle ($sql);
  $result = $result_array["flag"];
  $cursor = $result_array["cursor"];

  if ($result == false){
    display_oracle_error_message($cursor);
    die("Query Failed.");
  }

  $values = oci_fetch_array ($cursor);
  oci_free_statement($cursor);

  $clientid = $values[0];
  $password = $values[1];
}
else { // from update_action.php
  // Get the values of the record to be updated directly
  $clientid = $_POST["clientid"];
  $password = $_POST["password"];
}

// display the record to be updated.
echo("
  <form method=\"post\" action=\"user_update_action.php?sessionid=$sessionid\">
  UserID (Read-only): <input type=\"text\" readonly value = \"$clientid\" size=\"5\" maxlength=\"12\" name=\"clientid\"> <br />
  Password (Required): <input type=\"text\" value = \"$password\" size=\"50\" maxlength=\"12\" name=\"password\">  <br />
  <input type=\"submit\" value=\"Update\">
  <input type=\"reset\" value=\"Reset to Original Value\">
  </form>

  <form method=\"post\" action=\"users.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>
  ");