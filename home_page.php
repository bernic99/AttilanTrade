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

$stmt = $conn->prepare("SELECT last_name, price, start_amount, first_name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();




$current_balance = $user['price'] ?? 0;



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — AttilanTrade</title>
<link rel="stylesheet" type="text/css" href="css/home_page.css?v=<?php echo time(); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

</style>
</head>
<body>

<!-- ===================== NAVBAR ===================== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-navy sticky-top py-2">
  <div class="container-fluid px-3 px-lg-4">
    <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-5" href="index.html">
  <img src="images/Attilan.png" alt="" width="120" height="59" >
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav me-auto mb-3 mb-lg-0 ms-lg-4 gap-lg-4">
        <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="#markets">Markets</a></li>
        <li class="nav-item"><a class="nav-link" href="plan.php">Strategies</a></li>
        <li class="nav-item"><a class="nav-link" href="transaction_history.php">Transactions</a></li>
        <li class="nav-item"><a class="nav-link" href="Account_info.php">Account Information</a></li>
        
      </ul>
        <li class="nav-item"><a class="nav-link" href="contact.php">Support</a></li>
      </ul>
      
      



        
      </div>
    </div>
  </div>
</nav>

<div class="container py-4">

  <!-- ===================== GREETING ===================== -->
  <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-2">
    <div>
      <h1 class="h4 text-navy mb-1">Welcome, <?php echo htmlspecialchars($user['last_name']); ?>  </h1>
      <p class="text-muted mb-0 small">Here's what's happening with your account today.</p>
    </div>
    <div class="d-flex align-items-center gap-2 small text-muted">
      <span class="live-dot" id="liveDot"></span>
      <span id="updatedText">Live prices updating…</span>
    </div>
  </div>

  <!-- ===================== BALANCE CARD ===================== -->
  <div class="card border-0 rounded-4 balance-card text-white mb-4">
    <div class="card-body p-4">
      <div class="row g-4 align-items-center">
        <div class="col-lg-7">
          <div class="small mb-1" style="color:#AEC6F2;">Total account balance</div>
          <div class="balance-amount"><span>$</span><?php echo number_format($current_balance, 2); ?></div>
        
          <div class="d-flex flex-wrap gap-2 mt-4">
            <a href="Deposit.php"><button class="btn btn-light fw-semibold d-inline-flex align-items-center gap-2 text-navy" data-bs-toggle="modal" data-bs-target="#depositModal" type="button">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 4V16M12 16L7 11M12 16L17 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 19H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              Deposit
            </button></a>

           <a href="withdraw.php"> <button class="btn btn-outline-light fw-semibold d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#withdrawModal" type="button">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 16V4M12 4L7 9M12 4L17 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 19H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              Withdraw
            </button></a>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-1 g-3">
            <div class="col">
              <div class="mini-stat d-flex justify-content-between align-items-center">
                <span class="small" style="color:#AEC6F2;">Available balance</span>
                <span class="fw-bold">$0.00</span>
              </div>
            </div>
            <div class="col">
              <div class="mini-stat d-flex justify-content-between align-items-center">
                <span class="small" style="color:#AEC6F2;">Allocated to strategies</span>
                <span class="fw-bold"><span>$</span><?php echo htmlspecialchars($user['start_amount']); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================== MARKET + ALLOCATION ===================== -->
  <div class="row g-3 mb-4" id="markets">
    <div class="col-lg-8">
      <div class="card border rounded-4 h-100">
        <div class="card-body p-3 p-lg-4">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h3 class="h6 text-navy mb-0">Live market prices</h3>
            <span class="badge rounded-pill bg-pale text-primary d-inline-flex align-items-center gap-1 fw-semibold">
              <span class="live-dot"></span> 
            </span>
          </div>

          <div class="table-responsive">
            <table class="table market-table mb-0">
              <thead>
                <tr>
                  <th>Asset</th>
                  <th>Price</th>
                  <th>24h change</th>
                  <th>7d trend</th>
                </tr>
              </thead>
              <tbody id="marketBody">
                <tr><td colspan="4" class="text-center text-muted py-4">Loading live prices…</td></tr>
              </tbody>
            </table>
          </div>

          <div class="d-flex gap-2 small text-muted mt-3">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mt-1"><path d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18A2 2 0 0 0 3.55 21H20.45A2 2 0 0 0 22.18 18L13.71 3.86A2 2 0 0 0 10.29 3.86Z" stroke="#1E63E9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
           
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border rounded-4 h-100">
        <div class="card-body p-3 p-lg-4">
          <h3 class="h6 text-navy mb-3">Strategy allocation</h3>

          <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
              <span class="fw-semibold text-navy">Balanced Growth</span>
              <span class="text-muted">42%</span>
            </div>
            <div class="progress alloc-bar"><div class="progress-bar" style="width:42%"></div></div>
          </div>
          <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
              <span class="fw-semibold text-navy">Momentum Rotation</span>
              <span class="text-muted">28%</span>
            </div>
            <div class="progress alloc-bar"><div class="progress-bar" style="width:28%"></div></div>
          </div>
          <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1">
              <span class="fw-semibold text-navy">Stablecoin Reserve</span>
              <span class="text-muted">18%</span>
            </div>
            <div class="progress alloc-bar"><div class="progress-bar" style="width:18%"></div></div>
          </div>
          <div>
            <div class="d-flex justify-content-between small mb-1">
              <span class="fw-semibold text-navy">Available cash</span>
              <span class="text-muted">12%</span>
            </div>
            <div class="progress alloc-bar"><div class="progress-bar" style="width:12%"></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ===================== DEPOSIT MODAL ===================== -->
<!-- <div class="modal fade" id="depositModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title text-navy">Deposit funds</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-2">
        <p class="text-muted small mb-3">Choose an asset and amount to add to your account.</p>
        <form onsubmit="return false;">
          <div class="mb-3">
            <label class="form-label" for="depAsset">Asset</label>
            <select class="form-select" id="depAsset">
              <option>Bitcoin (BTC)</option>
              <option>Ethereum (ETH)</option>
              <option>USD Coin (USDC)</option>
              <option>Tether (USDT)</option>
            </select>
          </div> -->
          <!-- <div class="mb-3">
            <label class="form-label" for="depAmount">Amount (USD)</label>
            <input type="number" class="form-control" id="depAmount" placeholder="e.g. 500" min="1">
          </div>
          <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal">Confirm deposit</button>
        </form>
        <p class="text-muted small text-center mt-3 mb-0">UI preview only — no funds are transferred and no backend is connected.</p>
      </div>
    </div>
  </div>
</div> -->

<!-- ===================== WITHDRAW MODAL ===================== -->
<!-- <div class="modal fade" id="withdrawModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title text-navy">Withdraw funds</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-2">
        <p class="text-muted small mb-3">Withdraw available balance to your linked wallet or bank account.</p>
        <form onsubmit="return false;">
          <div class="mb-3">
            <label class="form-label" for="wdDestination">Destination</label>
            <select class="form-select" id="wdDestination">
              <option>Linked bank account ····4821</option>
              <option>BTC wallet ····f92a</option>
              <option>ETH wallet ····9dc1</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="wdAmount">Amount (USD)</label>
            <input type="number" class="form-control" id="wdAmount" placeholder="e.g. 500" min="1" max="6140.10">
          </div>
          <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal">Confirm withdrawal</button>
        </form>
        <p class="text-muted small text-center mt-3 mb-0">UI preview only — no funds are transferred and no backend is connected.</p>
      </div>
    </div>
  </div>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  /* ---------- Live crypto prices from CoinGecko public API ---------- */
  const COIN_IDS = ['bitcoin','ethereum','tether','binancecoin','solana','ripple','cardano','dogecoin'];
  const marketBody = document.getElementById('marketBody');
  const updatedText = document.getElementById('updatedText');
  const liveDot = document.getElementById('liveDot');

  const FALLBACK = [
    {symbol:'BTC', name:'Bitcoin', price:64230.12, change:1.8},
    {symbol:'ETH', name:'Ethereum', price:3120.55, change:-0.6},
    {symbol:'USDT', name:'Tether', price:1.00, change:0.0},
    {symbol:'BNB', name:'BNB', price:582.30, change:2.1},
    {symbol:'SOL', name:'Solana', price:148.90, change:4.3},
    {symbol:'XRP', name:'XRP', price:0.612, change:-1.2},
  ];

  function sparkPath(seed, up){
    let pts = [];
    let v = seed % 10;
    for(let i=0;i<8;i++){
      v = (v * 13 + i * 7) % 20;
      pts.push(v);
    }
    if(!up) pts = pts.map(p => 20 - p);
    const w = 80, h = 28, step = w / (pts.length - 1);
    const norm = pts.map(p => h - (p / 20) * h);
    return norm.map((y, i) => `${i === 0 ? 'M' : 'L'} ${i*step},${y}`).join(' ');
  }

  function renderRows(coins){
    marketBody.innerHTML = '';
    coins.forEach((c, i) => {
      const up = c.change >= 0;
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>
          <div class="d-flex align-items-center gap-2">
            <span class="coin-icon">${c.symbol.slice(0,3)}</span>
            <div>
              <div class="fw-semibold text-navy small">${c.name}</div>
              <div class="text-muted" style="font-size:0.78rem;">${c.symbol}</div>
            </div>
          </div>
        </td>
        <td class="fw-semibold text-navy">$${c.price.toLocaleString(undefined,{minimumFractionDigits: c.price < 2 ? 4 : 2, maximumFractionDigits: c.price < 2 ? 4 : 2})}</td>
        <td>
          <span class="badge rounded-pill ${up ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'} d-inline-flex align-items-center gap-1 change-pill">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">${up
              ? '<path d="M5 15L10 10L14 14L19 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>'
              : '<path d="M5 9L10 14L14 10L19 16" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>'}</svg>
            ${up ? '+' : ''}${c.change.toFixed(2)}%
          </span>
        </td>
        <td>
          <svg class="spark" viewBox="0 0 80 28" xmlns="http://www.w3.org/2000/svg">
            <path d="${sparkPath(i + Math.round(c.price), up)}" fill="none" stroke="${up ? '#1FA971' : '#E4483F'}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </td>
      `;
      marketBody.appendChild(tr);
    });
  }

  async function fetchPrices(){
    try{
      const url = `https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${COIN_IDS.join(',')}&order=market_cap_desc&price_change_percentage=24h`;
      const res = await fetch(url);
      if(!res.ok) throw new Error('Network response not ok');
      const data = await res.json();
      const coins = data.map(d => ({
        symbol: d.symbol.toUpperCase(),
        name: d.name,
        price: d.current_price,
        change: d.price_change_percentage_24h ?? 0
      }));
      renderRows(coins);
      liveDot.style.background = '#1FA971';
      updatedText.textContent = 'Live · updated ' + new Date().toLocaleTimeString();
    }catch(err){
      renderRows(FALLBACK);
      liveDot.style.background = '#E4483F';
      updatedText.textContent = 'Live feed unavailable — showing sample data';
    }
  }

  fetchPrices();
  setInterval(fetchPrices, 30000);
</script>

</body>
</html>
