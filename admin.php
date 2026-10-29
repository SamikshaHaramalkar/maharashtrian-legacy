<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file here -->
    <script src="script.js" defer></script> <!-- Add your JS file here -->
</head>
<body>
    <nav>
        <h1>Admin Panel</h1>
        <a href="#" onclick="showSection('dishes')">Manage Dishes</a>
        <a href="#" onclick="showSection('categories')">Manage Categories</a>
        <a href="#" onclick="showSection('learnMore')">Manage Learn More</a>
        <a href="logout.php">Logout</a> <!-- Add Logout option -->
    </nav>

    <div id="adminPanel">
        <!-- Manage Dishes Section -->
        <div id="dishes" class="section">
            <h2>Manage Dishes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="dishTableBody"></tbody>
            </table>
        </div>

         <!-- Manage Categories Section -->
         <div id="categories" class="section" style="display: none;">
            <h2>Manage Categories</h2>
            <table>
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="categoryTableBody"></tbody>
            </table>
            <button onclick="addCategory()">Add Category</button>
        </div>

        <!-- Manage Learn More Section -->
        <div id="learnMore" class="section" style="display: none;">
            <h2>Manage Learn More</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="learnMoreTableBody"></tbody>
            </table>
            <button onclick="addLearnMore()">Add Learn More Item</button>
        </div>
    </div>

    <script>
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

        const categories = ["Breakfast", "Snacks", "Lunch", "Dinner", "Beverages", "Desserts"];

        const learnMoreItems = [
            { title: "Art and Craft Heritage", image: "assets/img/art_craft.jpg" },
            { title: "Festivals and Celebrations", image: "assets/img/festivals.jpg" },
            { title: "Music and Dance", image: "assets/img/music_dance.jpg" },
            { title: "Historical and Cultural Sites", image: "assets/img/historical_sites.jpg" },
            { title: "Literature and Language", image: "assets/img/literature.jpg" },
            { title: "Maharashtrian Attires", image: "assets/img/attires.jpg" }
        ];
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.display = 'none'; // Hide all sections
            });
            document.getElementById(sectionId).style.display = 'block'; // Show selected section
        }

        // Function to display all dishes in the management section
        function displayDishes() {
            const dishTable = document.getElementById("dishTableBody");
            dishTable.innerHTML = ""; // Clear existing rows

            allDishes.forEach(dish => {
                const row = `
                    <tr>
                        <td>${dish.name}</td>
                        <td>${dish.price}</td>
                        <td><img src="${dish.image}" alt="${dish.name}" style="width: 50px;"></td>
                        <td>${dish.category}</td>
                        <td>
                            <button onclick="editDish('${dish.name}')">Edit</button>
                            <button onclick="deleteDish('${dish.name}')">Delete</button>
                        </td>
                    </tr>
                `;
                dishTable.innerHTML += row; // Add new row to table
            });
        }

        // Function to display categories
        function displayCategories() {
            const categoryTable = document.getElementById("categoryTableBody");
            categoryTable.innerHTML = "";
            categories.forEach(category => {
                const row = `
                    <tr>
                        <td>${category}</td>
                        <td>
                            <button onclick="editCategory('${category}')">Edit</button>
                            <button onclick="deleteCategory('${category}')">Delete</button>
                        </td>
                    </tr>
                `;
                categoryTable.innerHTML += row;
            });
        }

        // Function to display Learn More items
        function displayLearnMoreItems() {
            const learnMoreTable = document.getElementById("learnMoreTableBody");
            learnMoreTable.innerHTML = "";
            learnMoreItems.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.title}</td>
                        <td><img src="${item.image}" alt="${item.title}" style="width: 50px;"></td>
                        <td>
                            <button onclick="editLearnMore('${item.title}')">Edit</button>
                            <button onclick="deleteLearnMore('${item.title}')">Delete</button>
                        </td>
                    </tr>
                `;
                learnMoreTable.innerHTML += row;
            });
        }

        // Call the display functions to show all sections initially
        displayDishes();
        displayCategories();
        displayLearnMoreItems();
    </script>
</body>
</html>
