<?php
// price_update.php
include('config/db_connect.php');

// Ensure an ID is passed
if (!isset($_GET['id'])) {
    die("No user selected.");
}

$user_id = intval($_GET['id']); // Sanitize ID

// Handle the form submission
if (isset($_POST['update_price'])) {
    $new_price = floatval($_POST['price']);

    // Update the user's price in the database
    $stmt = $conn->prepare("UPDATE users SET price = ? WHERE id = ?");
    $stmt->bind_param("di", $new_price, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Account balance updated successfully!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating balance. Please try again.');</script>";
    }

    $stmt->close();
}

// Fetch current user info
$stmt = $conn->prepare("SELECT first_name, email, price FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}

$stmt->close();
$conn->close();
?>


 
  
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Account Balance | Loan Wave</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f2f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .form-container {
        background: #fff;
        padding: 25px 35px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        width: 400px;
    }
    h2 {
        text-align: center;
        color: #003366;
    }
    label {
        font-weight: bold;
        display: block;
        margin-top: 15px;
    }
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-top: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
    button {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
    }
    button:hover {
        background: #0056b3;
    }
    .back-btn {
        display: block;
        text-align: center;
        margin-top: 15px;
        text-decoration: none;
        color: #007bff;
    }
</style>
</head>
<body>

<div class="form-container">
    <h2>Update Balance</h2>

    <p><strong>User:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Current Balance:</strong> ₦<?php echo number_format($user['price'], 2); ?></p>

    <form method="POST">
        <label for="price">New Account Balance (₦):</label>
        <input type="number" name="price" id="price" step="0.01" value="<?php echo $user['price']; ?>" required>
        
        <button type="submit" name="update_price">Update Balance</button>
    </form>

    <a href="admin_dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>

</body>
</html>