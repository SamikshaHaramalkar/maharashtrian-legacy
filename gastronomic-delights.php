<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the order input values
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $payment = $conn->real_escape_string($_POST['payment_method']); // Changed 'payment' to 'payment_method' to match your form input

    // Insert data into the database
    $sql = "INSERT INTO `orders` (name, email, phone, address, payment_method) VALUES ('$name', '$email', '$phone', '$address', '$payment')";

    if ($conn->query($sql) === TRUE) {
        // Success message
        $responseMessage = "Order Placed Successfully!";
        echo $responseMessage;
    } else {
        // Error message
        $responseMessage = "Error: " . $sql . "<br>" . $conn->error;
        echo $responseMessage;
    }
}

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastronomic Delights</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #121212;
            color: white;
        }

        /* Navigation Bar */
        .navbar {
    background-color: #333; /* Dark background color */
    overflow: hidden;
    padding: 10px;
}

.navbar h2 {
    float: left;
    color: white; /* White text color for title */
}

.navbar a {
    float: right; /* Align links to the right */
    color: white; /* White text color for links */
    text-align: center;
    padding: 14px 16px; /* Space around links */
    text-decoration: none; /* Remove underline */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s; /* Smooth background color transition */
}

.navbar a:hover {
    background-color: #575757; /* Darker background on hover */
}

/* Optional: Specific style for Sign Up link */
#sign-up {
    margin-left: 10px; /* Space between Sign Up and previous link */
}


        /* Hero Section */
        .hero-section {
            position: relative;
            height: 100vh;
            background-image: url('assets/img/delights.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(30, 30, 30, 0.7);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        h1 {
            font-size: 8rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search-bar input {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 2rem;
            width: 500px;
            background-color: #333;
            color: white;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #ff6666;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 2rem;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #ff3333;
        }

        /* Categories Section */
        .categories-section {
            padding: 50px 0;
            background-color: #1f1f1f;
            text-align: center;
        }

        .categories-section h2 {
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .categories-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .category {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 120px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .category:hover {
            transform: scale(1.05);
        }

        .category img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .category p {
            margin-top: 10px;
            font-size: 1rem;
        }

        /* Dishes Section */
        .dishes-section {
            padding: 20px;
            text-align: center;
            background-color: #1f1f1f;
        }

        .dishes-section h3 {
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .dishes-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        .dish-card {
            background-color: #292929;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.2s;
        }

        .dish-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .dish-card img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .dish-card p {
            margin: 10px 0;
            font-size: 1.2rem;
        }

        .add-to-cart {
            padding: 10px 20px;
            background-color: #ff6666;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 1rem;
        }

        .add-to-cart:hover {
            background-color: #ff3333;
        }

        /* Cart Popup (Modal) */
        .cart-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .cart-content {
            background-color: #292929;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 400px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
        }

        .cart-content h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .cart-list {
            list-style: none;
            padding: 0;
        }

        .cart-list li {
            font-size: 1.2rem;
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .remove-from-cart {
            padding: 5px 10px;
            background-color: #ff6666;
            border: none;
            border-radius: 3px;
            color: white;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .remove-from-cart:hover {
            background-color: #ff3333;
        }

        .order-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1100;
        }

        .cart-content form {
            background-color: #292929;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        .cart-content form h4 {
            margin-bottom: 15px;
        }

        .cart-content form input[type="text"],
        .cart-content form input[type="email"],
        .cart-content form input[type="tel"],
        .cart-content form textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #333;
            color: white;
        }

        .payment-method {
            margin: 10px 0;
        }

        .payment-button {
            padding: 10px 20px;
            background-color: #ff6666;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .payment-button:hover {
            background-color: #ff3333;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
<div class="navbar">
    <h2>Maharashtrian Legacy</h2>
    <a href="#" id="view-cart" onclick="toggleCart()">Your Cart (0)</a>
    <a href="index.php">Contact</a>
    <a href="index.php">Testimonials</a>
    <a href="index.php">Services</a>
    <a href="index.php">About</a>
    <a href="index.php">Home</a>
</div>


    <!-- Hero Section -->
    <div class="hero-section">
        <div class="overlay">
            <h1>Gastronomic Delights</h1>
            <p>Explore the flavors of Maharashtra!</p>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search for dishes...">
                <button onclick="filterDishes()">Search</button>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="categories-section">
        <h2>Categories</h2>
        <div class="categories-container">
            <div class="category" onclick="showDishes('breakfast')">
                <img src="assets/img/breakfast.jpg" alt="Breakfast">
                <p>Breakfast</p>
            </div>
            <div class="category" onclick="showDishes('snacks')">
                <img src="assets/img/snacks.jpg" alt="Snacks">
                <p>Snacks</p>
            </div>
            <div class="category" onclick="showDishes('lunch')">
                <img src="assets/img/lunch.jpg" alt="Lunch">
                <p>Lunch</p>
            </div>
            <div class="category" onclick="showDishes('dinner')">
                <img src="assets/img/dinner.jpg" alt="Dinner">
                <p>Dinner</p>
            </div>
            <div class="category" onclick="showDishes('beverages')">
                <img src="assets/img/beverages.jpg" alt="Beverages">
                <p>Beverages</p>
            </div>
            <div class="category" onclick="showDishes('desserts')">
                <img src="assets/img/deserts.jpg" alt="Desserts">
                <p>Desserts</p>
            </div>
        </div>
    </div>

    <!-- Dishes Section -->
    <div class="dishes-section">
        <h3 id="dish-heading">Our Dishes</h3>
        <div id="dishes-container" class="dishes-container"></div>
    </div>

    <!-- Cart Popup -->
    <div id="cart-modal" class="cart-modal">
        <div class="cart-content">
            <button class="close-button" onclick="toggleCart()">×</button>
            <h3>Your Cart</h3>
            <ul class="cart-list" id="cart-list"></ul>
            <p>Total Price: ₹<span id="total-price">0</span></p>
            <button onclick="showOrderForm()">Proceed to Checkout</button>
        </div>
    </div>

   <!-- Order Form -->
<div id="order-form" class="order-form">
    <div class="cart-content">
        <h4>Order Details</h4>
        <form onsubmit="submitOrder(event)">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <textarea name="address" placeholder="Address" required></textarea>
            <div class="payment-method">
                <label>
                    <input type="radio" name="payment" value="credit" required> Credit Card
                </label>
                <label>
                    <input type="radio" name="payment" value="debit"> Debit Card
                </label>
                <label>
                    <input type="radio" name="payment" value="cash"> Cash on Delivery
                </label>
            </div>
            <button class="payment-button" type="submit">Place Order</button>
        </form>
    </div>
</div>    
<script>
        let cart = [];
        let totalPrice = 0;

        // Define all dishes for filtering
        const allDishes = [
            { name: "Poha", price: 60, image: "assets/img/Breakfast.jpg", category: "breakfast" },
            { name: "Dosa", price: 50, image: "assets/img/Dosa.jpg", category: "breakfast" },
            { name: "Vada Pav", price: 20, image: "assets/img/street food.jpg", category: "breakfast" },
            { name: "Thalipeeth", price: 55, image: "assets/img/Thalipeeth.jpg", category: "breakfast" },
            { name: "Upma", price: 70, image: "assets/img/Upma.jpg", category: "breakfast" },
            { name: "Misal Pav", price: 70, image: "assets/img/Misal-pav.jpg", category: "breakfast" },
            { name: "Idli", price: 60, image: "assets/img/Idli.jpg", category: "breakfast" },
            { name: "Sheera", price: 50, image: "assets/img/Sheera.jpg", category: "breakfast" },
            { name: "Kothimbir Vadi", price: 70, image: "assets/img/Kothimbir Vadi.jpg", category: "snacks" },
            { name: "Fried Idlis", price: 85, image: "assets/img/Fried Idlis.jpg", category: "snacks" },
            { name: "Dal Vada", price: 60, image: "assets/img/Dal Vada.jpg", category: "snacks" },
            { name: "Sabudana Khichdi", price: 70, image: "assets/img/Sabudana Khichdi.jpg", category: "snacks" },
            { name: "Cutlets", price: 65, image: "assets/img/Cutlets.jpg", category: "snacks" },
            { name: "Alu Vadi", price: 80, image: "assets/img/Alu Vadi.jpg", category: "snacks" },
            { name: "Kanda Bhaji", price: 55, image: "assets/img/Kanda Bhaji.jpg", category: "snacks" },
            { name: "Veg Thali", price: 150, image: "assets/img/Veg Thali.jpg", category: "lunch" },
            { name: "Poli-Bhaji", price: 90, image: "assets/img/Poli-Bhaji.jpg", category: "lunch" },
            { name: "Varan-Bhaat", price: 120, image: "assets/img/Varan-Bhaat.jpg", category: "lunch" },
            { name: "Veg Pulao", price: 100, image: "assets/img/Veg Pulao.jpg", category: "lunch" },
            { name: "Chicken Biryani", price: 200, image: "assets/img/Biryani.jpg", category: "lunch" },
            { name: "Fish Thali", price: 250, image: "assets/img/Fish Thali.jpg", category: "lunch" },
            { name: "Paneer Butter Masala", price: 250, image: "assets/img/paneer-butter-masala.jpg", category: "dinner" },
            { name: "Garlic Naan", price: 60, image: "assets/img/naan.jpg", category: "dinner" },
            { name: "Bhendi Fry", price: 90, image: "assets/img/Bhendi Fry.jpg", category: "dinner" },
            { name: "Chicken Kolhapur", price: 180, image: "assets/img/Chicken Kolhapur.jpg", category: "dinner" },
            { name: "Fish Fry", price: 150, image: "assets/img/Fish Fry.jpg", category: "dinner" },
            { name: "Prawn Masala", price: 280, image: "assets/img/Prawn Masala.jpg", category: "dinner" },
            { name: "Masala Chai", price: 20, image: "assets/img/beverages.jpg", category: "beverages" },
            { name: "Lassi", price: 30, image: "assets/img/lassi.jpg", category: "beverages" },
            { name: "Solkadhi", price: 50, image: "assets/img/Solkadhi.jpg", category: "beverages" },
            { name: "Piyush", price: 50, image: "assets/img/Piyush.jpg", category: "beverages" },
            { name: "Kairi Panha", price: 50, image: "assets/img/Kairi Panha.jpg", category: "beverages" },
            { name: "Kokum Sharbat", price: 40, image: "assets/img/Kokum Sharbat.jpg", category: "beverages" },
            { name: "Thandai", price: 40, image: "assets/img/Thandai.jpg", category: "beverages" },
            { name: "Gulab Jamun", price: 80, image: "assets/img/gulab-jamun.jpg", category: "desserts" },
            { name: "Jalebi", price: 50, image: "assets/img/jalebi.jpg", category: "desserts" },
            { name: "Puran Poli", price: 80, image: "assets/img/puran-poli.jpg", category: "desserts" },
            { name: "Shrikhand", price: 60, image: "assets/img/shrikhand.jpg", category: "desserts" },
            { name: "Modak", price: 100, image: "assets/img/modak.jpg", category: "desserts" },
            { name: "Basundi", price: 90, image: "assets/img/basundi.jpg", category: "desserts" }
        ];

        // Function to show dishes based on selected category
        function showDishes(category) {
            const dishesContainer = document.getElementById("dishes-container");
            const dishHeading = document.getElementById("dish-heading");
            dishesContainer.innerHTML = ""; // Clear previous dishes

            // Set heading based on category
            dishHeading.innerText = category.charAt(0).toUpperCase() + category.slice(1) + " Dishes";

            // Filter dishes based on selected category
            const filteredDishes = allDishes.filter(dish => dish.category === category);

            // Display filtered dishes
            filteredDishes.forEach(dish => {
                const dishCard = document.createElement("div");
                dishCard.classList.add("dish-card");
                dishCard.innerHTML = `
                    <img src="${dish.image}" alt="${dish.name}">
                    <p>${dish.name}</p>
                    <p>Price: ₹${dish.price.toFixed(2)}</p>
                    <button class="add-to-cart" onclick="addToCart('${dish.name}', ${dish.price})">Add to Cart</button>
                `;
                dishesContainer.appendChild(dishCard);
            });
        }

        // Function to add dish to cart
        function addToCart(name, price) {
            cart.push({ name, price });
            totalPrice += price;
            updateCart();
        }

        // Function to update cart display
        function updateCart() {
            const cartList = document.getElementById("cart-list");
            const totalPriceElement = document.getElementById("total-price");
            const viewCartLink = document.getElementById("view-cart");

            cartList.innerHTML = ""; // Clear previous cart items
            cart.forEach((item, index) => {
                const li = document.createElement("li");
                li.innerHTML = `${item.name} - ₹${item.price.toFixed(2)} <button class="remove-from-cart" onclick="removeFromCart(${index})">Remove</button>`;
                cartList.appendChild(li);
            });
            totalPriceElement.innerText = totalPrice.toFixed(2);
            viewCartLink.innerText = `Your Cart (${cart.length})`;
        }

        // Function to remove item from cart
        function removeFromCart(index) {
            totalPrice -= cart[index].price;
            cart.splice(index, 1);
            updateCart();
        }

        // Function to toggle cart display
        function toggleCart() {
            const cartModal = document.getElementById("cart-modal");
            cartModal.style.display = cartModal.style.display === "flex" ? "none" : "flex";
        }

        // Function to show order form
        function showOrderForm() {
            const orderForm = document.getElementById("order-form");
            orderForm.style.display = "flex";
            toggleCart(); // Hide cart when showing order form
        }

        // Function to submit order
        function submitOrder(event) {
            event.preventDefault(); // Prevent default form submission
            alert("Order placed successfully!");
            const orderForm = document.getElementById("order-form");
            orderForm.style.display = "none"; // Hide order form
            cart = []; // Clear the cart
            totalPrice = 0; // Reset total price
            updateCart(); // Update cart display
        }

        // Function to filter dishes based on search input
        function filterDishes() {
            const searchInput = document.getElementById("search-input").value.toLowerCase();
            const dishesContainer = document.getElementById("dishes-container");
            dishesContainer.innerHTML = ""; // Clear previous dishes

            const filteredDishes = allDishes.filter(dish => dish.name.toLowerCase().includes(searchInput));

            filteredDishes.forEach(dish => {
                const dishCard = document.createElement("div");
                dishCard.classList.add("dish-card");
                dishCard.innerHTML = `
                    <img src="${dish.image}" alt="${dish.name}">
                    <p>${dish.name}</p>
                    <p>Price: ₹${dish.price.toFixed(2)}</p>
                    <button class="add-to-cart" onclick="addToCart('${dish.name}', ${dish.price})">Add to Cart</button>
                `;
                dishesContainer.appendChild(dishCard);
            });
        }
    </script>
</body>

</html>