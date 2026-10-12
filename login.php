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
      $stmt = $conn->prepare("SELECT id, username, new_password FROM users WHERE username = ?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      
      $result = $stmt->get_result();

      $user = $result->fetch_assoc();

      if ($user) {
         

          // Verify password
          if ($password == $user['new_password']) {
              // Password is correct, create session
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['username'] = $user['username'];

              header("Location: home_page.php");
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
  <title>Login — AttilanTrade</title>
    <link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet">
  
</head>

<body>

  <div class="page">

    <!-- ===================== LEFT BRAND PANEL ===================== -->
    <div class="brand-panel">
      <a href="index.php" class="brand">

        AttilanTrade
      </a>
      <br>

      <div class="brand-copy">
        <h2>welcome back. Your dashboard is right where you left it.</h2>
        <p>Log in to check your strategy performance, review recent trades, and manage your balance.</p>
      </div>

      <div class="brand-art">

        <img src="images/login.jpg" alt="" width="440" height="260" style="border-radius:14px; margin-bottom:28px;">
        <div class="brand-stats">
          <div>
            <div class="num">256-bit</div>
            <div class="label">Encryption standard</div>
          </div>
          <div>
            <div class="num">24/7</div>
            <div class="label">Account monitoring</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===================== RIGHT FORM PANEL ===================== -->
    <div class="form-panel">
      <div class="form-card">
        <span class="eyebrow">WELCOME BACK</span>
        <h1>Log in to your account</h1>
        <p class="sub">Enter your details below </p>

        <form method="POST" action='login.php' >
          <div class="field">
            <label for="loginUsername">Username</label>
            <div class="input-wrap">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.8" />
                <path d="M5 20C5 16.5 8.1 14 12 14C15.9 14 19 16.5 19 20" stroke="currentColor" stroke-width="1.8"
                  stroke-linecap="round" />
              </svg>
              <input type="text" id="Username" name="username" placeholder="jordan.lee">
            </div>
          </div>

          <div class="field">
            <label for="loginPassword">Password</label>
            <div class="input-wrap">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="11" width="14" height="9" rx="2" stroke="currentColor" stroke-width="1.8" />
                <path d="M8 11V7C8 4.8 9.8 3 12 3C14.2 3 16 4.8 16 7V11" stroke="currentColor" stroke-width="1.8" />
              </svg>
              <input type="password" id="Password" name="password" placeholder="••••••••" >
              <button type="button" class="toggle-pass" aria-label="Show password"
                onclick="togglePassword('loginPassword', this)">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                    stroke="currentColor" stroke-width="1.8" />
                  <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                </svg>
              </button>
            </div>
          </div>

             <?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

          <div class="row-between">
            <label class="remember">
              <input type="checkbox">
              Remember me
            </label>
            <a href="forgot_password.php">Forgot password?</a>
          </div>

          <button type="submit" name="submit" class="btn-submit">Log in</button>
        </form>

        <div class="divider">OR</div>
        <p class="switch-line">Don't have an account? <a href="signup.php">Sign up</a></p>

        <div class="trust-row">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor"
              stroke-width="1.8" stroke-linejoin="round" />
          </svg>
          Your connection is secured with encryption
        </div>
       
      </div>
    </div>

  </div>

  <script>
    function togglePassword(fieldId, btn) {
      const field = document.getElementById(fieldId);
      const isHidden = field.type === 'password';
      field.type = isHidden ? 'text' : 'password';
      btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
    }
  </script>

</body>

</html>