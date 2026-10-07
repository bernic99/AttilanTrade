<?php   
include('config/db_connect.php');
// Get user ID from URL
$user_id = $_GET['id'];

// Query to get the selected user
$sql = "SELECT * FROM users WHERE id = $user_id";

// Run the query
$query = mysqli_query($conn, $sql);

// Get the user as an associative array
$user = mysqli_fetch_assoc($query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
    <h2>User Full Information</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['phone_number']; ?></p>
            <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
            <p><strong>Password:</strong> <?php echo $user['new_password']; ?></p>
            <p><strong>Country:</strong> <?php echo $user['country']; ?></p>
            <p><strong>Start-up amount:</strong> <?php echo $user['start_amount']; ?></p>
            <p><strong>Created At:</strong> <?php echo $user['created_at']; ?></p>
            

            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this user?')">Delete User</a>
            <a href="admin_dashboard.php" class="btn btn-secondary">Back</a>
            <a href="price_update.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Update Price</a>
            <a href="admin_view_uploads.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">payment screenshot</a>
            <a href="admin_view_gift_cards.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">gift card screenshot</a>

        </div>
    </div>
</div>
</body>
</html>