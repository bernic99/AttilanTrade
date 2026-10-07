<?php  
include('config/db_connect.php');
// SQL to get all user records
$sql = "SELECT * FROM users";

// Execute SQL and get result
$query = mysqli_query($conn, $sql);

// Create empty array to hold all rows
$result = array();

// Loop through each record and add to result array
while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
}


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

<a href="chat/mnt/user-data/outputs/AttilanTrade"><button>Live chat</button></a>
    <div class="container mt-5">
    <h2 class="mb-4">All USERS</h2>

    <!-- Loop through users and show only selected info -->
    <?php foreach ($result as $user) { ?>
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
                <p><strong>Name:</strong> <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $user['phone_number']; ?></p>
                <p><strong>Created At:</strong> <?php echo $user['created_at']; ?></p>

                <!-- More Info & Delete buttons -->
                <a href="user_info.php?id=<?php echo $user['id']; ?>" class="btn btn-info">More Info</a>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        </div>
    <?php } ?>

</div>
</body>
</html>