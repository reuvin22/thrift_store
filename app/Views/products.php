<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            background-image: url('/assets/bg.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .navbar {
            background-color: #774601;
        }

        .navbar-brand, .nav-link {
            color: white;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #ffcc66;
        }

        .cart-icon {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative;
            color: white;
        }

        .cart-icon i {
            margin-right: 8px;
        }

        .cart-count {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 0.8rem;
            position: absolute;
            top: -5px;
            right: -10px;
        }

        .cart {
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #774601;
        }

        .product-card {
            border: 1px solid #774601;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .product-card img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .product-card h2 {
            font-size: 1.5rem;
        }

        .modal .modal-content {
            border-radius: 10px;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 3%;
        }

        .form-container .product-form {
            width: 100%;
            margin-bottom: 15px;
        }

        .back-btn-container {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .back-btn-container button {
            background-color: #774601;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .back-btn-container button:hover {
            background-color: #5c3f01;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="ms-auto" style="margin-right: 10%;">
                <div class="cart-icon d-flex align-items-center" onclick="openCartModal()">
                    <img src="/assets/cart.png" alt="Cart Icon" style="width: 50px; height: 50px;" class="z-50 absolute">
                    <i class="fas fa-shopping-cart fa-2x me-2"></i>
                    <span class="cart-count" id="cart-count">0</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="cart mb-4">
            <h2>Your Cart</h2>
            <p id="cart-total">Total: $0.00</p>
        </div>

        <h1 class="mb-4">Products</h1>
        <div class="search-bar mb-4">
            <input type="text" id="search-input" class="form-control" placeholder="Search for products..." oninput="searchProducts()">
        </div>
        <div class="row" id="product-list">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $index => $row): ?>
                    <div class="col-md-3">
                        <div class="product-card">
                            <img src="<?= base_url($row['image_url']); ?>" alt="<?= esc($row['items_name']); ?>" class="img-fluid mb-3">
                            <h2 class="text-center"><?= esc($row['items_name']); ?></h2>
                            <p>Price: $<?= esc($row['price']); ?></p>
                            <p>Description: <?= esc($row['description']); ?></p>
                            <?php if ($row['stock'] > 0): ?>
                                <button class="btn btn-primary" onclick="addToCart(<?= esc($row['id']); ?>)">Add to Cart</button>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>Sold Out</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <td colspan="12" class="has-text-centered">No items found</td>
            <?php endif; ?>
        </div>

        <div class="back-btn-container">
            <a href="<?= base_url('/') ?>"><button class="back-button">Back</button></a>
        </div>
    </div>

    <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cart-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <h2>Your Cart</h2>
                <ul id="modal-cart-items" class="list-group mb-3"></ul>
                <button class="btn btn-primary" onclick="openReviewOrderModal()">Review Order</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="review-order-modal" tabindex="-1" aria-labelledby="review-order-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <h2>Review Order</h2>
                <ul id="review-cart-items" class="list-group mb-3"></ul>
                <p id="review-cart-total" class="mb-4">Total: $0.00</p>
                <button class="btn btn-success" onclick="submitOrder()">Confirm Order</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let cart = [];
        console.log(cart)
        function addToCart(productId) {
            const productElement = document.querySelector(`.product-card button[onclick="addToCart(${productId})"]`).parentElement;
            const productName = productElement.querySelector('h2').textContent;
            const productPrice = parseFloat(productElement.querySelector('p').textContent.replace('Price: $', ''));
            const productImage = productElement.querySelector('img').src;

            const product = { id: productId, name: productName, price: productPrice, image: productImage, qty: 1 };
            const cartItem = cart.find(item => item.id === productId);

            if (cartItem) {
                cartItem.qty += 1;
            } else {
                cart.push(product);
            }

            updateCart();
        }

        function updateCart() {
            const modalCartItems = document.getElementById('modal-cart-items');
            const cartTotal = document.getElementById('cart-total');
            const cartCount = document.getElementById('cart-count');

            let total = 0;
            modalCartItems.innerHTML = '';

            cart.forEach(item => {
                total += item.price * item.qty;

                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.innerHTML = `${item.name} - $${item.price} x ${item.qty}`;
                modalCartItems.appendChild(listItem);
            });

            cartCount.innerText = cart.reduce((sum, item) => sum + item.qty, 0);
            cartTotal.innerText = `Total: $${total.toFixed(2)}`;
            const reviewCartTotal = document.getElementById('review-cart-total');
            if (reviewCartTotal) {
                reviewCartTotal.innerText = `Total: $${total.toFixed(2)}`;
            }
        }


        // Function to open and close modals
        function openCartModal() {
            const cartModal = new bootstrap.Modal(document.getElementById('cart-modal'));
            cartModal.show();
        }

        function closeCartModal() {
            const cartModal = bootstrap.Modal.getInstance(document.getElementById('cart-modal'));
            if (cartModal) cartModal.hide();
        }

        function closeReviewOrderModal() {
            const reviewModal = bootstrap.Modal.getInstance(document.getElementById('review-order-modal'));
            if (reviewModal) reviewModal.hide();
        }
        function openReviewOrderModal() {
            const modalCartItems = document.getElementById('review-cart-items');
            modalCartItems.innerHTML = '';

            cart.forEach(item => {
                const modalItem = document.createElement('li');
                modalItem.className = 'list-group-item d-flex justify-content-between';
                modalItem.innerHTML = `${item.name} - $${item.price} x ${item.qty}`;
                modalCartItems.appendChild(modalItem);
            });

            const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
            document.getElementById('review-cart-total').innerText = `Total: $${total.toFixed(2)}`;

            new bootstrap.Modal(document.getElementById('review-order-modal')).show();
        }

        function closeReviewOrderModal() {
            cart = [];
            updateCart();
            const cartModal = bootstrap.Modal.getInstance(document.getElementById('cart-modal'));
            cartModal.hide();
        }

        const loggedInUser = <?= json_encode([
            'id' => $_SESSION['employee_id'] ?? null,
            'name' => $_SESSION['employee_name'] ?? null,
        ]); ?>;
        function submitOrder() {
            const cartItems = cart.map(item => ({
                buyer_id: loggedInUser.id,
                product_id: item.id,
                name: loggedInUser.name,
                price: item.price,
                items_name: item.name,
                qty: item.qty
            }));

            fetch('http://localhost:8080/user-items/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(cartItems),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert('Thank you for your order! Your order has been successfully placed.');
                cart = [];
                updateCart();
                closeReviewOrderModal();
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
