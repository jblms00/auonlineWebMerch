<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Login - Online Merchandise Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Buyer Login</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="cart.html">Cart</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="admin-login.html">Admin Login</a></li>
                <li><a href="buyer-login.html">Buyer Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form id="buyer-login-form">
            <h2>Login as Buyer</h2>
            <label for="buyer-username">Username:</label>
            <input type="text" id="buyer-username" required>
            <label for="buyer-password">Password:</label>
            <input type="password" id="buyer-password" required>
            <button type="submit">Login</button>
        </form>
        <div id="buyer-login-message"></div>
    </main>
    <script src="script.js"></script>
</body>
</html>
