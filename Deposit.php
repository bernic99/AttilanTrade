<?php
session_start();
include('config/db_connect.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user data
$user_id = $_SESSION['user_id'];

$errors = [];
$success = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['screenshot']) || $_FILES['screenshot']['error'] !== 0) {
        $errors['screenshot'] = "Screenshot required.";
    }

  

    if (empty($errors)) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $screenshot_name = time() . '_front_' . basename($_FILES['screenshot']['name']);
       

        move_uploaded_file($_FILES['screenshot']['tmp_name'], $upload_dir . $screenshot_name);
      

        // Store to database
     

   
        $screenshot = $conn->real_escape_string($upload_dir . $screenshot_name);
       

      $sql = "UPDATE users SET screenshot = '$screenshot_name' WHERE id = $user_id";

   if ($conn->query($sql) === TRUE) {

    echo "
   <script>
        alert('Your Payment is being processed');
        setTimeout(() => {
            window.location.href = 'home_page.php';
        }, 2000);
    </script>
";

} else {
    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
}




$conn->close();

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Deposit Funds — AttilanTrade</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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
  body{background:#F4F8FF; color:#10233F;}
  h1,h2,h3,h4,h5{font-family:'Space Grotesk', sans-serif;}
  .text-navy{color:var(--navy) !important;}
  .bg-pale{background-color:var(--pale) !important;}

  .back-link{
    color:var(--azure); font-weight:600; font-size:0.92rem;
    display:inline-flex; align-items:center; gap:6px; text-decoration:none;
  }
  .back-link:hover{color:#1854c9;}

  /* ---------- Method tabs ---------- */
  .method-tabs{display:flex; gap:10px; flex-wrap:wrap; margin-bottom:24px;}
  .method-tab{
    border:1.5px solid #DCE7F9; background:#fff; color:var(--navy);
    border-radius:11px; padding:11px 18px; font-weight:600; font-size:0.92rem;
    display:inline-flex; align-items:center; gap:8px; cursor:pointer;
  }
  .method-tab svg{width:17px; height:17px; color:#5D7290;}
  .method-tab.active{background:var(--azure); border-color:var(--azure); color:#fff;}
  .method-tab.active svg{color:#fff;}

  section.method-section{display:none;}
  section.method-section.active{display:block;}

  .panel-card{border:1px solid #DCE7F9; border-radius:16px; background:#fff;}

  /* ---------- Coin selector ---------- */
  .coin-option{
    border:1.5px solid #DCE7F9; border-radius:14px; padding:16px;
    display:flex; align-items:center; gap:12px; cursor:pointer; height:100%;
    transition:border-color .15s ease, background .15s ease;
  }
  .coin-option:hover{border-color:var(--sky);}
  .coin-option.selected{border-color:var(--azure); background:var(--pale);}
  .coin-icon{
    width:42px; height:42px; border-radius:50%; background:var(--pale); color:var(--azure);
    display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.8rem; flex-shrink:0;
  }
  .coin-option.selected .coin-icon{background:#fff;}
  .coin-name{font-weight:600; color:var(--navy); font-size:0.95rem;}
  .coin-sub{font-size:0.78rem; color:#5D7290;}
  .coin-check{
    margin-left:auto; width:20px; height:20px; border-radius:50%; border:2px solid #DCE7F9;
    flex-shrink:0; display:flex; align-items:center; justify-content:center;
  }
  .coin-option.selected .coin-check{border-color:var(--azure); background:var(--azure);}
  .coin-option.selected .coin-check svg{display:block;}
  .coin-check svg{display:none; width:11px; height:11px; color:#fff;}

  /* ---------- Address panel ---------- */
  .address-panel{background:var(--pale); border-radius:14px; padding:20px;}
  .qr-box{
    width:150px; height:150px; background:#fff; border:1px solid #DCE7F9; border-radius:12px;
    display:flex; align-items:center; justify-content:center; margin:0 auto;
    flex-shrink:0;
  }
  .address-value{
    font-family:monospace; font-size:0.85rem; background:#fff; border:1px solid #DCE7F9;
    border-radius:9px; padding:10px 12px; word-break:break-all;
  }
  .copy-btn{
    border:1px solid #DCE7F9; background:#fff; color:var(--azure);
    border-radius:8px; width:38px; height:38px; display:flex; align-items:center; justify-content:center;
    flex-shrink:0; transition:background .15s ease;
  }
  .copy-btn:hover{background:#fff; box-shadow:0 2px 6px rgba(11,37,69,0.08);}
  .copy-btn.copied{background:#1FA971; border-color:#1FA971; color:#fff;}

  .network-note{
    background:#FFF7EA; border:1px solid #F5DDA6; color:#7A5B12;
    border-radius:10px; padding:12px 14px; font-size:0.85rem;
  }

  /* ---------- Gift card ---------- */
  .giftcard-brand{
    border:1.5px solid #DCE7F9; border-radius:12px; padding:14px 10px; text-align:center;
    cursor:pointer; font-weight:600; font-size:0.85rem; color:var(--navy); height:100%;
  }
  .giftcard-brand.selected{border-color:var(--azure); background:var(--pale);}

  /* ---------- Other / unavailable options ---------- */
  .other-option{
    border:1.5px solid #EDF1F9; border-radius:14px; padding:18px; background:#FAFBFF;
    display:flex; align-items:center; gap:14px; opacity:0.75; height:100%;
  }
  .other-icon{
    width:44px; height:44px; border-radius:10px; background:#EDF1F9; color:#8AA0C4;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
  }
  .unavailable-badge{
    font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.02em;
    background:#F0F1F5; color:#7A8394; padding:4px 10px; border-radius:20px;
  }

  .form-label{font-weight:600; font-size:0.85rem; color:var(--navy);}

  .action-toast{
    position:fixed; bottom:20px; right:20px; left:20px; z-index:1080;
    max-width:420px; margin-left:auto;
    background:#0B2545; color:#fff; border-radius:14px; padding:16px 18px;
    box-shadow:0 20px 40px rgba(11,37,69,0.3);
    display:none; align-items:center; gap:12px;
  }
  .action-toast.show{display:flex;}
  .action-toast svg{color:#7BE0AE; flex-shrink:0;}

  @media (max-width: 451px){
    .method-tabs{gap:8px;}
    .method-tab{padding:9px 14px; font-size:0.86rem;}
    .action-toast{right:12px; left:12px;}
  }
</style>
</head>
<body>

<div class="container py-4 py-lg-5" style="max-width:920px;">

  <!-- ===================== HEADER (no navbar/logo, per request) ===================== -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
      <h1 class="h4 text-navy mb-1">Deposit funds</h1>
      <p class="text-muted mb-0 small">Add funds to your AttilanTrade account using any of the methods below.</p>
    </div>
    <a href="home_page.php" class="back-link">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 12H5M5 12L11 6M5 12L11 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Back to dashboard
    </a>
  </div>

  <!-- ===================== METHOD TABS ===================== -->
  <div class="method-tabs" id="methodTabs">
    <button class="method-tab active" data-target="section-crypto" type="button">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M9 8H14C15.1 8 16 8.9 16 10C16 11.1 15.1 12 14 12H9M9 12H14.5C15.6 12 16.5 12.9 16.5 14C16.5 15.1 15.6 16 14.5 16H9M11 6V8M11 16V18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
      Cryptocurrency
    </button>
    <a href="gift_card_details.php"><button class="method-tab" data-target="section-giftcard" type="button">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="7" width="18" height="12" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M3 11H21" stroke="currentColor" stroke-width="1.8"/><path d="M8 7C8 5.3 9.3 4 11 4C12.1 4 13 4.9 13 6C13 4.9 13.9 4 15 4C16.7 4 18 5.3 18 7" stroke="currentColor" stroke-width="1.6"/></svg>
      Gift Card
    </button></a>
    <button class="method-tab" data-target="section-other" type="button">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M3 9H21" stroke="currentColor" stroke-width="1.8"/></svg>
      Other options
    </button>
  </div>

  <!-- ===================== CRYPTOCURRENCY ===================== -->
  <section class="method-section active" id="section-crypto">
    <div class="card panel-card mb-3">
      <div class="card-body p-4">
        <h3 class="h6 text-navy mb-3">Select a cryptocurrency</h3>
        <div class="row g-3" id="coinGrid">
          <div class="col-12 col-sm-4">
            <div class="coin-option selected" data-coin="Bitcoin" data-symbol="BTC" data-network="Bitcoin network (BTC)">
              <span class="coin-icon">BTC</span>
              <div>
                <div class="coin-name">Bitcoin</div>
                <div class="coin-sub">BTC</div>
              </div>
              <span class="coin-check"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
          </div>
          <div class="col-12 col-sm-4">
            <div class="coin-option" data-coin="Ethereum" data-symbol="ETH" data-network="Ethereum (ERC-20)">
              <span class="coin-icon">ETH</span>
              <div>
                <div class="coin-name">Ethereum</div>
                <div class="coin-sub">ETH</div>
              </div>
              <span class="coin-check"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
          </div>
          <div class="col-12 col-sm-4">
            <div class="coin-option" data-coin="Tether" data-symbol="USDT" data-network="Tether (TRC-20)">
              <span class="coin-icon">USDT</span>
              <div>
                <div class="coin-name">Tether</div>
                <div class="coin-sub">USDT</div>
              </div>
              <span class="coin-check"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card panel-card">
      <div class="card-body p-4">
        <h3 class="h6 text-navy mb-3">Send <span id="selectedCoinLabel">Bitcoin (BTC)</span> to this address</h3>

        <div class="address-panel">
          <div class="row g-4 align-items-center">
            <div class="col-md-4 text-center">
              <!-- <div class="qr-box">
                <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder QR code">
                  <rect width="90" height="90" fill="white"/>
                  <g fill="#0B2545">
                    <rect x="4" y="4" width="20" height="20"/><rect x="8" y="8" width="12" height="12" fill="white"/><rect x="11" y="11" width="6" height="6"/>
                    <rect x="66" y="4" width="20" height="20"/><rect x="70" y="8" width="12" height="12" fill="white"/><rect x="73" y="11" width="6" height="6"/>
                    <rect x="4" y="66" width="20" height="20"/><rect x="8" y="70" width="12" height="12" fill="white"/><rect x="11" y="73" width="6" height="6"/>
                    <rect x="32" y="4" width="6" height="6"/><rect x="44" y="4" width="6" height="6"/><rect x="56" y="10" width="6" height="6"/>
                    <rect x="32" y="16" width="6" height="6"/><rect x="44" y="22" width="6" height="6"/><rect x="32" y="32" width="6" height="6"/>
                    <rect x="44" y="32" width="6" height="6"/><rect x="56" y="32" width="6" height="6"/><rect x="32" y="44" width="6" height="6"/>
                    <rect x="66" y="44" width="6" height="6"/><rect x="76" y="44" width="6" height="6"/><rect x="44" y="50" width="6" height="6"/>
                    <rect x="56" y="56" width="6" height="6"/><rect x="66" y="56" width="6" height="6"/><rect x="32" y="60" width="6" height="6"/>
                    <rect x="76" y="66" width="6" height="6"/><rect x="44" y="70" width="6" height="6"/><rect x="56" y="76" width="6" height="6"/>
                    <rect x="66" y="76" width="6" height="6"/>
                  </g>
                </svg>
              </div> -->
            </div>
            <div class="col-md-8">
              <label class="form-label mb-1">Deposit address</label>
              <div class="d-flex align-items-center gap-2">
                <div class="address-value flex-grow-1" id="addressValue">bc1qtpsrfqmwwxwgaeuucs4msqkrznkm4nelr2h7ck</div>
                <button class="copy-btn" id="copyAddressBtn" type="button" aria-label="Copy address">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="9" y="9" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M5 15V5C5 3.9 5.9 3 7 3H15" stroke="currentColor" stroke-width="1.8"/></svg>
                </button>
              </div>
              <div class="network-note mt-3 d-flex gap-2 align-items-start">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mt-1"><path d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18A2 2 0 0 0 3.55 21H20.45A2 2 0 0 0 22.18 18L13.71 3.86A2 2 0 0 0 10.29 3.86Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Only send <strong id="networkLabel">Bitcoin network (BTC)</strong> assets to this address. Sending any other asset or using the wrong network may result in permanent loss of funds.</span>
              </div>
            </div>
          </div>
        </div>
  <form method="POST" action="" enctype="multipart/form-data">
        <div class="row g-3 mt-1">
          <div class="col-sm-6">
            <label class="form-label" for="cryptoAmount">Amount sent (USD equivalent)</label>
            <input type="number" class="form-control" id="cryptoAmount" placeholder="e.g. 500" min="1">
                <label>Upload Screenshot of Payment:</label>
    <input type="file" name="screenshot">
    <?php if (isset($errors['screenshot'])) echo '<p style="color:red;">' . $errors['screenshot'] . '</p>'; ?>
          </div>
          <div class="col-sm-6 d-flex align-items-end">
            <button class="btn btn-primary w-100" id="confirmCryptoBtn" type="submit">I've sent the funds</button>
          </div>
        </div>
        
      </div>
    </div>
  </section>

<!-- gift card -->
  <!-- <section class="method-section" id="section-giftcard">
    <div class="card panel-card">
      <div class="card-body p-4">
        <h3 class="h6 text-navy mb-3">Redeem a gift card</h3>
        <p class="text-muted small">Select the gift card brand, then enter the code and value to add funds to your account.</p>

        <div class="row g-3 mb-4" id="giftcardGrid">
          <div class="col-6 col-sm-3">
            <div class="giftcard-brand selected" data-brand="Amazon">Amazon</div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="giftcard-brand" data-brand="iTunes">iTunes</div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="giftcard-brand" data-brand="Google Play">Google Play</div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="giftcard-brand" data-brand="Steam">Steam</div>
          </div>
        </div>

        <form onsubmit="return false;">
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label" for="giftcardCode">Gift card code</label>
              <input type="text" class="form-control" id="giftcardCode" placeholder="XXXX-XXXX-XXXX-XXXX">
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="giftcardValue">Card value (USD)</label>
              <input type="number" class="form-control" id="giftcardValue" placeholder="e.g. 100" min="1">
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-4" id="redeemGiftcardBtn">Redeem gift card</button>
        </form>
      </div>
    </div>
  </section> -->

  <!-- ===================== OTHER OPTIONS ===================== -->
  <section class="method-section" id="section-other">
    <div class="card panel-card">
      <div class="card-body p-4">
        <h3 class="h6 text-navy mb-1">Other payment options</h3>
        <p class="text-muted small mb-4">These methods are coming soon and can't be used to deposit right now.</p>

        <div class="row g-3">
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="other-option">
              <span class="other-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5 6.5C16.5 4.6 14.9 3 13 3C13 4.9 14.6 6.5 16.5 6.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M18.8 9.3C17.8 8.1 16.4 8 15.7 8C14.4 8 13.4 8.8 12.7 8.8C12 8.8 11.1 8 10 8C8.5 8 6.9 8.9 6 10.5C4.7 12.7 5.5 16.4 6.9 18.5C7.6 19.5 8.4 20.7 9.5 20.6C10.5 20.6 10.9 20 12.1 20C13.3 20 13.6 20.6 14.7 20.6C15.8 20.5 16.5 19.6 17.2 18.6C17.9 17.5 18.2 16.4 18.2 16.4C18.2 16.4 16 15.5 16 12.9C15.9 10.7 17.7 9.7 17.8 9.6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
              </span>
              <div>
                <div class="fw-semibold text-navy small">Apple Pay</div>
                <span class="unavailable-badge">Temporarily unavailable</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-4">
            <div class="other-option">
              <span class="other-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 4H14.5C17 4 19 6 19 8.5C19 11 17 13 14.5 13H10L9 18H5L7 4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M10 13L9.3 17H13.5C16 17 17.5 18.5 17 20H12" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
              </span>
              <div>
                <div class="fw-semibold text-navy small">PayPal</div>
                <span class="unavailable-badge">Temporarily unavailable</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-4">
            <div class="other-option">
              <span class="other-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 10L12 4L20 10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 10V19H19V10" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 19V14H15V19" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
              </span>
              <div>
                <div class="fw-semibold text-navy small">Bank transfer</div>
                <span class="unavailable-badge">Temporarily unavailable</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- ===================== ACTION TOAST ===================== -->
<!-- <div class="action-toast" id="actionToast">
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
  <div class="small">
    <div class="fw-semibold" id="toastText">Submitted</div>
    <div style="color:#AEC6F2;">This is a UI preview — no funds are transferred and no backend is connected.</div>
  </div>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  /* ---------- Method tab switching ---------- */
  const tabs = document.querySelectorAll('#methodTabs .method-tab');
  const sections = document.querySelectorAll('.method-section');
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const target = tab.getAttribute('data-target');
      sections.forEach(sec => sec.classList.toggle('active', sec.id === target));
    });
  });

  /* ---------- Coin selection ---------- */
  const coinOptions = document.querySelectorAll('.coin-option');
  const selectedCoinLabel = document.getElementById('selectedCoinLabel');
  const networkLabel = document.getElementById('networkLabel');
  const addressValue = document.getElementById('addressValue');

  const SAMPLE_ADDRESSES = {
    BTC: 'bc1qtpsrfqmwwxwgaeuucs4msqkrznkm4nelr2h7ck',
    ETH: '0x9D793AB83A19765e79268c206A7B62e34dF06c00',
    USDT: '0x9D793AB83A19765e79268c206A7B62e34dF06c00'
  };

  coinOptions.forEach(opt => {
    opt.addEventListener('click', () => {
      coinOptions.forEach(o => o.classList.remove('selected'));
      opt.classList.add('selected');
      const coin = opt.getAttribute('data-coin');
      const symbol = opt.getAttribute('data-symbol');
      const network = opt.getAttribute('data-network');
      selectedCoinLabel.textContent = `${coin} (${symbol})`;
      networkLabel.textContent = network;
      addressValue.textContent = SAMPLE_ADDRESSES[symbol] || SAMPLE_ADDRESSES.BTC;
    });
  });

  /* ---------- Copy address ---------- */
  const copyAddressBtn = document.getElementById('copyAddressBtn');
  copyAddressBtn.addEventListener('click', async () => {
    const text = addressValue.textContent.trim();
    try{
      await navigator.clipboard.writeText(text);
    }catch(err){
      const temp = document.createElement('textarea');
      temp.value = text;
      document.body.appendChild(temp);
      temp.select();
      document.execCommand('copy');
      document.body.removeChild(temp);
    }
    copyAddressBtn.classList.add('copied');
    setTimeout(() => copyAddressBtn.classList.remove('copied'), 1500);
  });

  /* ---------- Gift card brand selection ---------- */
  // document.querySelectorAll('.giftcard-brand').forEach(brand => {
  //   brand.addEventListener('click', () => {
  //     document.querySelectorAll('.giftcard-brand').forEach(b => b.classList.remove('selected'));
  //     brand.classList.add('selected');
  //   });
  // });

  /* ---------- Action toast helper ---------- */
  // const actionToast = document.getElementById('actionToast');
  // const toastText = document.getElementById('toastText');
  // let toastTimer;
  // function showActionToast(message){
  //   toastText.textContent = message;
  //   actionToast.classList.add('show');
  //   clearTimeout(toastTimer);
  //   toastTimer = setTimeout(() => actionToast.classList.remove('show'), 3500);
  // }

  // document.getElementById('confirmCryptoBtn').addEventListener('click', () => {
  //   showActionToast('Deposit notice submitted.');
  // });
  // document.getElementById('redeemGiftcardBtn').addEventListener('click', () => {
  //   showActionToast('Gift card submitted for review.');
  // });
</script>

</body>
</html>
