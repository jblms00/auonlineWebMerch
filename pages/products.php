<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Online Merchandise Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Products</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="cart.html">Cart</a></li>
                
            </ul>
        </nav>
    </header>
    <main>
        <section class="products">
            <article>
                <img src="prd1.jpeg" alt="CHIEFS Hoodie (blck)">
                <h3>CHIEFS Hoodie (blck)</h3>
                <p>P350.00</p>
                <button class="add-to-cart" data-name="CHIEFS Hoodie blck" data-price="350">Add to Cart</button>
            </article>
            <article>
                <img src="prd2.jpeg" alt="CHIEFS Hoodie (wht)">
                <h3>CHIEFS Hoodie (wht)</h3>
                <p>P350.00</p>
                <button class="add-to-cart" data-name="CHIEFS Hoodie wht" data-price="350">Add to Cart</button>
            </article>
            <article>
                <img src="prd3.jpg" alt="CHIEFS tote bag">
                <h3>CHIEFS tote bag</h3>
                <p>P250.00</p>
                <button class="add-to-cart" data-name="CHIEFS tote bag" data-price="250">Add to Cart</button>
            </article>
            <article>
                <img src="prd4.jpg" alt="CHIEFS TMBLR">
                <h3>CHIEFS TMBLR</h3>
                <p>P450.00</p>
                <button class="add-to-cart" data-name="CHIEFS TMBLR" data-price="450">Add to Cart</button>
            </article>
            <article>
                <img src="prd5.jpg" alt="CHIEFS T-shrt (wht)">
                <h3>CHIEFS T-shrt (wht)</h3>
                <p>P250.00</p>
                <button class="add-to-cart" data-name="CHIEFS T-shrt wht" data-price="250">Add to Cart</button>
            </article>
            <article>
                <img src="prd6.jpg" alt="CHIEFS T-shrt (blck)">
                <h3>CHIEFS T-shrt (blck)</h3>
                <p>P250.00</p>
                <button class="add-to-cart" data-name="CHIEFS T-shrt blck" data-price="250">Add to Cart</button>
            </article>
            <article>
                <img src="prd7.jpg" alt="CHIEFS TMBLR (hot)">
                <h3>CHIEFS TMBLR (hot)</h3>
                <p>P450.00</p>
                <button class="add-to-cart" data-name="CHIEFS TMBLR hot" data-price="450">Add to Cart</button>
            </article>
            <article>
                <img src="prd8.jpg" alt="CHIEFS Notebook">
                <h3>CHIEFS Notebook</h3>
                <p>P100.00</p>
                <button class="add-to-cart" data-name="CHIEFS Notebook" data-price="100">Add to Cart</button>
            </article>
            <!-- Add more products as needed -->
        </section>
        <div id="notification" class="notification">Product added to cart successfully!</div>
    </main>
    <script src="script.js"></script>
</body>
</html>
