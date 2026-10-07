<?php 
session_start(); 

include('config/db_connect.php');

$error = "";


if (isset($_POST['submit'])) {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if (empty($username) || empty($password)) {
      $error = "Please fill in all fields.";
  } else {

  


      // Prepare SQL to fetch user
      $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      
      $result = $stmt->get_result();

      $user = $result->fetch_assoc();

      if ($user) {
         

          // Verify password
          if ($password == $user['password']) {
              // Password is correct, create session
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['username'] = $user['username'];

              header("Location: admin_dashboard.php");
              exit();
          } else {
              $error = "Invalid username or password.";
          }
      } else {
          $error = "Invalid username or password.";
      }
  }
}





?>




<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>login page </title>
 
  <link rel="stylesheet" type="text/css" href="css/admin.css?v=<?php echo time(); ?>">



</head>

<body>
  <img src="images/PHOTO-2023-08-31-19-41-39.jpg" alt="" width="50px">

  <div class="container">

   <h2>Admin</h2>



    <form method="POST" action='admin.php'>

      <input type="text" placeholder="Username" name="username" required>

      <input type="password" placeholder="Password" name="password" required>

      
      <?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

      
       <input type="submit"value="login" name="submit" class="submit">
      
    </form>


  </div>

</body>

</html>
