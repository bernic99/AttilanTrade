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




?>



<!DOCTYPE html>
<html>
<head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw Funds</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style> 
    body{ 
         background-color: #0B2545;
    }
 h4{ 
    color: #1e63e9;
 }
    label,option{ 
         color:#0B2545 ;
    }
    .withdraw_btn{ 
         background-color: #1E63E9;
         color:white;
         border:none;
         padding:5px;
         
    }
   .backBtn a {
    text-decoration: none;
    color: rgb(232, 174, 153);
    font-size: 30px;
    
       

}
.backBtn {
    margin-top: 50px;
    margin-left: 17px;
    margin-bottom: 20px;

    width: 40px;

      background-color: #011932;
    border: none;

    border-radius: 10px;


}
.available{ 
      color: blue;
    
}

</style>
<body class=" py-5">
     <button class="backBtn"><a href="home_page.php">
            < </a></button>

<div class="container py-5 ">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card  withdraw p-4 rounded-4">
                <h4 class="text-center mb-4">Withdraw Funds</h4>

                <form method="POST" action="withdraw_process.php">

                    <!-- Asset -->
                    <div class="mb-3">
                        <label>Select Asset</label>
                        <select name="asset" class="form-select" required>
                            <option value="BTC">Bitcoin (BTC)</option>
                            <option value="ETH">Ethereum (ETH)</option>
                            <option value="ETH">TRX</option>
                            <option value="ETH">USDT</option>
                            <option value="ETH">SOL</option>
                        </select>
                    </div>

                    <!-- Wallet Address -->
                    <div class="mb-3">
                        <label>Wallet Address</label>
                        <div class="input-group">
                            <input type="text" name="wallet_address" id="wallet_address"
                                   class="form-control"
                                   placeholder="Paste wallet address" required>
                            <button type="button"
                                    class="btn btn-outline-secondary"
                                    onclick="pasteAddress()">
                                PASTE
                            </button>
                        </div>
                    </div>

                    <!-- Amount -->
                    <div class="mb-3">
                        <label>Amount (USD)</label>
                        <div class="input-group">
                            <input type="number" step="0.01" id="amount" name="amount"
                                   class="form-control" required>
                            <button type="button"
                                    class="btn btn-outline-primary"
                                    onclick="setAll()">ALL</button>
                        </div>
                        <small class=" available">
                            Available Balance: $<?= number_format($balance, 2) ?>
                        </small>
                    </div>

                    <!-- NOTE / WARNING -->
                    <div class="alert alert-warning">
                        <strong>NOTE:</strong><br>
                        Withdrawable Amount: 0.07954094 BTC
                        24hrs Withdrawal Limit:  5000/5000 USD 
                        Max Withdrawal/Time: 48hrs <br><br>
                        
                       <small>In order to ensure the security of funds, when your account security policy
                        changes,password changes, we will manually audit the withdrawal. please wait patiently for
                        the staff to contact you by phone or email.</small> 
                    </div>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <button class=" rounded withdraw_btn w-100">
                        Confirm Withdrawal
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
function setAll() {
    let balance = <?= $balance ?>;
    if (balance <= 0) {
        alert("Your balance is zero.");
        return;
    }
    document.getElementById('amount').value = balance;
}

/* PASTE WALLET ADDRESS */
async function pasteAddress() {
    try {
        const text = await navigator.clipboard.readText();
        if (!text) {
            alert("Clipboard is empty.");
            return;
        }
        document.getElementById('wallet_address').value = text;
    } catch (err) {
        alert("Clipboard access denied. Please paste manually.");
    }
}
</script>

</body>
</html>

