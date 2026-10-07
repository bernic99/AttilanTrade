<?php
// forgot_password.php
session_start();
include('config/db_connect.php'); // contains $conn = new mysqli(...)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $username = trim($_POST['username']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND username=?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION['reset_email'] = $email;
            $_SESSION['reset_username'] = $username;
            header("Location: reset_password.php");
            exit();
        } else {
            $error = "No account matches that email and username.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password | AttilanTrade</title>
  <style>
    body { font-family: Arial, sans-serif; background:#FFFFFF; margin-top:100px; text-align:center; }
    form {  padding:30px; border-radius:10px; display:inline-block; margin-top:100px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
    input { width:90%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:5px; }
    button { padding:10px 20px; background-color: #1E63E9; color:white; border:none; border-radius:5px; cursor:pointer; }
    button:hover {  background-color: #1E63E9; }
    .error { color:red; }
    h2{ 
        color:black;
    }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Reset Password</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Enter your email" required><br>
    <input type="text" name="username" placeholder="Enter your username" required><br>
    <button type="submit">Continue</button>
  </form>
</body>
</html>
