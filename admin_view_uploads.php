<?php
include('config/db_connect.php');

if (!isset($_GET['id'])) {
    die("No user selected.");
}

$user_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT screenshot, screenshot_type FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("No screenshot found for this user.");
}

$stmt->bind_result($screenshot, $screenshot_type);
$stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Screenshot</title>
    <style>
        img {
            max-width: 500px;
            border: 2px solid #ccc;
            padding: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Screenshot for User ID: <?php echo $user_id; ?></h2>

<?php
if ($screenshot) {
    echo '<img src="data:' . $screenshot_type . ';base64,' . base64_encode($screenshot) . '" />';
} else {
    echo "<p>No image uploaded.</p>";
}
?>

</body>
</html>
