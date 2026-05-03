<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->productName }}</title>
@include('header')
    <style>
.slide-wrapper {
    position: relative;
    width: 100%;
    max-width: 500px;
    margin: auto;
    overflow: hidden;
}

.mySlides {
    width: 100%;
    display: none;
}

/* show first image default (optional) */
.mySlides:first-child {
    display: block;
}

/* common button style */
.slide {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.4);
    color: white;
    border: none;
    padding: 10px 14px;
    cursor: pointer;
    border-radius: 50%;
}

/* left button */
.slide.left {
    left: 10px;
}

/* right button */
.slide.right {
    right: 10px;
}

.slide:hover {
    background: rgba(0,0,0,0.7);
}
        body {
            margin: 0;
            font-family: Arial;
            background: #fff0f5;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }

        .card {
            display: flex;
            gap: 30px;
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .img {
            width: 50%;
        }

        .img img {
            width: 100%;
            border-radius: 15px;
            object-fit: cover;
        }

        .info {
            width: 50%;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            color: #e91e63;
        }

        .price {
            font-size: 22px;
            margin: 10px 0;
            color: #333;
        }

        .type {
            display: inline-block;
            background: #e91e63;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .desc {
            margin-top: 15px;
            color: #666;
            line-height: 1.5;
        }

        .btn {
            margin-top: 20px;
            display: inline-block;
            padding: 12px 20px;
            background: #25d366;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #e91e63;
            text-decoration: none;
        }

        @media(max-width: 768px) {
            .card {
                flex-direction: column;
            }

            .img, .info {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="/viewProduct" class="back">← Back</a>

    <div class="card">

    <div class="img">

        <h1 div class="badge">{{ $product->productName }}</div>
        </h1>
   <div class="slide-wrapper">

             @foreach($product->images as $img)
    @php
        // 判断是否是完整 URL
        $isUrl = Str::startsWith($img->image_path, ['http://', 'https://']);
    @endphp

    <img class="mySlides"
         src="{{ $isUrl ? $img->image_path : asset('storage/' . $img->image_path) }}"
         style="display:block;  object-fit:cover;">
@endforeach


    <!-- LEFT button -->
    <button class="slide left" onclick="plusDivs(-1)">&#10094;</button>

    <!-- RIGHT button -->
    <button class="slide right" onclick="plusDivs(1)">&#10095;</button>

</div>

        <div class="info">


                            <span class="type">

                        @if($product->type == 'twist_stick')
                            扭扭棒
                        @elseif($product->type == 'soap_flower')
                            香皂花
                        @else
                            花束
                        @endif
                        </span>
            <div class="title">{{ $product->productName }}</div>

            <div class="price">RM {{ $product->productPrice }}</div>

            <div class="desc">
                {{ $product->productDesc }}
            </div>
<div style="margin-top:20px; display:flex; align-items:center; gap:10px;">




</div>
<button onclick="addToCart('{{ $product->productName }}', '{{ $product->productPrice }}')">
     🛒 Add to Cart
    </button>
            <!-- WhatsApp Order Button -->
            <a class="btn"
               href="https://wa.me/601124225090?text=Hi%20I%20want%20to%20order%20{{ $product->productName }}"
               target="_blank">
                💬 Order via WhatsApp
            </a>

        </div>

    </div>

</div>
<script>
    function addToCart(name, price) {

    price = parseFloat(price);

    let existing = cart.find(i => i.name === name);

    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({
            name: name,
            price: price,
            qty: 1
        });
    }

    saveCart();

    alert("Added successfully ✅");
}

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}
    </script>
</body>
</html>
