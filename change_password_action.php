<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

$client_id = $_GET["client_id"];
$new_password= $_POST["new_password"];
$old_password = $_POST["old_password"];
$user = $_GET["user"];


 $sql = "UPDATE login SET password='$new_password' WHERE clientid= '$client_id'";
 $result_array = execute_sql_in_oracle ($sql);
 $result = $result_array["flag"];
$cursor = $result_array["cursor"];
if ($result == false){
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}
// Record inserted.  Go back.
header("Location:login.html");
?>
