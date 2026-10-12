<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AttilanTrade — Automated Crypto Trading Strategies</title>
  <link rel="shortcut icon" href="images/Attilan.png" type="">
  <link rel="stylesheet" href="css/attilan.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet">



</head>

<body>

  <!-- ===================== NAV ===================== -->
  <header class="nav" id="siteNav">
    <div class="wrap">
      <a href="#home" class="brand">

        <img src="images/Attilan.png" alt="" width="120" height="59">
      </a>

      <nav aria-label="Primary">
        <ul class="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>

      <div class="nav-actions">

        <a href="signup.php" class="btn btn-solid">Sign Up</a>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false"
          aria-controls="siteNav">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
          </svg>
        </button>
      </div>
    </div>
  </header>

  <!-- ===================== HERO / HOME ===================== -->
  <section id="home" class="hero">
    <div class="wrap">
      <div class="hero-copy">
        <span class="hero-eyebrow">AUTOMATED TRADING PLATFORM</span>
        <h1>Put your crypto to work across markets, automatically.</h1>
        <p class="lead">AttilanTrade runs data-driven trading strategies across multiple exchanges on your behalf, so
          your portfolio stays active around the clock — without you watching charts all day.</p>
        <div class="hero-ctas">
          <a href="login.php" class="btn btn-solid">Access Your Account</a>
          <a href="#services" class="btn btn-ghost">See how it works</a>
        </div>
        <div class="hero-stats">
          <div class="stat">
            <div class="num">30+</div>
            <div class="label">Connected exchanges</div>
          </div>
          <div class="stat">
            <div class="num">24/7</div>
            <div class="label">Active strategy monitoring</div>
          </div>
          <div class="stat">
            <div class="num">128k</div>
            <div class="label">Accounts onboarded</div>
          </div>
        </div>
      </div>

      <div class="hero-art">
        <div class="hero-art-frame">
          <!-- Storyset illustration placeholder: "Financial technology / stock trading" theme, blue palette -->
          <svg viewBox="0 0 480 360" xmlns="http://www.w3.org/2000/svg" role="img"
            aria-label="Illustration of a trading dashboard with rising charts">
            <rect x="0" y="0" width="480" height="360" rx="16" fill="#0F2A52" />
            <rect x="32" y="40" width="416" height="90" rx="10" fill="#13315C" />
            <rect x="52" y="60" width="120" height="10" rx="5" fill="#5B9DF9" />
            <rect x="52" y="80" width="80" height="8" rx="4" fill="#3A5C93" />
            <circle cx="410" cy="75" r="22" fill="#1E63E9" />
            <path d="M400 76l6 6 12-14" stroke="#EAF2FF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
              fill="none" />
            <polyline points="52,260 110,230 150,250 200,180 250,205 300,140 350,160 400,100 428,120" fill="none"
              stroke="#5B9DF9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="428" cy="120" r="6" fill="#EAF2FF" />
            <g fill="#1E63E9" opacity="0.85">
              <rect x="60" y="290" width="20" height="40" rx="3" />
              <rect x="95" y="270" width="20" height="60" rx="3" />
              <rect x="130" y="300" width="20" height="30" rx="3" />
              <rect x="165" y="255" width="20" height="75" rx="3" />
              <rect x="200" y="280" width="20" height="50" rx="3" />
            </g>
            <rect x="250" y="255" width="180" height="75" rx="10" fill="#13315C" />
            <rect x="266" y="270" width="90" height="8" rx="4" fill="#5B9DF9" />
            <rect x="266" y="286" width="60" height="8" rx="4" fill="#3A5C93" />
            <rect x="266" y="304" width="130" height="10" rx="5" fill="#0B2545" />
            <rect x="266" y="304" width="80" height="10" rx="5" fill="#5B9DF9" />
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== TRUST BAR ===================== -->
  <div class="trustbar">
    <div class="wrap">
      <div class="trustbar-item">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor"
            stroke-width="1.8" stroke-linejoin="round" />
        </svg>
        Bank-grade encryption
      </div>
      <div class="trustbar-item">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
          <path d="M12 7V12L15 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
        </svg>
        Real-time execution
      </div>
      <div class="trustbar-item">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 12H7L10 20L14 4L17 12H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
        Transparent performance history
      </div>
      <div class="trustbar-item">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="4" y="4" width="16" height="16" rx="3" stroke="currentColor" stroke-width="1.8" />
          <path d="M8 9H16M8 13H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
        </svg>
        Withdraw anytime
      </div>
    </div>
  </div>

  <!-- ===================== ABOUT ===================== -->
  <section id="about" class="about">
    <div class="wrap">
      <div class="about-art">
        <!-- Storyset illustration placeholder: "Team analyzing financial data" theme, blue palette -->
        <svg viewBox="0 0 420 340" xmlns="http://www.w3.org/2000/svg" role="img"
          aria-label="Illustration of people analyzing a financial chart together">
          <rect x="0" y="0" width="420" height="340" rx="16" fill="#EAF2FF" />
          <rect x="60" y="60" width="300" height="160" rx="10" fill="#FFFFFF" stroke="#C6D8F5" stroke-width="2" />
          <polyline points="80,190 130,150 170,170 210,110 250,140 300,90 340,120" fill="none" stroke="#1E63E9"
            stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
          <circle cx="340" cy="120" r="5" fill="#0B2545" />
          <circle cx="140" cy="270" r="26" fill="#1E63E9" />
          <rect x="118" y="296" width="44" height="30" rx="10" fill="#1E63E9" />
          <circle cx="230" cy="260" r="30" fill="#5B9DF9" />
          <rect x="204" y="290" width="52" height="34" rx="12" fill="#5B9DF9" />
          <circle cx="310" cy="272" r="24" fill="#13315C" />
          <rect x="290" y="296" width="40" height="28" rx="10" fill="#13315C" />
        </svg>
      </div>
      <div class="about-copy">
        <span class="section-tag">ABOUT ATTILANTRADE</span>
        <h2>A trading engine built to work harder than a manual strategy can.</h2>
        <p>AttilanTrade connects to major exchanges and applies rules-based trading strategies to your deposited funds —
          scanning price movement, liquidity, and volatility signals continuously, then executing trades within the risk
          limits you set. You stay in control of your funds and can withdraw them at any time.</p>
        <div class="about-points">
          <div class="about-point">
            <span class="icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor"
                  stroke-width="1.8" stroke-linejoin="round" />
              </svg>
            </span>
            <div>
              <h4>Your funds, your custody rules</h4>
              <p>Set withdrawal permissions and risk limits before any strategy touches your balance.</p>
            </div>
          </div>
          <div class="about-point">
            <span class="icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 12L10 18L20 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </span>
            <div>
              <h4>Backtested, not guesswork</h4>
              <p>Every strategy is tested against historical market data before it's offered to users.</p>
            </div>
          </div>
          <div class="about-point">
            <span class="icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 12H7L10 20L14 4L17 12H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </span>
            <div>
              <h4>Full performance visibility</h4>
              <p>Track every trade, gain, and loss in a transparent, exportable activity log.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== SERVICES ===================== -->
  <section id="services" class="services">
    <div class="wrap">
      <div class="section-head">
        <span class="section-tag">WHAT WE OFFER</span>
        <h2>Everything you need to trade without watching the market all day.</h2>
        <p>From automated strategies to manual controls, AttilanTrade gives you the tools to participate in crypto
          markets on your own terms.</p>
      </div>

      <div class="service-grid">
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 3V21H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
              <path d="M7 15L11 10L14 13L20 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </span>
          <h3>Automated strategies</h3>
          <p>Choose from a range of rules-based strategies that trade across exchanges within limits you define.</p>
        </div>
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="4" y="4" width="16" height="16" rx="3" stroke="currentColor" stroke-width="1.8" />
              <path d="M8 9H16M8 13H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
          </span>
          <h3>Multi-exchange routing</h3>
          <p>Your strategy can act on price differences and liquidity across 30+ connected trading venues.</p>
        </div>
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
              <path d="M12 7V12L15 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
          </span>
          <h3>Real-time monitoring</h3>
          <p>Track open positions, executed trades, and account balance from a single live dashboard.</p>
        </div>
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor"
                stroke-width="1.8" stroke-linejoin="round" />
            </svg>
          </span>
          <h3>Risk controls</h3>
          <p>Set stop-loss thresholds, exposure caps, and withdrawal rules that the platform always respects.</p>
        </div>
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 12H7L10 20L14 4L17 12H21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </span>
          <h3>Performance reporting</h3>
          <p>Download detailed statements of every trade, fee, and balance change for your records.</p>
        </div>
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
              <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
            </svg>
          </span>
          <h3>Instant deposits</h3>
          <p>Fund your account with major cryptocurrencies and start allocating within minutes.</p>
        </div>
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="3" y="7" width="18" height="12" rx="2" stroke="currentColor" stroke-width="1.8" />
              <path d="M3 10H21" stroke="currentColor" stroke-width="1.8" />
            </svg>
          </span>
          <h3>Flexible withdrawals</h3>
          <p>Request a withdrawal at any time; funds are not locked into a strategy against your wishes.</p>
        </div>
        <div class="service-card">
          <span class="icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 12A8 8 0 1 1 12 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
              <path d="M20 4V9H15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </span>
          <h3>24/7 support</h3>
          <p>Reach a real support specialist any time you have a question about your account or a trade.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== PROCESS ===================== -->
  <section class="process">
    <div class="wrap">
      <span class="section-tag">HOW IT WORKS</span>
      <h2>Three steps to get a strategy working for you.</h2>
      <p>Getting started takes a few minutes. From there, the platform handles execution while you keep full visibility
        and control.</p>

      <div class="process-steps">
        <div class="process-step">
          <div class="step-index">01</div>
          <h4>Create your account</h4>
          <p>Sign up, verify your identity, and connect a wallet or deposit method.</p>
        </div>
        <div class="process-step">
          <div class="step-index">02</div>
          <h4>Choose a strategy &amp; limits</h4>
          <p>Pick a risk level and set the exposure caps you're comfortable with.</p>
        </div>
        <div class="process-step">
          <div class="step-index">03</div>
          <h4>Monitor &amp; withdraw anytime</h4>
          <p>Watch performance live on your dashboard and withdraw funds whenever you choose.</p>
        </div>
      </div>

      <div class="risk-note">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18A2 2 0 0 0 3.55 21H20.45A2 2 0 0 0 22.18 18L13.71 3.86A2 2 0 0 0 10.29 3.86Z"
            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p><strong>Risk disclosure:</strong> Cryptocurrency trading involves substantial risk, including the possible
          loss of principal. Past performance does not guarantee future results, and no strategy can promise fixed or
          daily returns. Only trade with funds you can afford to lose.</p>
      </div>
    </div>
  </section>

  <!-- ===================== CTA BAND ===================== -->
  <div class="cta-band">
    <div class="wrap">
      <div>
        <h3>Ready to put a strategy to work?</h3>
        <p>Create your account in minutes — no commitment required.</p>
      </div>
      <a href="signup.php" class="btn btn-solid">Get started free</a>
    </div>
  </div>

  <!-- ===================== CONTACT ===================== -->
  <section id="contact" class="contact">
    <div class="wrap">
      <div class="contact-copy">
        <span class="section-tag">GET IN TOUCH</span>
        <h2>Questions before you deposit? We're here for that.</h2>
        <p>Our support team can walk you through how strategies work, help with account verification, or troubleshoot a
          deposit — reach out any way that's convenient.</p>

        <div class="contact-list">
          <div class="contact-item">
            <span class="icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4H20V18H4V4Z" stroke="currentColor" stroke-width="1.8" />
                <path d="M4 6L12 13L20 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
              </svg>
            </span>
            <div>
              <h4>Email</h4>
              <p>attilantrade@gmail.com</p>
            </div>
          </div>
          <div class="contact-item">
            <span class="icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4 5H8L10 10L7 12C8 15 9 16 12 17L14 14L19 16V20C19 20.5523 18.5523 21 18 21C10 21 3 14 3 6C3 5.4477 3.4477 5 4 5Z"
                  stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
              </svg>
            </span>
            <div>
              <h4>Phone</h4>
              <p>+1 (581) 592-0104 — Mon–Fri, 9am–6pm</p>
            </div>
          </div>
          <div class="contact-item">
            <span class="icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L4 6V11C4 16 7.5 20.5 12 22C16.5 20.5 20 16 20 11V6L12 2Z" stroke="currentColor"
                  stroke-width="1.8" stroke-linejoin="round" />
              </svg>
            </span>
            <div>
              <h4>Office</h4>
              <p>504 5th Ave Ford city Pennsylvania</p>
            </div>
          </div>
        </div>
      </div>

      <form class="contact-form" onsubmit="return false;">
        <div class="form-row">
          <div class="field">
            <label for="fname">Full name</label>
            <input type="text" id="form-floating-1" name="fname" placeholder="Jordan" required>
          </div>

        </div>
        <div class="form-row">
          <div class="field full">
            <label for="email">Email address</label>
            <input type="email" id="form-floating-2" name="email" placeholder="you@email.com" required>
          </div>
        </div>
        <div class="form-row">
          <div class="field full">
            <label for="message">Message</label>
            <textarea id="messageInput" name="message" rows="4" placeholder="Tell us what you'd like help with"
              required></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-solid">Send message</button>

      </form>
    </div>
  </section>

  <!-- ===================== FOOTER ===================== -->
  <footer>
    <div class="wrap">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="#home" class="brand">
            <span class="logo-mark" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 17L9 11L13 15L21 7" stroke="white" stroke-width="2.2" stroke-linecap="round"
                  stroke-linejoin="round" />
                <path d="M15 7H21V13" stroke="white" stroke-width="2.2" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </span>
            AttilanTrade
          </a>
          <p>Automated crypto trading strategies with full transparency and control. Trading involves risk; see our risk
            disclosure before depositing.</p>
        </div>
        <div class="footer-col">
          <h5>Navigate</h5>
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h5>Company</h5>
          <ul>
            <li><a href="#about">Our approach</a></li>
            <li><a href="#services">Strategies</a></li>
            <li><a href="#">Risk disclosure</a></li>
            <li><a href="#">Terms of service</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h5>Stay in touch</h5>
          <ul>
            <li><a href="mailto:support@attilantrade.example">support@attilantrade.example</a></li>
            <li><a href="#contact">Contact support</a></li>
            <li><a href="#">Twitter / X</a></li>
            <li><a href="#">LinkedIn</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© 2026 AttilanTrade. All rights reserved.</span>
        <span>Cryptocurrency trading carries risk. Not investment advice.</span>
      </div>
    </div>
  </footer>

  <script>
    const navToggle = document.getElementById('navToggle');
    const siteNav = document.getElementById('siteNav');
    navToggle.addEventListener('click', () => {
      const isOpen = siteNav.classList.toggle('open');
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Close mobile menu after a nav link is clicked
    document.querySelectorAll('.nav-links a').forEach(link => {
      link.addEventListener('click', () => {
        siteNav.classList.remove('open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  </script>




  <script>
    const messageInput = document.getElementById('messageInput');
    let typingTimer;
    const doneTypingInterval = 2000; // 2 seconds

    messageInput.addEventListener('keyup', () => {
      clearTimeout(typingTimer);
      if (messageInput.value) {
        typingTimer = setTimeout(() => {
          alert("Your message is being processed.");
        }, doneTypingInterval);
      }
    });

    const form = document.getElementById('contactForm');
    form.addEventListener('submit', function (e) {
      e.preventDefault(); // prevent form submission
      alert("Message sent");
      form.reset(); // clear all input fields
    });
  </script>


</body>

</html>