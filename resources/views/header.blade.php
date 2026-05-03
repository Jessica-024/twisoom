<!DOCTYPE html>
<html>
<head>
    <title>Twisoom Cart</title>

<style>

/* ===== HEADER ===== */
.header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 25px;
    background:white;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    position:sticky;
    top:0;
    z-index:1000;
}

.logo {
    font-size:22px;
    font-weight:bold;
    color:#e91e63;
    text-decoration:none;
}

.header-right a {
    margin-left:15px;
    text-decoration:none;
    color:#333;
}

/* CART BUTTON */
.cart-fab {
    position:fixed;
    bottom:20px;
    right:20px;
    background:#e91e63;
    color:white;
    border:none;
    padding:12px 16px;
    border-radius:50px;
    cursor:pointer;
}

/* BACKDROP */
.backdrop {
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    display:none;
    z-index:999;
}

.backdrop.show {
    display:block;
}

/* DRAWER */
.cart-drawer {
    position:fixed;
    top:0;
    right:-400px;
    width:350px;
    height:100%;
    background:white;
    transition:0.3s;
    z-index:1000;
    display:flex;
    flex-direction:column;
}

.cart-drawer.open {
    right:0;
}

.cart-header {
    padding:15px;
    border-bottom:1px solid #eee;
    display:flex;
    justify-content:space-between;
}

.cart-items {
    flex:1;
    overflow-y:auto;
    padding:10px;
}

.item {
    border-bottom:1px solid #eee;
    padding:10px 0;
}

.cart-footer {
    padding:15px;
    border-top:1px solid #eee;
}

button {
    cursor:pointer;
}

.checkout-btn {
    width:100%;
    background:#25d366;
    color:white;
    border:none;
    padding:10px;
    border-radius:10px;
}

.clear-btn {
    width:100%;
    margin-top:10px;
    background:#eee;
    border:none;
    padding:10px;
}

</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <a href="/twisoom" class="logo">🌸 Twisoom</a>
    <div class="header-right">
        <a href="/viewProduct">Product</a>
        <a href="/twisoom#contact">Contact</a>
  <br>           <div class="adminTag" style="display:none">
    <br> <a href="/product">Addproduct</a>
</div>
    </div>
</div>

<!-- CART BUTTON -->
<button onclick="toggleCart()" class="cart-fab">
    🛒 Cart (<span id="cartCount">0</span>)
</button>

<!-- BACKDROP -->
<div id="backdrop" class="backdrop" onclick="toggleCart()"></div>

<!-- CART DRAWER -->
<div id="cartDrawer" class="cart-drawer">

    <div class="cart-header">
        <h3>🛒 Cart</h3>
        <button onclick="toggleCart()">✖</button>
    </div>

    <div id="cartItems" class="cart-items"></div>

    <div class="cart-footer">
        <div>Total: RM <span id="cartTotal">0</span></div>

        <button onclick="checkoutWhatsApp()" class="checkout-btn">
            💬 Checkout WhatsApp
        </button>

        <button onclick="clearCart()" class="clear-btn">
            Clear Cart
        </button>
    </div>

</div>

<script>

let cart = JSON.parse(localStorage.getItem("cart")) || [];

/* OPEN CLOSE */
function toggleCart() {
    document.getElementById("cartDrawer").classList.toggle("open");
    document.getElementById("backdrop").classList.toggle("show");
}

/* ADD TO CART */
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
}

/* UPDATE UI */
function updateCartUI() {

    let container = document.getElementById("cartItems");
    let count = document.getElementById("cartCount");
    let totalEl = document.getElementById("cartTotal");

    container.innerHTML = "";

    let total = 0;

    cart.forEach((item, index) => {

        let subtotal = item.price * item.qty;
        total += subtotal;

        container.innerHTML += `
            <div class="item">
                <b>${item.name}</b><br>
                RM ${item.price} × ${item.qty} = RM ${subtotal.toFixed(2)}

                <div>
                    <button onclick="decreaseQty(${index})">-</button>
                    <span>${item.qty}</span>
                    <button onclick="increaseQty(${index})">+</button>
                </div>
            </div>
        `;
    });

    count.innerText = cart.reduce((s,i)=>s+i.qty,0);
    totalEl.innerText = total.toFixed(2);
}

/* QTY */
function increaseQty(i){
    cart[i].qty++;
    saveCart();
}

function decreaseQty(i){
    cart[i].qty--;
    if(cart[i].qty <= 0){
        cart.splice(i,1);
    }
    saveCart();
}

/* SAVE */
function saveCart(){
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartUI();
}

/* CLEAR */
function clearCart(){
    cart = [];
    saveCart();
}

/* CHECKOUT */
function checkoutWhatsApp(){

    if(cart.length === 0){
        alert("Cart empty");
        return;
    }

    let msg = "Hi I want to order:%0A%0A";
    let total = 0;

    cart.forEach((item,i)=>{
        let sub = item.price * item.qty;
        msg += `${i+1}. ${item.name} x${item.qty} = RM ${sub.toFixed(2)}%0A`;
        total += sub;
    });

    msg += `%0ATotal: RM ${total.toFixed(2)}`;

    window.open("https://wa.me/601124225090?text=" + msg, "_blank");
}

/* INIT */
updateCartUI();

</script>

</body>
</html>
