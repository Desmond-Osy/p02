
<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

$client_id = $_GET["client_id"];

echo("<h1>Welcome User: $client_id</h1>");

echo("Click <A HREF = \"change_password.php?sessionid=$sessionid&client_id=$client_id&user='student'\">here</A> to change password.");
echo("<br />");
echo("Click <A HREF = \"logout_action.php?sessionid=$sessionid\">here</A> to Logout.");
?>