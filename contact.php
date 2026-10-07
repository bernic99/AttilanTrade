<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact Us — AttilanTrade</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="AttilanTrade" name="keywords">
    <meta content="Contact AttilanTrade support" name="description">
    <link rel="icon" type="image/x-icon" href="img/6.png">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (used by bi bi-arrow-up / bi bi-arrow-right below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Font Awesome (used by the fab fa-* social icons below) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root{
            --navy:#0B2545;
            --deep-blue:#13315C;
            --azure:#1E63E9;
            --sky:#5B9DF9;
            --pale:#EAF2FF;
        }

        body{
            margin:0;
            font-family:'Inter', sans-serif;
            color:#10233F;
            background:#F4F8FF;
        }
        h1,h2,h3,h4,h5{font-family:'Space Grotesk', sans-serif;}

        /* ---------- Page header ---------- */
        .about-bg{
            background:linear-gradient(135deg, var(--navy), var(--deep-blue) 70%, #0F3D7A);
        }
        .about-bg h5{
            color:var(--sky);
            font-weight:600;
            letter-spacing:0.03em;
            text-transform:uppercase;
            font-size:0.9rem;
            margin-bottom:8px;
        }
        .about-bg h4{
            font-family:'Space Grotesk', sans-serif;
            font-weight:600;
            font-size:1.5rem;
            margin:0;
        }

        /* ---------- Contact section ---------- */
        .bg-secondary{
            background:#fff !important;
        }
        .py-6{padding-top:4rem; padding-bottom:4rem;}

        .bg-secondary h1{
            color:var(--navy) !important;
            font-size:1.9rem;
        }

        .form-floating > .form-control,
        .form-floating > textarea.form-control{
            border:1.5px solid #DCE7F9;
            border-radius:11px;
        }
        .form-floating > .form-control:focus{
            border-color:var(--azure);
            box-shadow:0 0 0 3px rgba(30,99,233,0.15);
        }
        .form-floating > label{
            color:#5D7290;
        }

        .btn.about-bg{
            border:none;
            border-radius:11px;
            font-weight:600;
            letter-spacing:0.01em;
            transition:opacity .2s ease, transform .15s ease;
        }
        .btn.about-bg:hover{
            opacity:0.92;
            transform:translateY(-1px);
            color:#fff;
        }

        /* ---------- Contact info panel + footer background ---------- */
        .sec2-background{
            background:linear-gradient(160deg, var(--navy), var(--deep-blue) 60%, #0F3D7A);
        }

        .contact-body ul{
            list-style:none;
            margin:0;
            padding:0;
        }
        .contact-body li{
            margin-bottom:22px;
        }
        .contact-body .list{
            display:flex;
            align-items:center;
            gap:14px;
        }
        .contact-body .list img{
            width:22px;
            height:22px;
            filter:brightness(0) invert(1);
            flex-shrink:0;
        }
        .contact-body .list span{
            font-weight:600;
            color:var(--sky);
        }
        .contact-body .list div{
            font-size:0.98rem;
            line-height:1.5;
        }

        /* ---------- Footer ---------- */
        .sec2-background h3{
            font-size:1.15rem;
        }
        .sec2-background a.text-secondary{
            color:#AEC6F2 !important;
            text-decoration:none;
            font-size:0.92rem;
            transition:color .15s ease;
        }
        .sec2-background a.text-secondary:hover{
            color:#fff !important;
        }
        .sec2-background .bi-arrow-right.text-primary{
            color:var(--sky) !important;
        }

        .btn-lg-square{
            width:44px;
            height:44px;
            padding:0;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.16);
            color:#fff;
        }
        .btn-lg-square:hover{
            background:var(--azure);
            border-color:var(--azure);
            color:#fff;
        }

        .border-top{
            border-color:rgba(255,255,255,0.12) !important;
        }
        .border-top a{
            color:#AEC6F2 !important;
        }

        /* ---------- Back to top ---------- */
        .back-to-top{
            position:fixed;
            bottom:24px;
            right:24px;
            width:46px;
            height:46px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:var(--azure) !important;
            border:none;
            box-shadow:0 8px 20px rgba(11,37,69,0.25);
            z-index:99;
        }
        .back-to-top:hover{
            background:#1854c9 !important;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 991px){
            .py-6{padding-top:2.5rem; padding-bottom:2.5rem;}
            .sec2-background{min-height:auto !important;}
        }
        @media (max-width: 575px){
            .about-bg h4{font-size:1.2rem;}
            .contact-body{padding:2rem 1.5rem !important;}
        }
    </style>
</head>

<body>

<!-- Page Header Start -->
<div class="container-fluid about-bg p-5">
    <div class="row">
        <div class="col-12 text-center">
            <h5 class="  ">Contact Us</h5>
            <h4 class=" text-white ">We are open for communication, just message us below.</h4>

        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid bg-secondary px-0">
    <div class="row g-0">
        <div class="col-lg-6 py-6 px-5">
            <h1 class=" mb-4" style="color: rgb(20, 20, 90);">Send us a message</h1>
            <form id="contactForm" >
                <div class="row g-3">
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form-floating-1" placeholder="John Doe">
                            <label for="form-floating-1">Full Name</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="form-floating-2"
                                placeholder="name@example.com">
                            <label for="form-floating-2">Email </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form-floating-3" placeholder="Subject">
                            <label for="form-floating-3">Subject</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="messageInput" placeholder="Message"
                                style="height: 150px"></textarea>
                            <label for="messageInput">Message</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn about-bg text-white w-100 py-3" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-lg-6 sec2-background" style="min-height: 400px;">
            <div class="position-relative h-100">
                <div class="info h-100 p-5 ">


                    <div class="contact-body ">
                        <ul>
                            <li>
                                <div class="list ">
                                    <img src="images/email.png" alt="">
                                    <div class="text-white"><span>Email: </span>support@attilantrade.example</div>
                                </div>
                            </li>
                            <li>
                                <div class="list">
                                    <img src="images/address.png" alt="">
                                    <div class="text-white"><span>Address: </span>504 5th Ave ford city Pennsylvania</div>
                                </div>
</li>
                                <li>
                                <div class="list">
                                    <img src="images/sms.png" alt="">
                                    <div class="text-white"><span>SMS: </span>+1 (302) 713-8003</div>
                                </div>
                                </li>
                                <div class="list">
                                    <img src="images/whatsapp.png" alt="">
                                    <div class="text-white"><span>Whatsapp: </span><a href="https://wa.me/qr/4ED4JNN2MN3RB1">Click here to send a message</a></div>
                                </div>
                            </li>
                            <li>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<!-- Footer Start -->
<div class="container-fluid sec2-background text-secondary p-5">
    <div class="row g-5">
        <div class="col-lg-3 col-md-6">
            <h3 class="text-white mb-4">Quick Links</h3>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our
                    Services</a>
                <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog
                    Post</a>
                <a class="text-secondary" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <h3 class="text-white mb-4">Follow Us</h3>
            <div class="d-flex">
                <a class="btn btn-lg  btn-lg-square rounded-circle me-2" href="#"><i
                        class="fab fa-twitter fw-normal"></i></a>
                <a class="btn btn-lg  btn-lg-square rounded-circle me-2" href="#"><i
                        class="fab fa-facebook-f fw-normal"></i></a>
                <a class="btn btn-lg  btn-lg-square rounded-circle me-2" href="#"><i
                        class="fab fa-linkedin-in fw-normal"></i></a>
                <a class="btn btn-lg  btn-lg-square rounded-circle" href="#"><i
                        class="fab fa-instagram fw-normal"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid sec2-background text-secondary text-center border-top py-4 px-5"
    style="border-color: rgba(256, 256, 256, .1) !important;">
    <p class="m-0">&copy; <a class="text-secondary border-bottom" href="#">ATTILANTRADE</a>. All Rights Reserved.
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
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
    form.addEventListener('submit', function(e) {
      e.preventDefault(); // prevent form submission
      alert("Message sent");
      form.reset(); // clear all input fields
    });
  </script>


</body>

</html>