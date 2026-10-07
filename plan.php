<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Strategy Plans — AttilanTrade</title>
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
  .bg-navy{background-color:var(--navy) !important;}
  .bg-pale{background-color:var(--pale) !important;}

  .page-head{
    background:linear-gradient(135deg, var(--navy), var(--deep-blue) 70%, #0F3D7A);
    color:#fff; position:relative; overflow:hidden;
  }
  .page-head::after{
    content:""; position:absolute; right:-120px; top:-120px; width:360px; height:360px; border-radius:50%;
    background:radial-gradient(circle, rgba(91,157,249,0.25), transparent 70%);
  }
  .page-head .inner{position:relative; z-index:2;}
  .logo-mark{
    width:34px; height:34px; border-radius:9px;
    background:linear-gradient(135deg, var(--azure), var(--sky));
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
  }

  .risk-banner{
    background:#FFF7EA; border:1px solid #F5DDA6; border-radius:14px; color:#7A5B12;
  }
  .risk-banner svg{color:#B8860B; flex-shrink:0;}

  /* ---------- Plan cards ---------- */
  .plan-card{
    border:1px solid #DCE7F9; border-radius:18px; background:#fff;
    transition:transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    height:100%;
  }
  .plan-card:hover{transform:translateY(-4px); box-shadow:0 16px 32px rgba(11,37,69,0.1);}
  .plan-card.selected{
    border-color:var(--azure);
    box-shadow:0 0 0 3px rgba(30,99,233,0.15), 0 16px 32px rgba(11,37,69,0.12);
  }
  .plan-card.featured{border-color:var(--sky);}
  .plan-badge-top{
    position:absolute; top:-12px; left:50%; transform:translateX(-50%);
    background:var(--azure); color:#fff; font-size:0.72rem; font-weight:700;
    padding:4px 14px; border-radius:20px; letter-spacing:0.03em; text-transform:uppercase;
    white-space:nowrap;
  }
  .plan-name{font-weight:700; font-size:1.15rem;}
  .plan-min{font-size:0.82rem; color:#5D7290;}
  .plan-min .amount{font-family:'Space Grotesk', sans-serif; font-weight:700; font-size:1.6rem; color:var(--navy);}

  .risk-pill{font-size:0.72rem; font-weight:700; padding:4px 10px; border-radius:20px; text-transform:uppercase; letter-spacing:0.02em;}
  .risk-low{background:rgba(31,169,113,0.12); color:#1FA971;}
  .risk-lowmed{background:rgba(91,157,249,0.15); color:#1E63E9;}
  .risk-med{background:rgba(228,168,63,0.15); color:#B8860B;}
  .risk-medhigh{background:rgba(228,120,63,0.15); color:#C1600C;}
  .risk-custom{background:rgba(30,99,233,0.12); color:#1E63E9;}

  .feature-list{list-style:none; padding:0; margin:0;}
  .feature-list li{
    display:flex; align-items:flex-start; gap:9px;
    font-size:0.87rem; color:#334A6B; padding:8px 0; border-bottom:1px solid #F0F4FC;
  }
  .feature-list li:last-child{border-bottom:none;}
  .feature-list li svg{color:var(--azure); flex-shrink:0; margin-top:2px;}
  .feature-label{color:#5D7290; font-size:0.78rem; display:block;}
  .feature-value{font-weight:600; color:var(--navy); font-size:0.9rem;}

  .choose-btn{border-radius:9px; font-weight:600;}

  .compare-toggle-wrap{display:flex; justify-content:flex-end; margin-bottom:8px;}

  /* comparison table (hidden by default) */
  #compareSection{display:none;}
  .compare-table th, .compare-table td{vertical-align:middle; font-size:0.88rem;}
  .compare-table thead th{background:var(--navy); color:#fff; font-weight:600; border:none;}
  .compare-table thead th:first-child{border-top-left-radius:12px;}
  .compare-table thead th:last-child{border-top-right-radius:12px;}
  .compare-table td:first-child{font-weight:600; color:var(--navy); background:var(--pale);}

  .summary-toast{
    position:fixed; bottom:20px; right:20px; left:20px; z-index:1080;
    max-width:420px; margin-left:auto;
    background:#0B2545; color:#fff; border-radius:14px; padding:16px 18px;
    box-shadow:0 20px 40px rgba(11,37,69,0.3);
    display:none; align-items:center; gap:12px;
  }
  .summary-toast.show{display:flex;}
  .summary-toast svg{color:#7BE0AE; flex-shrink:0;}

  @media (max-width: 575px){
    .page-head{padding-top:36px !important; padding-bottom:36px !important;}
    .summary-toast{right:12px; left:12px;}
  }
</style>
</head>
<body>

<!-- ===================== PAGE HEADER (no navbar, per request) ===================== -->
<header class="page-head py-5">
  <div class="container inner">
    <a href="home_page.php" class="d-inline-flex align-items-center gap-2 fw-bold fs-5 text-white text-decoration-none mb-4">
  
      AttilanTrade
    </a>
    <span class="badge rounded-pill bg-white text-navy fw-semibold mb-3">STRATEGY PLANS</span>
    <h1 class="h2 text-white mb-2">Choose the plan that matches how you want to trade</h1>
    <p class="mb-0" style="color:#C9D9F5; max-width:60ch;">Every plan runs a different automated strategy mix, with its own minimum deposit, risk profile, support level, and withdrawal speed. Pick the one that fits your goals — you can change plans at any time.</p>
  </div>
</header>

<div class="container py-4 py-lg-5">

  <!-- ===================== RISK BANNER =====================
  <div class="risk-banner d-flex gap-3 align-items-start p-3 p-lg-4 mb-4">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18A2 2 0 0 0 3.55 21H20.45A2 2 0 0 0 22.18 18L13.71 3.86A2 2 0 0 0 10.29 3.86Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <div class="small">
      <strong>Risk disclosure:</strong> Cryptocurrency trading involves substantial risk, including the possible loss of principal. No plan guarantees fixed or daily returns — actual performance depends on market conditions and can be negative. Plans below differ by deposit requirement, strategy type, risk profile, support level, and withdrawal speed, not by a promised rate of return.
    </div>
  </div> -->

  

  <div class="compare-toggle-wrap">
    <button class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-2" id="compareToggleBtn" type="button">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="7" height="16" rx="1.5" stroke="currentColor" stroke-width="1.8"/><rect x="14" y="4" width="7" height="16" rx="1.5" stroke="currentColor" stroke-width="1.8"/></svg>
      <span id="compareToggleLabel">Compare all plans</span>
    </button>
    
  </div>

  <!-- ===================== PLAN CARDS ===================== -->
  <div class="row g-3 g-lg-4" id="planGrid">

    <!-- STARTER -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl">
      <div class="plan-card p-4 position-relative" data-plan="Starter">
        <div>
          <div class="plan-name text-navy">Starter</div>
          <div class="plan-min mb-2">Minimum deposit<br><span class="amount">$100-$500</span></div>
          <span class="risk-pill risk-low">Low risk</span>
        </div>
        <ul class="feature-list my-3">
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Strategy type</span><span class="feature-value">Stablecoin-weighted conservative</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Support tier</span><span class="feature-value">Email support (48h response)</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Withdrawal speed</span><span class="feature-value">3–5 business days</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Rebalancing</span><span class="feature-value">Weekly</span></div>
          </li>
        </ul>
        <a href="Deposit.php"><button class="btn btn-outline-primary w-100 choose-btn" type="button">Choose Starter</button></a>
      </div>
    </div>

    <!-- PREMIUM -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl">
      <div class="plan-card p-4 position-relative" data-plan="Premium">
        <div>
          <div class="plan-name text-navy">Premium</div>
          <div class="plan-min mb-2">Minimum deposit<br><span class="amount">$600-$1500</span></div>
          <span class="risk-pill risk-lowmed">Low–medium risk</span>
        </div>
        <ul class="feature-list my-3">
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Strategy type</span><span class="feature-value">Balanced growth (multi-asset)</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Support tier</span><span class="feature-value">Priority email + live chat</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Withdrawal speed</span><span class="feature-value">1–2 business days</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Rebalancing</span><span class="feature-value">Every 3 days</span></div>
          </li>
        </ul>
       <a href="Deposit.php"> <button class="btn btn-outline-primary w-100 choose-btn" type="button">Choose Premium</button></a>
      </div>
    </div>

    <!-- VIP (featured) -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl">
      <div class="plan-card featured p-4 position-relative" data-plan="VIP">
        <span class="plan-badge-top">Most popular</span>
        <div>
          <div class="plan-name text-navy">VIP</div>
          <div class="plan-min mb-2">Minimum deposit<br><span class="amount">$1600-$3500</span></div>
          <span class="risk-pill risk-med">Medium risk</span>
        </div>
        <ul class="feature-list my-3">
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Strategy type</span><span class="feature-value">Momentum rotation (active)</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Support tier</span><span class="feature-value">Dedicated account manager</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Withdrawal speed</span><span class="feature-value">Same business day</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Rebalancing</span><span class="feature-value">Daily</span></div>
          </li>
        </ul>
       <a href="Deposit.php"> <button class="btn btn-primary w-100 choose-btn" type="button">Choose VIP</button></a>
      </div>
    </div>

    <!-- VVIP -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl">
      <div class="plan-card p-4 position-relative" data-plan="VVIP">
        <div>
          <div class="plan-name text-navy">VVIP</div>
          <div class="plan-min mb-2">Minimum deposit<br><span class="amount">$3600-$5500</span></div>
          <span class="risk-pill risk-medhigh">Medium–high risk</span>
        </div>
        <ul class="feature-list my-3">
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Strategy type</span><span class="feature-value">Diversified multi-strategy</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Support tier</span><span class="feature-value">Manager + direct phone line</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Withdrawal speed</span><span class="feature-value">Priority, within hours</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Rebalancing</span><span class="feature-value">Intraday</span></div>
          </li>
        </ul>
       <a href="Deposit.php"> <button class="btn btn-outline-primary w-100 choose-btn" type="button">Choose VVIP</button></a>
      </div>
    </div>

    <!-- ULTIMATE -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl">
      <div class="plan-card p-4 position-relative" data-plan="Ultimate">
        <div>
          <div class="plan-name text-navy">Ultimate</div>
          <div class="plan-min mb-2">Minimum deposit<br><span class="amount">$10,000</span></div>
          <span class="risk-pill risk-custom">Custom risk profile</span>
        </div>
        <ul class="feature-list my-3">
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Strategy type</span><span class="feature-value">Custom-tuned, full exchange access</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Support tier</span><span class="feature-value">White-glove concierge, 24/7</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Withdrawal speed</span><span class="feature-value">Instant, no limits</span></div>
          </li>
          <li>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div><span class="feature-label">Rebalancing</span><span class="feature-value">Real-time, custom rules</span></div>
          </li>
        </ul>
   <a href="Deposit.php"> <button class="btn btn-outline-primary w-100 choose-btn" type="button">Choose Ultimate</button></a>
      </div>
    </div>

  </div>

  <!-- ===================== COMPARISON TABLE ===================== -->
  <div id="compareSection" class="mt-5">
    <h2 class="h5 text-navy mb-3">Plan comparison</h2>
    <div class="table-responsive">
      <table class="table compare-table bg-white rounded-4 overflow-hidden mb-0">
        <thead>
          <tr>
            <th>Feature</th>
            <th>Starter</th>
            <th>Premium</th>
            <th>VIP</th>
            <th>VVIP</th>
            <th>Ultimate</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Minimum deposit</td>
            <td>$100-500</td><td>$600-1500</td><td>$1600-3500</td><td>$3600-5500</td><td>$10,000</td>
          </tr>
          <tr>
            <td>Risk profile</td>
            <td>Low</td><td>Low–medium</td><td>Medium</td><td>Medium–high</td><td>Custom</td>
          </tr>
          <tr>
            <td>Strategy type</td>
            <td>Stablecoin-weighted</td><td>Balanced growth</td><td>Momentum rotation</td><td>Diversified multi-strategy</td><td>Custom-tuned</td>
          </tr>
          <tr>
            <td>Support tier</td>
            <td>Email (48h)</td><td>Priority email + chat</td><td>Dedicated manager</td><td>Manager + phone</td><td>White-glove, 24/7</td>
          </tr>
          <tr>
            <td>Withdrawal speed</td>
            <td>3–5 business days</td><td>1–2 business days</td><td>Same business day</td><td>Within hours</td><td>Instant</td>
          </tr>
          <tr>
            <td>Rebalancing frequency</td>
            <td>Weekly</td><td>Every 3 days</td><td>Daily</td><td>Intraday</td><td>Real-time</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- ===================== SELECTION TOAST =====================
<div class="summary-toast" id="selectionToast">
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
  <div class="small">
    <div class="fw-semibold" id="toastPlanName">Plan selected</div>
    <div style="color:#AEC6F2;">This is a UI preview — no plan is activated and no backend is connected.</div>
  </div>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  /* ---------- Plan selection ---------- */
  const cards = document.querySelectorAll('.plan-card');
  const toast = document.getElementById('selectionToast');
  const toastPlanName = document.getElementById('toastPlanName');
  let toastTimer;

  cards.forEach(card => {
    const btn = card.querySelector('.choose-btn');
    btn.addEventListener('click', () => {
      cards.forEach(c => {
        c.classList.remove('selected');
        const b = c.querySelector('.choose-btn');
        b.classList.remove('btn-primary');
        b.classList.add('btn-outline-primary');
        b.textContent = 'Choose ' + c.getAttribute('data-plan');
      });
      card.classList.add('selected');
      btn.classList.remove('btn-outline-primary');
      btn.classList.add('btn-primary');
      btn.textContent = 'Selected: ' + card.getAttribute('data-plan');

      toastPlanName.textContent = card.getAttribute('data-plan') + ' plan selected';
      toast.classList.add('show');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(() => toast.classList.remove('show'), 3500);
    });
  });

  /* ---------- Compare toggle ---------- */
  const compareBtn = document.getElementById('compareToggleBtn');
  const compareSection = document.getElementById('compareSection');
  const compareLabel = document.getElementById('compareToggleLabel');
  compareBtn.addEventListener('click', () => {
    const isOpen = compareSection.style.display === 'block';
    compareSection.style.display = isOpen ? 'none' : 'block';
    compareLabel.textContent = isOpen ? 'Compare all plans' : 'Hide comparison';
    if(!isOpen) compareSection.scrollIntoView({behavior:'smooth', block:'nearest'});
  });
</script>

</body>
</html>
