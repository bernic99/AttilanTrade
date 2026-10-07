<?php
session_start();
include('config/db_connect.php');

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// --- Database connection ---


// --- Get transactions for this user only (prepared statement = safe from SQL injection) ---
$stmt = $conn->prepare("SELECT type, amount, transaction_date FROM transactions WHERE user_id = ? ORDER BY transaction_date DESC");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$transactions = [];
$total_in = 0;
$total_out = 0;

while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
    if ($row['type'] === 'deposit') {
        $total_in += $row['amount'];
    } else {
        $total_out += $row['amount'];
    }
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaction History - AttilanTrade</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Only two colors used: dark green (--dark) and mint (--mint) */
    :root {
        --dark: #13315C;
        --mint: #00D98E;
         
    }
    body {
        background: #f5f5f5;
        color: var(--dark);
        font-family: Arial, sans-serif;
    }
    .header {
        background: var(--dark);
        color: #fff;
        padding: 20px;
    }
    .summary {
        max-width: 700px;
        margin: 20px auto;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
    }
    .summary div {
        text-align: center;
    }
    .summary .label {
        font-size: 13px;
        color: #666;
    }
    .summary .value {
        font-size: 20px;
        font-weight: bold;
    }
    .deposit-color { color: var(--mint); }
    .withdrawal-color { color: var(--dark); }

    .list {
        max-width: 700px;
        margin: 0 auto 40px;
        padding: 0 15px;
    }
    .item {
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 10px;
        padding: 12px 15px;
        margin-bottom: 10px;
    }
    .icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 12px;
        color: #fff;
    }
    .icon.deposit { background: var(--mint); }
    .icon.withdrawal { background: var(--dark); }

    .info { flex: 1; }
    .info .type { font-weight: bold; }
    .info .date { font-size: 13px; color: #777; }

    .amount { font-weight: bold; font-size: 16px; }
</style>
</head>
<body>

<div class="header">
    <h2 class="m-0">AttilanTrade</h2>
</div>

<div class="summary">
    <div>
        <div class="label">Total Deposits</div>
        <div class="value deposit-color">$<?php echo number_format($total_in, 2); ?></div>
    </div>
    <div>
        <div class="label">Total Withdrawals</div>
        <div class="value withdrawal-color">$<?php echo number_format($total_out, 2); ?></div>
    </div>
</div>

<div class="list">
<h4 class="mb-3">Transaction History</h4>

<?php if (count($transactions) === 0): ?>
    <p>No transactions yet.</p>
<?php else: ?>
    <?php foreach ($transactions as $t): ?>
        <?php
            $is_deposit = $t['type'] === 'deposit';
            $sign = $is_deposit ? '+' : '-';
        ?>
        <div class="item">
            <div class="icon <?php echo $is_deposit ? 'deposit' : 'withdrawal'; ?>">
                <?php echo $is_deposit ? '↓' : '↑'; ?>
            </div>
            <div class="info">
                <div class="type"><?php echo $is_deposit ? 'Deposit' : 'Withdrawal'; ?></div>
                <div class="date"><?php echo date('d M Y, g:i A', strtotime($t['transaction_date'])); ?></div>
            </div>
            <div class="amount <?php echo $is_deposit ? 'deposit-color' : 'withdrawal-color'; ?>">
                <?php echo $sign . '$' . number_format($t['amount'], 2); ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</div>

</body>
</html>