
<?php  
include('config/db_connect.php');
$first_name = $last_name = $email = $phone_number = $new_username = $new_password =  $selected_country =  $selected_amount = '' ;
$errors = array('email'=>'', 'first_name'=>'', 'last_name'=>'', 'phone_number'=>'', 'new_username'=>'', 'new_password'=>'', 'country'=>'', 'start_amount'=>'' );


if(isset($_POST['submit'])){ 
  //check email
  if(empty($_POST['email'])){ 
    $errors['email']=  'Enter a valid email';
  }else{ 
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
      $errors['email']= 'Enter a valid email';

    }

  }
  //check first-name
  if(empty($_POST['first_name'])){ 
    $errors['first_name']= 'Enter a valid name';
  }else{ 
    $first_name = $_POST['first_name'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $first_name)){ 
      $errors['first_name']= 'Enter a valid name';
    }
    

  }
  //check last-name
  if(empty($_POST['last_name'])){ 
    $errors['last_name']= 'Enter a valid name';
  }else{ 
    $last_name = $_POST['last_name'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $last_name)){ 
      $errors['last_name']= 'Enter a valid name';
    }
    

  }

  //check phone_number
  if(empty($_POST['phone_number'])){ 
    $errors['phone_number']= 'Enter a valid Phone number';
  }else{ 
    $phone_number = $_POST['phone_number'];
    if(!preg_match("/^(\+?\d{1,3})?[\s\-\.]?\(?\d{3}\)?[\s\-\.]?\d{3}[\s\-\.]?\d{4}$/", $phone_number)){ 
      $errors['phone_number']= 'Enter a valid Phone number';
    }
    

  }

  //check username
  if(empty($_POST['new_username'])){ 
    $errors['new_username']= 'Enter a username';
  }else{ 
    $new_username = $_POST['new_username'];
    if(!preg_match("/^[a-zA-Z0-9]{6,}$/", $new_username)){ 
      $errors['new_username']= "Invalid username. It must be at least 6 characters long and contain only letters and numbers.";
    }
    

  }

  //check password
  if(empty($_POST['new_password'])){ 
    $errors['new_password']= 'Enter a Password';
  }else{ 
    $new_password = $_POST['new_password'];
    if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\W]{6,}$/", $new_password)){ 
      $errors['new_password']= 'Invalid password. It must be at least 6 characters long and include at least one letter and one number.';
    }
    

  }


  //check country
  $selected_country = $_POST['country'];
  if($_POST['country'] == "select" || $selected_country == ""){ 
    $errors['country']= 'Select a country';
   
  }

  //check start-up amount
  $selected_amount = $_POST['start_amount'];
  if($_POST['start_amount'] == "choose" || $selected_amount == ""){ 
    $errors['start_amount']= 'Select a start-up amount';
   
  }


if(array_filter($errors)){ 

}else{ 

  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
  $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
  $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
  $selected_country = mysqli_real_escape_string($conn, $_POST['country']);
  $selected_amount = mysqli_real_escape_string($conn, $_POST['start_amount']);

  //create sql
  $checksql = "SELECT * FROM users WHERE username = '$new_username'";
  $result = $conn->query($checksql);
  if($result->num_rows > 0){ 
    $errors['new_username']= 'Username already exists. Choose a different username.';
  }else{ 
    $sql = "INSERT INTO users(first_name, last_name, email, phone_number, username, new_password, country, start_amount)
    VALUES('$first_name', '$last_name', '$email', '$phone_number', '$new_username', '$new_password', '$selected_country', '$selected_amount')";
    
    // save to db
    if(mysqli_query($conn, $sql)){ 
     //success
     
     header('Location: account_created.php');
    }
    else{ 
     echo 'query error'. mysqli_error($conn);
    }

  }


}


}



?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up — AttilanTrade</title>
  <link rel="stylesheet" type="text/css" href="css/signup.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet">
  
</head>

<body>

  <div class="page">

    <!-- ===================== LEFT BRAND PANEL ===================== -->
    <div class="brand-panel">
      <a href="Attilan.html" class="brand">
      
        AttilanTrade
      </a>
      <br>

      <div class="brand-copy">
        <h2>Start your account and let a strategy get to work.</h2>
        <p>Set up your profile once, choose your starting amount, and watch performance from a live dashboard — all with
          full control over your funds.</p>
      </div>

      <div class="brand-art">
    
        <div class="brand-stats">
          <div>
            <div class="num">2 min</div>
            <div class="label">Average setup time</div>
          </div>
          <div>
            <div class="num">30+</div>
            <div class="label">Connected exchanges</div>
          </div>
          <div>
            <div class="num">24/7</div>
            <div class="label">Account support</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===================== RIGHT FORM PANEL ===================== -->
    <div class="form-panel">
      <div class="form-card">
        <span class="eyebrow">GET STARTED</span>
        <h1>Create your account</h1>
        <p class="sub">It only takes a couple of minutes </p>

        <form  method="POST" action='signup.php'>
          <div class="form-row">
            <div class="field">
              <label for="first-name">First name</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 12C14.2 12 16 10.2 16 8C16 5.8 14.2 4 12 4C9.8 4 8 5.8 8 8C8 10.2 9.8 12 12 12Z"
                    stroke="currentColor" stroke-width="1.8" />
                  <path d="M4 20C4 16.7 7.6 14 12 14C16.4 14 20 16.7 20 20" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" />
                </svg>
                <input type="text" id="first-name" name="first_name" value="<?php echo htmlspecialchars($first_name)  ?>" placeholder="Jordan">
                 <small class="errors"><?php echo $errors['first_name']; ?></small> 


              </div>
            </div>
            <div class="field">
              <label for="last-name">Last name</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 12C14.2 12 16 10.2 16 8C16 5.8 14.2 4 12 4C9.8 4 8 5.8 8 8C8 10.2 9.8 12 12 12Z"
                    stroke="currentColor" stroke-width="1.8" />
                  <path d="M4 20C4 16.7 7.6 14 12 14C16.4 14 20 16.7 20 20" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" />
                </svg>
                <input type="text" id="last-name" name="last_name" placeholder="Lee" value="<?php echo htmlspecialchars($last_name)  ?>"> 
                  <small class="errors"><?php echo $errors['last_name']; ?></small>

              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="field full">
              <label for="email">Email address</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4 4H20V18H4V4Z" stroke="currentColor" stroke-width="1.8" />
                  <path d="M4 6L12 13L20 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                <input type="email" id="email" name="email"  value="<?php echo htmlspecialchars($email)  ?>"  placeholder="you@email.com" >
                  <small class="errors"><?php echo $errors['email']; ?></small>

              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="field full">
              <label for="phone-number">Phone number</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M4 5H8L10 10L7 12C8 15 9 16 12 17L14 14L19 16V20C19 20.5523 18.5523 21 18 21C10 21 3 14 3 6C3 5.4477 3.4477 5 4 5Z"
                    stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                </svg>
                <input type="tel" id="phone-number" name="phone_number" value="<?php echo htmlspecialchars($phone_number)  ?>" placeholder="+1 (555) 019-2044" >
                 <small class="errors"><?php echo $errors['phone_number']; ?></small>


              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="field full">
              <label for="username">Create username</label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.8" />
                  <path d="M5 20C5 16.5 8.1 14 12 14C15.9 14 19 16.5 19 20" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" />
                </svg>
                <input type="text" id="username" name="new_username" value="<?php echo htmlspecialchars($new_username)  ?>" placeholder="jordan.lee" >
                  <small class="errors"><?php echo $errors['new_username']; ?></small>



              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="field full">
              <label for="new-password">Create password <span class="hint">— min. 8 characters</span></label>
              <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="5" y="11" width="14" height="9" rx="2" stroke="currentColor" stroke-width="1.8" />
                  <path d="M8 11V7C8 4.8 9.8 3 12 3C14.2 3 16 4.8 16 7V11" stroke="currentColor" stroke-width="1.8" />
                </svg>
                <input type="password" id="password" name="new_password" placeholder="••••••••" minlength="8" value="<?php echo htmlspecialchars($new_password)  ?>" required>
                 <small class="errors"><?php echo $errors['new_password']; ?></small>


                <button type="button" class="toggle-pass" aria-label="Show password"
                  onclick="togglePassword('password', this)">
                  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                      stroke="currentColor" stroke-width="1.8" />
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label for="country">Country</label>
              <div class="input-wrap">
                <select id="country" name="country" value="<?php echo htmlspecialchars($country)  ?>"  class="field-plain">


                  <option value="select">select</option>
                  <option value="Australia" <?php if ($selected_country == "Australia") echo 'selected="selected"'; ?>>Australia</option>
        
       
       
       
        <option value="Belgium" <?php if ($selected_country == "Belgium") echo 'selected="selected"'; ?>>Belgium</option>
        
        <option value="Brazil" <?php if ($selected_country == "Brazil") echo 'selected="selected"'; ?>>Brazil</option>
        
        <option value="Canada" <?php if ($selected_country == "Canada") echo 'selected="selected"'; ?>>Canada</option>
        
        <option value="China" <?php if ($selected_country == "China") echo 'selected="selected"'; ?>>China</option>
        
        
        <option value="Cyprus" <?php if ($selected_country == "Cyprus") echo 'selected="selected"'; ?>>Cyprus</option>
        
        <option value="Denmark" <?php if ($selected_country == "Denmark") echo 'selected="selected"'; ?>>Denmark</option>
        
        
        <option value="Germany" <?php if ($selected_country == "Germany") echo 'selected="selected"'; ?>>Germany</option>
        <option value="Ghana" <?php if ($selected_country == "Ghana") echo 'selected="selected"'; ?>>Ghana</option>
       
        <option value="Greece" <?php if ($selected_country == "Greece") echo 'selected="selected"'; ?>>Greece</option>
        
        <option value="Hong Kong" <?php if ($selected_country == "Hong Kong") echo 'selected="selected"'; ?>>Hong Kong</option>
       
        <option value="India" <?php if ($selected_country == "India") echo 'selected="selected"'; ?>>India</option>
       
        <option value="Italy" <?php if ($selected_country == "Italy") echo 'selected="selected"'; ?>>Italy</option>
        <option value="Jamaica" <?php if ($selected_country == "Jamaica") echo 'selected="selected"'; ?>>Jamaica</option>
        <option value="Japan" <?php if ($selected_country == "Japan") echo 'selected="selected"'; ?>>Japan</option>
        
        <option value="Kenya" <?php if ($selected_country == "Kenya") echo 'selected="selected"'; ?>>Kenya</option>
        
       
       
        <option value="Malaysia" <?php if ($selected_country == "Malaysia") echo 'selected="selected"'; ?>>Malaysia</option>
        
        <option value="Mexico" <?php if ($selected_country == "Mexico") echo 'selected="selected"'; ?>>Mexico</option>
      
        <option value="Netherlands" <?php if ($selected_country == "Netherlands") echo 'selected="selected"'; ?>>Netherlands</option>
        
        <option value="New Zealand" <?php if ($selected_country == "New zealand") echo 'selected="selected"'; ?>>New Zealand</option>
       
        
        <option value="Nigeria" <?php if ($selected_country == "Nigeria") echo 'selected="selected"'; ?>>Nigeria</option>
        
        
        <option value="Philippines" <?php if ($selected_country == "Philippines") echo 'selected="selected"'; ?>>Philippines</option>
        
        <option value="Poland" <?php if ($selected_country == "Poland") echo 'selected="selected"'; ?>>Poland</option>
        
        
        <option value="Spain" <?php if ($selected_country == "Spain") echo 'selected="selected"'; ?>>Spain</option>
        
       
        <option value="Turkey" <?php if ($selected_country == "Turkey") echo 'selected="selected"'; ?>>Turkey</option>
        <option value="Thailand" <?php if ($selected_country == "Thailand") echo 'selected="selected"'; ?>>Thailand</option>
        
        
        
        <option value="United Kingdom" <?php if ($selected_country == "United Kingdom") echo 'selected="selected"'; ?>>United Kingdom</option>
        <option value="United States" <?php if ($selected_country == "United States") echo 'selected="selected"'; ?>>United States</option>

       
        <option value="Venezuela" <?php if ($selected_country == "Venezuela") echo 'selected="selected"'; ?>>Venezuela</option>
        <option value="Viet Nam" <?php if ($selected_country == "Viet Nam") echo 'selected="selected"'; ?>>Viet Nam</option>
        <option value="Virgin Islands, British" <?php if ($selected_country == "Virgin Islands, British") echo 'selected="selected"'; ?>>Virgin Islands, British</option>
        <option value="Virgin Islands, U.S." <?php if ($selected_country == "Virgin Islands, U.S.") echo 'selected="selected"'; ?>>Virgin Islands, U.S.</option>
        
                </select>
                <small class="errors"><?php echo $errors['country']; ?></small>
              </div>
            </div> 



            <div class="field">
              <label for="startAmount">Start-up amount</label>
              <div class="input-wrap">
                <select id="amount" name="start_amount" class="field-plain" >
                  <option value="choose" >choose amount</option>
                  <option value="100,00" <?php if ($selected_amount == "100.00") echo 'selected="selected"'; ?>>100.00</option>
        <option value="500.00" <?php if ($selected_amount == "500.00") echo 'selected="selected"'; ?>>500.00</option>
        <option value="1,000.00" <?php if ($selected_amount == "1,000.00") echo 'selected="selected"'; ?>>1,000.00</option>
        <option value="5,000.00" <?php if ($selected_amount == "5,000.00") echo 'selected="selected"'; ?>>5,000.00</option>
        <option value="10,000.00" <?php if ($selected_amount == "10,000.00") echo 'selected="selected"'; ?>>10,000.00</option>

                </select>
                   <small class="errors"><?php echo $errors['start_amount']; ?></small>
              </div>
            </div>
          </div>

          <label class="terms">
            <input type="checkbox" required>
            <span>I agree to the <a href="#">Terms of Service</a> and acknowledge the <a href="#">risk disclosure</a>
              for cryptocurrency trading.</span>
          </label>

          <button type="submit" name="submit" class="btn-submit">Create account</button>
        </form>

        <div class="divider">OR</div>
        <p class="switch-line">Already have an account? <a href="login.php">Log in</a></p>
       
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