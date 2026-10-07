<?php
session_start();



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gift Card Details — AttilanTrade</title>
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
  h1,h4,.brandline{font-family:'Space Grotesk', sans-serif;}

  .card-box{max-width:480px; width:100%; margin:0 auto; border:none; border-radius:20px;}
  .card-box .card-body{padding:2.25rem;}

  .icon-badge{
    width:56px; height:56px; border-radius:14px;
    background:var(--pale); color:var(--azure);
    display:flex; align-items:center; justify-content:center;
    margin:0 auto 18px;
  }

  .page-title{font-weight:700; color:var(--navy); text-align:center; margin-bottom:4px; font-size:1.35rem;}
  .page-sub{color:#5D7290; text-align:center; font-size:0.9rem; margin-bottom:28px;}

  .form-floating > .form-control{
    border-radius:11px; border:1.5px solid #DCE7F9; font-size:0.95rem;
  }
  .form-floating > label{color:#5D7290; font-size:0.9rem;}
  .form-floating > .form-control:focus{
    border-color:var(--azure); box-shadow:0 0 0 3px rgba(30,99,233,0.15);
  }
  .field-hint{font-size:0.8rem; color:#5D7290; margin-top:6px; display:block;}

  .btn-continue{
    background:var(--azure); border:none; border-radius:11px;
    padding:13px; font-weight:600; font-size:0.98rem;
  }
  .btn-continue:hover{background:#1854c9;}

  .fine-print{font-size:0.78rem; color:#8AA0C4; text-align:center; margin-top:18px; margin-bottom:0;}
</style>
</head>
<body>

<div class="card shadow-lg card-box p-2 p-sm-3">
  <div class="card-body">

    <div class="icon-badge">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="7" width="18" height="12" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M3 11H21" stroke="currentColor" stroke-width="1.8"/><path d="M8 7C8 5.3 9.3 4 11 4C12.1 4 13 4.9 13 6C13 4.9 13.9 4 15 4C16.7 4 18 5.3 18 7" stroke="currentColor" stroke-width="1.6"/></svg>
    </div>

    <div class="page-title">Pay with gift card</div>
    <p class="page-sub">Enter your gift card details below to submit it for review.</p>

    <form method="POST" action="giftcard_upload.php">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="card_name" name="card_name" placeholder="Gift card brand" required>
        <label for="card_name">Gift card name</label>
      </div>

      <div class="form-floating mb-1">
        <input type="number" class="form-control" id="image_count" name="image_count" min="1" max="10" placeholder="Number of images" required>
        <label for="image_count">Number of images</label>
      </div>
      <span class="field-hint mb-3 d-block">Number of gift card and receipt images you'll upload next.</span>

      <div class="form-floating mb-4">
        <input type="number" class="form-control" id="card_amount" name="card_amount" step="0.01" placeholder="Gift card amount" required>
        <label for="card_amount">Gift card amount ($)</label>
      </div>

      <button class="btn btn-continue btn-primary w-100 text-white" type="submit">Continue</button>
    </form>

   
  </div>
</div>

</body>
</html>
