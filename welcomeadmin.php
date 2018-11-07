
<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


// Here we can generate the content of the welcome page
echo("Data Management Menu: <br />");
echo("<UL>
  <LI><A HREF=\"users.php?sessionid=$sessionid\">Users</A></LI>
  </UL>");

echo("<br />");
echo("<br />");
echo("Click <A HREF = \"change_password.php?sessionid=$sessionid&client_id=$client_id&user='admin'\">here</A> to change password.");
echo("<br />");
echo("Click <A HREF = \"logout_action.php?sessionid=$sessionid\">here</A> to Logout.");
?>