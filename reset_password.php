<?php
// reset_password.php
session_start();
include('config/db_connect.php'); 

if (!isset($_SESSION['reset_email']) || !isset($_SESSION['reset_username'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Password regex validation
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\W]{6,}$/", $new_password)) {
        $error = "Password must be at least 6 characters, contain letters and numbers.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];
        $username = $_SESSION['reset_username'];

        $stmt = $conn->prepare("UPDATE users SET new_password=? WHERE email=? AND username=?");
        $stmt->bind_param("sss", $hashed, $email, $username);
        $stmt->execute();

        session_unset();
        session_destroy();
        $success = "Password changed successfully. You can now log in.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password | AttilanTrade</title>
  <style>
    body { font-family: Arial, sans-serif; background:#FFFFFF; text-align:center; }
    form {  padding:30px; border-radius:10px; display:inline-block; margin-top:100px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
    input { width:90%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:5px; }
    button { padding:10px 20px; background-color:#1E63E9; color:white; border:none; border-radius:5px; cursor:pointer; }
    button:hover { background-color:#1E63E9; }
    .error { color:red; }
    .success { color:green; }
     h2, { 
        color:black;
    }
    a{ 
        color:blue;
    }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Change Your Password</h2>
    <?php
      if (!empty($error)) echo "<p class='error'>$error</p>";
      if (!empty($success)) echo "<p class='success'>$success</p>";
    ?>
    <input type="password" name="new_password" placeholder="Enter new password" required><br>
    <input type="password" name="confirm_password" placeholder="Confirm new password" required><br>
    <button type="submit">Change Password</button>
  </form>
    <p class="login"> <a href="login.php"><strong> login</strong></a></p>
</body>
</html>
