<?
ini_set("display_errors", 0);

include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

$clientid = trim($_POST["clientid"]);
if ($clientid == "") $clientid = 'NULL';

$password = $_POST["password"];
$user_type = $_POST["user_type"];

if($user_type == "student"){
$sql = "insert into login values ('$clientid', '$password', 1, 0)";
}else if($user_type == "admin"){
$sql = "insert into login values ('$clientid', '$password', 0, 1)";
}

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  echo "<B>Insertion Failed.</B> <BR />";

  display_oracle_error_message($cursor);
  
  die("<i> 

  <form method=\"post\" action=\"user_add.php?sessionid=$sessionid\">

  <input type=\"hidden\" value = \"$clientid\" name=\"clientid\">
  <input type=\"hidden\" value = \"$password\" name=\"password\">
  
  Read the error message, and then try again:
  <input type=\"submit\" value=\"Go Back\">
  </form>

  </i>
  ");
}

Header("Location:users.php?sessionid=$sessionid");
?>