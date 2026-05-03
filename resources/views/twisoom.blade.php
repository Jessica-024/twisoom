<!DOCTYPE html>
<html>
<head>
    <title>Twisoom Flower Shop</title>
@include('header')

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(180deg, #fff0f5, #ffffff);
        }

        /* HERO */
        .hero {
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
background: url('/images/TWIST.png') center/cover no-repeat;
       position: relative;
            color: white;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 12px 20px;
            margin: 5px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-pink {
            background: #e91e63;
            color: white;
        }

        .btn-pink:hover {
            background: #c2185b;
        }

        .btn-white {
            background: white;
            color: #e91e63;
        }

        .btn-white:hover {
            background: #ffe4ec;
        }

        /* SECTION */
        .section {
            padding: 60px 20px;
            text-align: center;
        }

        .section h2 {
            color: #e91e63;
            margin-bottom: 10px;
        }

        .section p {
            color: #666;
        }

        /* FEATURES */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 1000px;
            margin: auto;
            margin-top: 30px;
        }

        .box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 20px;
            color: #888;
        }

        @media(max-width: 768px) {
            .features {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

<!-- HERO -->
<div class="hero">

    <div class="hero-content">
        <h1>🌸 Twisoom Flower Shop</h1>
        <p>Handmade Bouquet • Soap Flower • Custom Gifts</p>

        <a href="/viewProduct" class="btn btn-pink">Shop Now</a>

    </div>

</div>

<!-- ABOUT -->
<div class="section">
    <h2>About Us</h2>
    <p>We create handmade flower gifts that bring happiness to every moment 💖</p>

    <div class="features">

        <div class="box">
            🌹 Handmade Bouquet<br>
            High quality custom flowers
        </div>

        <div class="box">
            🎁 Custom Orders<br>
            Personalized gift design
        </div>

        <div class="box">
            🚚 Delivery<br>
            Fast delivery in Malaysia
        </div
        >
<!-- CONTACT US -->
<div id="contact" class="contact-section">
    <h2>📩 Contact Us</h2>
    <p>Follow us or contact for custom bouquet 💖</p>

    <div class="contact-box">

        <!-- Instagram -->
        <a href="https://www.instagram.com/twisoom/" target="_blank" class="contact-card">
            📷 Instagram
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/601124225090" target="_blank" class="contact-card">
            💬 WhatsApp
        </a>

        <!-- Xiaohongshu (XHS) -->
        <a href="https://www.xiaohongshu.com/user/profile/62962c25000000002102a17c" target="_blank" class="contact-card">
            🌸 XiaoHongShu
        </a>

    </div>

</div>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    © 2026 Twisoom Flower Shop • Made with 💖
</div>

</body>
</html>
