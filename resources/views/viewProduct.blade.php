<!DOCTYPE html>
<html>
<head>
    <title>Twisoom Flower Shop</title>
    @include('header')

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #fff0f5;
        }

        h1 {
            text-align: center;
            color: #e91e63;
            padding: 20px;
        }

        .container {
            margin: auto;
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .img-box {
            position: relative; /* ✅ FIX badge */
        }

        .img-box img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #e91e63;
            color: white;
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 12px;
            z-index: 2;
        }

        .title {
            font-weight: bold;
            padding: 5px 10px;
        }

        .price {
            color: #e91e63;
            font-weight: bold;
            padding: 0 10px;
        }

        .desc {
            font-size: 13px;
            color: #777;
            padding: 0 10px 10px;
        }

        .controls {
            text-align: center;
            margin-bottom: 20px;
        }

        input, select {
            padding: 8px;
            margin: 5px;
        }

        .slide-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .mySlides {
            display: none;
        }

        #showdetails{
            width: 100%;
            padding: 10px;
            border: none;
            background: #e91e63;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>

<h1>🌸 Twisoom Flower Shop</h1>

<div class="controls">
    <input type="text" id="search" placeholder="Search product...">

    <select id="typeFilter">
        <option value="all">全部</option>
        <option value="soap_flower">香皂花</option>
        <option value="twist_stick">扭扭棒</option>
        <option value="real flower">鲜花/真花</option>
    </select>

    <select id="priceSort">
        <option value="">Sort Price</option>
        <option value="low">Low → High</option>
        <option value="high">High → Low</option>
    </select>
</div>

<div class="container">
<div class="grid" id="grid">

@php
$types = [
    'twist_stick' => '扭扭棒',
    'soap_flower' => '香皂花',
    'real flower' => '真花',
];
@endphp

@foreach($products as $p)
<div class="card" data-type="{{ $p->type }}" data-price="{{ $p->productPrice }}">

<div class="img-box">

<a href="/product/{{ $p->id }}" style="text-decoration:none; color:inherit;">

<div class="badge">
    {{ $types[$p->type] ?? '花束' }}
</div>

<div class="slide-wrapper">

@foreach($p->images as $img)
    @php
        $isUrl = \Illuminate\Support\Str::startsWith($img->image_path, ['http://', 'https://']);
        $src = $isUrl ? $img->image_path : asset('storage/' . $img->image_path);
    @endphp

    <img class="mySlides"
         src="{{ $src }}"
         alt="{{ $p->productName }}">
@endforeach

</div>

<div class="title">{{ $p->productName }}</div>
<div class="price">RM {{ $p->productPrice }}</div>
<div class="desc">{{ $p->productDesc }}</div>

</a>
</div>

<div class="adminTag" style="display:none">
    <a href="/edit/{{ $p->id }}">Edit</a>
</div>

<button id=showdetails onclick="window.location='/product/{{ $p->id }}'">
    More Details
</button>

</div>
@endforeach

</div>
</div>

<script>

// show admin button
if (window.location.search.includes("admin=1")) {
    document.querySelectorAll(".adminTag").forEach(tag => {
        tag.style.display = "block";
    });
}

// FILTER
const search = document.getElementById("search");
const typeFilter = document.getElementById("typeFilter");
const priceSort = document.getElementById("priceSort");
const grid = document.getElementById("grid");

function filterCards() {
    let keyword = search.value.toLowerCase();
    let type = typeFilter.value;
    let cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        let name = card.querySelector(".title").innerText.toLowerCase();
        let desc = card.querySelector(".desc").innerText.toLowerCase();
        let cardType = card.getAttribute("data-type");

        let matchSearch = name.includes(keyword) || desc.includes(keyword);
        let matchType = (type === "all" || type === cardType);

        card.style.display = (matchSearch && matchType) ? "block" : "none";
    });

    sortCards();
}

function sortCards() {
    let cards = Array.from(document.querySelectorAll(".card"));
    let sort = priceSort.value;

    cards.sort((a, b) => {
        let priceA = parseFloat(a.getAttribute("data-price"));
        let priceB = parseFloat(b.getAttribute("data-price"));

        if (sort === "low") return priceA - priceB;
        if (sort === "high") return priceB - priceA;
        return 0;
    });

    cards.forEach(card => grid.appendChild(card));
}

search.addEventListener("input", filterCards);
typeFilter.addEventListener("change", filterCards);
priceSort.addEventListener("change", sortCards);


// SLIDESHOW
document.querySelectorAll(".card").forEach(card => {

    let slides = card.querySelectorAll(".mySlides");
    let index = 0;

    if (slides.length === 0) return;

    if (slides.length === 1) {
        slides[0].style.display = "block";
        return;
    }

    function showSlide(i) {
        slides.forEach(s => s.style.display = "none");
        slides[i].style.display = "block";
    }

    showSlide(index);

    setInterval(() => {
        index = (index + 1) % slides.length;
        showSlide(index);
    }, 2000);
});

</script>

</body>
</html>
