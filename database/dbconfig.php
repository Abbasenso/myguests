<?php

$host='localhost';
$user='root';
$password='';
$db='myguests';

$conn=mysqli_connect($host,$user,$password,$db);

if ($conn==true) {
	
}else{
	echo "failed";
}

?>