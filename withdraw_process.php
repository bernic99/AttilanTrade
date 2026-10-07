<?php 
session_start(); 
include('config/db_connect.php'); 

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
} 

$user_id = $_SESSION['user_id']; 
 
$stmt = $conn->prepare("SELECT price FROM users WHERE id = ?"); 
$stmt->bind_param("i", $user_id); 
$stmt->execute(); 
 
$result = $stmt->get_result(); 
$user = $result->fetch_assoc(); 
 
$balance = (float)$user['price'];


/* PROCESS WITHDRAWAL */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $amount = isset($_POST['amount']) ? (float)$_POST['amount'] : 0;

    
    // Check that amount is greater than 0
    if ($amount <= 0) {
         echo "<script>
        alert('invalid amount.');
        window.location.href = 'withdraw.php';
    </script>";
    exit();
    }

    // Check that user has enough balance
if ($amount > $balance) {
    echo "<script>
        alert('Insufficient balance.');
        window.location.href = 'withdraw.php';
    </script>";
    exit();
}

    // Save withdrawal transaction
    $transaction = $conn->prepare("
        INSERT INTO transactions (user_id, type, amount)
        VALUES (?, 'withdrawal', ?)
    ");

    $transaction->bind_param("id", $user_id, $amount);
    $transaction->execute();

    // Subtract withdrawal from user's balance
    $new_balance = $balance - $amount;

    $update = $conn->prepare("
        UPDATE users 
        SET price = ? 
        WHERE id = ?
    ");

    $update->bind_param("di", $new_balance, $user_id);
    $update->execute();

    // Redirect after successful withdrawal
    header("Location: withdrawal_success.php");
    exit;
}

?>