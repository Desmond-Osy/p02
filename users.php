<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


// Generate the query section
echo("
  <form method=\"post\" action=\"users.php?sessionid=$sessionid\">
  User ID: <input type=\"text\" size=\"10\" maxlength=\"12\" name=\"q_clientid\">
  Password: <input type=\"text\" size=\"20\" maxlength=\"12\" name=\"q_password\">
  <input type=\"submit\" value=\"Search\">
  </form>

  <form method=\"post\" action=\"welcomeadmin.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>

  <form method=\"post\" action=\"user_add.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Add A New User\">
  </form>
  ");


// Interpret the query requirements
$q_clientid = $_POST["q_clientid"];
$q_password = $_POST["q_password"];

$whereClause = " 1=1 ";

if (isset($q_clientid) and trim($q_clientid)!= "") {
  $whereClause .= " and clientid = $q_clientid";
}

if (isset($q_password) and $q_password!= "") {
  $whereClause .= " and password = $q_dname";
}


// Form the query and execute it
$sql = "select * from login where $whereClause order by clientid";
//echo($sql);

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}


// Display the query results
echo "<table border=1>";
echo "<tr> <th>UserID</th> <th>Password</th> <th> User Type</th> <th>Update</th> <th>Delete</th></tr>";

// Fetch the result from the cursor one by one
while ($values = oci_fetch_array ($cursor)){
  $clientid = $values[0];
  $password = $values[1];
  $s_flag = $values[2];
  $a_flag = $values[3];
  $usertype = "";
  if($s_flag == 1 && $a_flag == 0){
    $usertype = "Student";
  }else if($s_flag == 0 && $a_flag == 1){
    $usertype = "Admin";
  }else if($s_flag == 1 && $a_flag == 1){
    $usertype = "StudentAdmin";
  }

  
  echo("<tr>" .
    "<td>$clientid</td> <td>$password</td> <td>$usertype</td>".
    " <td> <A HREF=\"user_update.php?sessionid=$sessionid&clientid=$clientid\">Update</A> </td> ".
    " <td> <A HREF=\"user_delete.php?sessionid=$sessionid&clientid=$clientid\">Delete</A> </td> ".
    "</tr>");
}
oci_free_statement($cursor);

echo "</table>";