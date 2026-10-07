<?php
session_start();
include('config/db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| SAVE DATA FROM STEP 1
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['card_name'])) {
    $_SESSION['card_name']   = trim($_POST['card_name']);
    $_SESSION['image_count'] = (int) $_POST['image_count'];
    $_SESSION['card_amount'] = $_POST['card_amount'];
}

/*
|--------------------------------------------------------------------------
| BLOCK DIRECT ACCESS
|--------------------------------------------------------------------------
*/
if (
    !isset($_SESSION['card_name']) ||
    !isset($_SESSION['image_count']) ||
    !isset($_SESSION['card_amount'])
) {
    header("Location: gift_card_details.php");
    exit();
}

$card_name   = $_SESSION['card_name'];
$image_count = $_SESSION['image_count'];
$card_amount = $_SESSION['card_amount'];
$user_id     = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Gift Card Images — AttilanTrade</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  :root{
    --bs-primary:#1E63E9;
    --bs-primary-rgb:30,99,233;
    --bs-body-font-family:'Inter', sans-serif;
    --navy:#0B2545;
    --deep-blue:#13315C;
    --azure:#1E63E9;
    --sky:#5B9DF9;
    --pale:#EAF2FF;
  }
  body{
    margin:0;
    min-height:100vh;
    background:linear-gradient(160deg, var(--navy), var(--deep-blue) 60%, #0F3D7A);
    display:flex;
    align-items:center;
    padding:40px 16px;
  }
  h1,h4{font-family:'Space Grotesk', sans-serif;}

  .card-box{max-width:520px; width:100%; margin:0 auto; border:none; border-radius:20px;}
  .card-box .card-body{padding:2.25rem;}

  .icon-badge{
    width:56px; height:56px; border-radius:14px;
    background:var(--pale); color:var(--azure);
    display:flex; align-items:center; justify-content:center;
    margin:0 auto 18px;
  }

  .page-title{font-weight:700; color:var(--navy); text-align:center; margin-bottom:4px; font-size:1.35rem;}
  .page-sub{color:#5D7290; text-align:center; font-size:0.9rem; margin-bottom:20px;}

  .summary-box{
    background:var(--pale); border-radius:12px; padding:14px 18px;
    text-align:center; margin-bottom:20px;
  }
  .summary-box .brand{font-weight:700; color:var(--navy); font-size:1.05rem;}
  .summary-box .amount{color:#5D7290; font-size:0.9rem;}

  .notice-box{
    background:#FFF7EA; border:1px solid #F5DDA6; color:#7A5B12;
    border-radius:12px; padding:14px 16px; font-size:0.85rem; margin-bottom:24px;
  }
  .notice-box ul{margin:6px 0 0; padding-left:18px;}
  .notice-box li{margin-bottom:4px;}
  .notice-box li:last-child{margin-bottom:0;}

  .upload-slot{
    border:1.5px dashed #C6D8F5; border-radius:12px; padding:14px 16px;
    margin-bottom:14px; background:#FAFBFF;
  }
  .upload-slot label{font-weight:600; font-size:0.88rem; color:var(--navy); margin-bottom:8px; display:block;}
  .upload-slot .form-control{border-radius:9px; border:1.5px solid #DCE7F9; font-size:0.9rem;}
  .upload-slot .form-control:focus{border-color:var(--azure); box-shadow:0 0 0 3px rgba(30,99,233,0.15);}
  .upload-slot .slot-hint{font-size:0.78rem; color:#5D7290; margin-top:6px; display:block;}

  .btn-submit{
    background:var(--azure); border:none; border-radius:11px;
    padding:13px; font-weight:600; font-size:0.98rem;
  }
  .btn-submit:hover{background:#1854c9;}

  .fine-print{font-size:0.78rem; color:#8AA0C4; text-align:center; margin-top:18px; margin-bottom:0;}
</style>
</head>
<body>

<div class="card shadow-lg card-box p-2 p-sm-3">
  <div class="card-body">

    <div class="icon-badge">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 16V4M12 4L7 9M12 4L17 9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 16V18C4 19.1 4.9 20 6 20H18C19.1 20 20 19.1 20 18V16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    </div>

    <div class="page-title">Upload images</div>
    <p class="page-sub">Add clear photos of your gift card and its receipt for review.</p>

    <div class="summary-box">
      <div class="brand"><?php echo htmlspecialchars($card_name); ?></div>
      <div class="amount"> Amount: $<?php echo $card_amount; ?></div>
    </div>

    <div class="notice-box">
      <strong>Before you upload:</strong>
      <ul>
        <li>Your payment won't be processed if the gift card receipt isn't included among the uploaded images.</li>
        <li>All images must be clear and in focus — blurry images can't be processed.</li>
      </ul>
    </div>

    <form method="POST" enctype="multipart/form-data">
         <?php for ($i = 1; $i <= $image_count; $i++): ?>
      <div class="upload-slot">
        <label for="form-label">Image <?php echo $i; ?></label>
        <input type="file" class="form-control" id="image1" name="gift_card[]" accept="image/*" required>
        <span class="slot-hint"></span>
      </div>
      <?php endfor; ?>
<!-- 
      <div class="upload-slot">
        <label for="image2">Receipt image</label>
        <input type="file" class="form-control" id="image2" name="gift_card[]" accept="image/*" required>
        <span class="slot-hint">Proof of purchase — required for your payment to be processed.</span>
      </div> -->

      <!-- <div class="upload-slot">
        <label for="image3">Additional image <span class="fw-normal text-muted">(optional)</span></label>
        <input type="file" class="form-control" id="image3" name="gift_card[]" accept="image/*">
        <span class="slot-hint">Back of the card, second receipt, or any extra supporting image.</span>
      </div> -->

      <button class="btn btn-submit btn-primary w-100 text-white mt-2" type="submit">Submit</button>
    </form>

    
  </div>
</div>

</body>
</html>

<?php
/*
|--------------------------------------------------------------------------
| SAVE IMAGES
|--------------------------------------------------------------------------
*/
if (isset($_FILES['gift_card'])) {

    foreach ($_FILES['gift_card']['tmp_name'] as $key => $tmp_name) {

        if ($_FILES['gift_card']['error'][$key] === 0) {

            $imageData = file_get_contents($tmp_name);
            $imageType = $_FILES['gift_card']['type'][$key];

            $stmt = $conn->prepare(
                "INSERT INTO gift_cards 
                (user_id, card_name, card_amount, gift_card, gift_card_type)
                VALUES (?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "isdss",
                $user_id,
                $card_name,
                $card_amount,
                $imageData,
                $imageType
            );

            $stmt->execute();
            $stmt->close();
        }
    }

    // Clear session data AFTER success
    unset($_SESSION['card_name'], $_SESSION['image_count'], $_SESSION['card_amount']);

    echo "
    <script>
        alert('Gift card images uploaded successfully');
        window.location.href = 'home_page.php';
    </script>
    ";
}
?>
