<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
  body{ 
         background-color: #ffff;
         
    }


    </style>
<body class="text-white text-center py-5">

<div class="container py-5 mt-5">
    <div class="card  p-4 mx-auto" style="max-width:500px;color:white;  background-color: #0B2545;">
        <h3>Withdrawal Successful</h3>
        <p>Your withdrawal request has been processed.</p>
        <p> Funds will be received within 24/48hrs.</p>
        <a href="home_page.php" class="btn btn-light mt-3">DONE</a>
    </div>
</div>

</body>
</html>
