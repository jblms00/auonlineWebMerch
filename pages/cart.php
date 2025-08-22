<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Online Merchandise Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Your Cart</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="cart.html">Cart</a></li>
                
            </ul>
        </nav>
    </header>
    <main>
        <section class="cart">
            <h2>Cart Items</h2>
            <div id="cart-items"></div>
            <h3>Total: P<span id="total-price">0.00</span></h3>
            <button id="checkout-button">Checkout</button>
        </section>
    </main>
    <footer>
        <!-- Footer content here if needed -->
    </footer>
    <script src="script.js"></script>
</body>
</html>
