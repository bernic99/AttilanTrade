<?php  
session_start();
include('config/db_connect.php');
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user data
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username,  phone_number, first_name, last_name, country, created_at, email   FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Details — AttilanTrade</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  :root{
    --bs-primary:#1E63E9;
    --bs-primary-rgb:30,99,233;
    --bs-body-font-family:'Inter', sans-serif;
    --bs-link-color:#1E63E9;
    --bs-link-hover-color:#1854c9;
    --navy:#0B2545;
    --deep-blue:#13315C;
    --azure:#1E63E9;
    --sky:#5B9DF9;
    --pale:#EAF2FF;
  }
  body{background:#F4F8FF; color:#10233F;}
  h1,h2,h3,h4,h5,.navbar-brand{font-family:'Space Grotesk', sans-serif;}
  .text-navy{color:var(--navy) !important;}
  .bg-navy{background-color:var(--navy) !important;}
  .bg-pale{background-color:var(--pale) !important;}

  /* ---------- Navbar (shared with dashboard) ---------- */
  .navbar-dark .nav-link{color:#C9D9F5; font-weight:500; font-size:0.92rem;}
  .navbar-dark .nav-link:hover{color:#fff;}
  .navbar-dark .nav-link.active{color:#fff; border-bottom:2px solid var(--sky);}
  .logo-mark{
    width:34px; height:34px; border-radius:9px;
    background:linear-gradient(135deg, var(--azure), var(--sky));
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
  }
  .btn-icon{
    width:38px; height:38px; border-radius:9px;
    background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.14);
    color:#fff; display:flex; align-items:center; justify-content:center;
  }
  .btn-icon:hover{background:rgba(255,255,255,0.16); color:#fff;}
  .notif-dot{
    position:absolute; top:6px; right:7px; width:7px; height:7px; border-radius:50%;
    background:var(--sky); border:1.5px solid var(--navy);
  }
  .btn-user{background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.14); color:#fff; border-radius:10px;}
  .btn-user:hover, .btn-user:focus{background:rgba(255,255,255,0.16); color:#fff;}
  .avatar-sm{
    width:30px; height:30px; border-radius:50%;
    background:linear-gradient(135deg, var(--sky), var(--azure));
    display:flex; align-items:center; justify-content:center;
    font-weight:700; font-size:0.8rem; color:#fff; flex-shrink:0;
  }
  .dropdown-menu{border-radius:12px; border-color:#DCE7F9;}
  .dropdown-item{border-radius:8px; padding:0.6rem 0.75rem; font-size:0.9rem;}
  .dropdown-item:hover{background:var(--pale);}
  .dropdown-item.text-danger:hover{background:#FDECEC;}

  /* ---------- Profile header ---------- */
  .profile-card{
    background:linear-gradient(135deg, var(--navy), var(--deep-blue) 60%, #0F3D7A);
    position:relative; overflow:hidden; color:#fff;
  }
  .profile-card::after{
    content:""; position:absolute; right:-100px; top:-100px; width:320px; height:320px; border-radius:50%;
    background:radial-gradient(circle, rgba(91,157,249,0.25), transparent 70%);
  }
  .profile-card .card-body{position:relative; z-index:2;}
  .avatar-xl{
    width:84px; height:84px; border-radius:50%;
    background:linear-gradient(135deg, var(--sky), var(--azure));
    display:flex; align-items:center; justify-content:center;
    font-weight:700; font-size:1.8rem; color:#fff; flex-shrink:0;
    border:3px solid rgba(255,255,255,0.25);
  }
  .verified-badge{
    background:rgba(31,169,113,0.18); color:#7BE0AE; font-weight:600; font-size:0.8rem;
    padding:0.35rem 0.7rem;
  }

  /* ---------- Detail rows ---------- */
  .detail-card{border:1px solid #DCE7F9; border-radius:16px;}
  .detail-row{
    display:flex; align-items:center; gap:14px;
    padding:16px 0;
    border-bottom:1px solid #F0F4FC;
  }
  .detail-row:last-child{border-bottom:none;}
  .detail-icon{
    width:42px; height:42px; border-radius:10px; background:var(--pale); color:var(--azure);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
  }
  .detail-label{font-size:0.78rem; text-transform:uppercase; letter-spacing:0.03em; color:#5D7290; margin-bottom:2px;}
  .detail-value{font-weight:600; color:var(--navy); font-size:0.98rem; word-break:break-word;}
  .detail-sub{font-size:0.8rem; color:#5D7290;}
  .copy-btn{
    border:1px solid #DCE7F9; background:#fff; color:var(--azure);
    border-radius:8px; width:36px; height:36px; display:flex; align-items:center; justify-content:center;
    flex-shrink:0; transition:background .15s ease;
  }
  .copy-btn:hover{background:var(--pale);}
  .copy-btn.copied{background:#1FA971; border-color:#1FA971; color:#fff;}

  .form-label{font-weight:600; font-size:0.85rem;}
  .modal-content{border:none;}
</style>
</head>
<body>



<div class="container py-4">

  <!-- ===================== PAGE HEAD ===================== -->
  <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-2">
    <div>
      <h1 class="h4 text-navy mb-1">Account details</h1>
     
    </div>
    <a href="home_page.php" class="small fw-semibold text-decoration-none d-inline-flex align-items-center gap-1">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 12H5M5 12L11 6M5 12L11 18" stroke="#1E63E9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Back to dashboard
    </a>
  </div>

  <!-- ===================== PROFILE HEADER CARD ===================== -->
  <div class="card border-0 rounded-4 profile-card mb-4">
    <div class="card-body p-4">
      <div class="d-flex flex-wrap align-items-center gap-3 justify-content-between">
        <div class="d-flex align-items-center gap-3">
          <span class="avatar-xl">  
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
	<path d="M0 0h32v32H0z" fill="none" />
	<path fill="currentColor" d="M12 4a5 5 0 1 1-5 5a5 5 0 0 1 5-5m0-2a7 7 0 1 0 7 7a7 7 0 0 0-7-7m10 28h-2v-5a5 5 0 0 0-5-5H9a5 5 0 0 0-5 5v5H2v-5a7 7 0 0 1 7-7h6a7 7 0 0 1 7 7Zm0-26h10v2H22zm0 5h10v2H22zm0 5h7v2h-7z" />
</svg>
          </span>
          <div>
            <h2 class="h5 mb-1 text-white"><?php echo htmlspecialchars($user['first_name']); ?> <?php echo htmlspecialchars($user['last_name']); ?></h2>
            <div class="d-flex flex-wrap align-items-center gap-2">
           
              <span class="badge rounded-pill verified-badge d-inline-flex align-items-center gap-1">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Verified account
              </span>
            </div>
          </div>
        </div>
        <!-- <button class="btn btn-light fw-semibold text-navy d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#editModal" type="button">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 20H8L18.5 9.5C19.3 8.7 19.3 7.3 18.5 6.5C17.7 5.7 16.3 5.7 15.5 6.5L5 17V20" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
          Edit profile
        </button> -->
      </div>
    </div>
  </div>

  <!-- ===================== DETAILS ===================== -->
  <div class="row g-3">
    <div class="col-lg-8">
      <div class="card detail-card h-100">
        <div class="card-body p-4">
          <h3 class="h6 text-navy mb-2">Personal &amp; account information</h3>

          <div class="detail-row">
            <span class="detail-icon">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="8" r="3.4" stroke="currentColor" stroke-width="1.8"/><path d="M5 20C5 16.4 8.1 14 12 14C15.9 14 19 16.4 19 20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </span>
            <div class="flex-grow-1">
              <div class="detail-label">Username</div>
              <div class="detail-value"><?php echo htmlspecialchars($user['username']); ?></div>
            </div>
          </div>

          <div class="detail-row">
            <span class="detail-icon">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="4" width="16" height="16" rx="4" stroke="currentColor" stroke-width="1.8"/><path d="M8 12H16M8 16H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </span>
            <div class="flex-grow-1">
              <div class="detail-label">Public account ID</div>
              <div class="detail-value" id="accountIdValue">ATT-8F42-KX90-1QWE</div>
            </div>
            <button class="copy-btn" id="copyAccountId" type="button" aria-label="Copy account ID">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="9" y="9" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M5 15V5C5 3.9 5.9 3 7 3H15" stroke="currentColor" stroke-width="1.8"/></svg>
            </button>
          </div>

          <div class="detail-row">
            <span class="detail-icon">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 5H8L10 10L7 12C8 15 9 16 12 17L14 14L19 16V20C19 20.5523 18.5523 21 18 21C10 21 3 14 3 6C3 5.4477 3.4477 5 4 5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
            </span>
            <div class="flex-grow-1">
              <div class="detail-label">Phone number</div>
              <div class="detail-value"><?php echo htmlspecialchars($user['phone_number']); ?></div>
            </div>
            <span class="badge rounded-pill bg-success-subtle text-success small">Verified</span>
          </div>

          <div class="detail-row">
            <span class="detail-icon">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
            </span>
            <div class="flex-grow-1">
              <div class="detail-label">Country</div>
              <div class="detail-value"><?php echo htmlspecialchars($user['country']); ?></div>
            </div>
          </div>

          <div class="detail-row">
            <span class="detail-icon">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4H20V18H4V4Z" stroke="currentColor" stroke-width="1.8"/><path d="M4 6L12 13L20 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </span>
            <div class="flex-grow-1">
              <div class="detail-label">Email address</div>
              <div class="detail-value"><?php echo htmlspecialchars($user['email']); ?></div>
            </div>
            <span class="badge rounded-pill bg-success-subtle text-success small">Verified</span>
          </div>

          <div class="detail-row mb-4">
            <span class="detail-icon">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="5" width="16" height="16" rx="3" stroke="currentColor" stroke-width="1.8"/><path d="M4 9H20" stroke="currentColor" stroke-width="1.8"/><path d="M8 3V7M16 3V7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </span>
            <div class="flex-grow-1">
              <div class="detail-label">Account created</div>
              <div class="detail-value"><?php echo htmlspecialchars($user['created_at']); ?></div>
              
            </div>
          </div>

          <h3 class="h6 text-navy mb-2">Security</h3>

                <div class="detail-row">
            <!-- <span class="detail-icon">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
            </span> -->
            <div class="flex-grow-1">
              <div class="detail-label">Password</div>
             <a href="forgot_password.php"><div class="detail-value">Update Password</div></a> 
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card detail-card h-100">
        <div class="card-body p-4">
          <h3 class="h6 text-navy mb-3">Account status</h3>

          <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="small text-muted">Identity verification</span>
            <span class="badge rounded-pill bg-success-subtle text-success">Complete</span>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="small text-muted">Two-factor authentication</span>
            <span class="badge rounded-pill bg-warning-subtle text-warning">Not enabled</span>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-4">
            <span class="small text-muted">Account tier</span>
            <span class="badge rounded-pill bg-pale text-primary fw-semibold">Standard</span>
          </div>

          <button class="btn btn-outline-primary w-100 d-inline-flex align-items-center justify-content-center gap-2" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
            Enable two-factor authentication
          </button>

          
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ===================== EDIT PROFILE MODAL ===================== -->
<!-- <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title text-navy">Edit profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-2">
        <p class="text-muted small mb-3">Update your account details below.</p>
        <form onsubmit="return false;">
          <div class="row g-3 mb-3">
            <div class="col-sm-6">
              <label class="form-label" for="editUsername">Username</label>
              <input type="text" class="form-control" id="editUsername" value="jordan.lee">
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="editPhone">Phone number</label>
              <input type="tel" class="form-control" id="editPhone" value="+1 (555) 019-2044">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="editEmail">Email address</label>
            <input type="email" class="form-control" id="editEmail" value="jordan.lee@email.com">
          </div>
          <div class="mb-3">
            <label class="form-label" for="editCountry">Country</label>
            <select class="form-select" id="editCountry">
              <option selected>United States</option>
              <option>United Kingdom</option>
              <option>Nigeria</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal">Save changes</button>
        </form>
        <p class="text-muted small text-center mt-3 mb-0">UI preview only — no data is saved and no backend is connected.</p>
      </div>
    </div>
  </div>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const copyBtn = document.getElementById('copyAccountId');
  const accountIdValue = document.getElementById('accountIdValue');

  copyBtn.addEventListener('click', async () => {
    const text = accountIdValue.textContent.trim();
    try{
      await navigator.clipboard.writeText(text);
    }catch(err){
      // Fallback for browsers/contexts without Clipboard API access
      const temp = document.createElement('textarea');
      temp.value = text;
      document.body.appendChild(temp);
      temp.select();
      document.execCommand('copy');
      document.body.removeChild(temp);
    }
    const original = copyBtn.innerHTML;
    copyBtn.classList.add('copied');
    copyBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    setTimeout(() => {
      copyBtn.classList.remove('copied');
      copyBtn.innerHTML = original;
    }, 1500);
  });
</script>

</body>
</html>
