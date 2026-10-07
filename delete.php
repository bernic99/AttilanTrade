<?php  
include('config/db_connect.php');
$user_id = $_GET['id'];

// SQL to delete that specific user
$sql = "DELETE FROM users WHERE id = $user_id";

// Run the query
mysqli_query($conn, $sql);

// Redirect back to admin page after delete
header("Location: admin_dashboard.php");
exit;




?>