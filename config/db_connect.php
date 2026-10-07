<?php  
//db connection
$conn = mysqli_connect('localhost', "master1", "newday56", 'attilantrade');
// check connection
if(!$conn){ 
echo 'Connection error:' . mysqli_connect_error();
}



