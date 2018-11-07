<?
include "utility_functions.php";

// Get the client id and password and verify them
$clientid = $_POST["clientid"];
$password = $_POST["password"];
$client_type = $_POST["client_type"];

if($client_type == "student"){
  $sql = "select clientid " .
       "from login " .
       "where clientid='$clientid'
         and password ='$password'
         and student_flag = '1'";

}else if($client_type == "admin"){
  $sql = "select clientid " .
       "from login " .
       "where clientid='$clientid'
         and password ='$password'
         and administrator_flag = '1'";
}


$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}

if($values = oci_fetch_array ($cursor)){
  oci_free_statement($cursor);

  // found the client
  $clientid = $values[0];

  // create a new session for this client
  $sessionid = md5(uniqid(rand()));

  // store the link between the sessionid and the clientid
  // and when the session started in the session table

  $sql = "insert into loginsession " .
    "(sessionid, clientid, sessiondate) " .
    "values ('$sessionid', '$clientid', sysdate)";

  $result_array = execute_sql_in_oracle ($sql);
  $result = $result_array["flag"];
  $cursor = $result_array["cursor"];

  if ($result == false){
    display_oracle_error_message($cursor);
    die("Failed to create a new session");
  }
  else {
    // insert OK - we have created a new session
    if($client_type == "student"){
     header("Location:welcomestudent.php?sessionid=$sessionid&client_id=$clientid");
    }
    else if($client_type == "admin"){
     header("Location:welcomeadmin.php?sessionid=$sessionid");
    }
  }
}
else { 
  // client username not found
  die ('Login failed.  Click <A href="login.html">here</A> to go back to the login page.');
} 
?>