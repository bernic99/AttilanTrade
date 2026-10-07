<?php
include('config/db_connect.php');

if (!isset($_GET['id'])) {
    die("User ID missing");
}

$user_id = intval($_GET['id']);

$stmt = $conn->prepare(
    "SELECT card_name, card_amount, gift_card, gift_card_type, uploaded_at
     FROM gift_cards
     WHERE user_id = ?"
);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Gift Cards</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (place before </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        img {
            width: 900px;
            margin: 10px;
            border: 2px solid #ccc;
            padding: 5px;
        }
    </style>
</head>
<body>

<h2>Gift Cards for User ID: <?php echo $user_id; ?></h2>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<div>";
        echo "<p><strong>{$row['card_name']}</strong> — \${$row['card_amount']}</p>";
        echo '<img src="data:' . $row['gift_card_type'] . ';base64,' . base64_encode($row['gift_card']) . '">';
        echo "<p>{$row['uploaded_at']}</p>";
        echo "</div><hr>";
    }
} else {
    echo "<p>No gift cards found.</p>";
}
?>

</body>
</html>
