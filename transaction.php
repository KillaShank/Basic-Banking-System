<?php

session_start();
include 'connection.php';

if(isset($_POST['submit'])){
	$a=$_POST['user'];
	$b=$_POST['amount'];
	$d=$_GET['name'];
}

$result1= mysqli_query($con,"SELECT * FROM customers where name='$a'");
if (!$result1) {
	printf("Error: %s\n", mysqli_error($con));
	exit();
}
while($row = mysqli_fetch_array($result1)){
	$f = $row[3];
	$c= "UPDATE customers SET balance=balance +'$b' WHERE name='$a'";

	mysqli_query($con,$c);
}

$result2 = mysqli_query($con,"SELECT * FROM customers where name='$d'");
if (!$result2) {
	printf("Error: %s\n", mysqli_error($con));
	exit();
}
while($row = mysqli_fetch_array($result2)){
	$g = $row[3];
	$e= "UPDATE customers SET balance=balance - '$b' WHERE name='$d'";
	
	mysqli_query($con,$e);
}

$result3 = mysqli_query($con,"SELECT * FROM customers where name='$d'");
if (!$result3) {
	printf("Error: %s\n", mysqli_error($con));
	exit();	
}
while($row = mysqli_fetch_array($result3)) {
	$h="INSERT INTO transfers(senderName,recieverName,Amount) VALUES('".$d."','".$a."','".$b."')";
	mysqli_query($con,$h);
}

?>

<html>
<head>
<link rel="shortcut icon" href="icon.png">
<script>
alert("Your Transaction is Successful");
window.location.href="customerdetails.php";
</script>
</head>
</html>
