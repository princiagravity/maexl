<?php
$servername = "localhost";
$username = "gravigw4_maxel";
$password = "gravigw4_maxel";
$dbname="gravigw4_maxel";

//Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

//Check connection
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$today=date("Y-m-d");

$result=mysqli_query($conn,"select date from holiday_details where date like '%$today%' and status !='Deleted'"); 
if(!$result->num_rows)
{
$result=mysqli_query($conn,"UPDATE customer_details
SET reward_amount = reward_amount + 1 where created_by !='guest' and expiry_date <= CURDATE()"); 
$result=mysqli_query($conn,"UPDATE agent_details
SET reward_amount = reward_amount + 1"); 
}
?>