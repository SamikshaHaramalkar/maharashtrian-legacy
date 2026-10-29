<?php
session_start(); //start the session at the top

    $mysqli = new mysqli("localhost","root","","my_db");

    // Check connection
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if logout is requested
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to home page after logout
    exit();
}

// Fetch user information if logged in
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Insert data into database
    $sql = "INSERT INTO `form` (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($mysqli->query($sql) === TRUE) {
        // Set success to true and define the success message
        $success = true;
        $responseMessage = "Form submitted successfully!";
    } else {
        // Set error message
        $responseMessage = "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Retrieve user data from database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // Store user information in session
            header("Location: index.php"); // Redirect to a dashboard or home page
            exit();
        } else {
            $errorMessage = "Invalid password!";
        }
    } else {
        $errorMessage = "User not found!";
    }
}

$conn->close();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Maharashtrian Legacy</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/styles.css">
        <style>
             body {
            background-color: #343a40; /* Dark background */
            color: #ffffff; /* Light text color */
        }
        .profile-container {
            background-color: #343434; /* Slightly lighter dark for profile area */
            border-radius: 8px;
            text-align: center;
        }
            .testimonials-slider {
                max-height: 300px;
                overflow-y: hidden;
            }
            .submit-testimonial-card {
                background-color: #f8f9fa; /* Light background for contrast */
                border: 1px dashed #007bff; /* Dashed border for emphasis */
            }
            .star-rating input {
                display: none; /* Hide radio buttons */
            }
            .star-rating label {
                font-size: 2rem; /* Increase size of stars */
                color: lightgray; /* Default color */
                cursor: pointer;
            }
            .star-rating input:checked ~ label {
                color: gold; /* Color when checked */
            }
            .log-in{
                color:#fff;
            }
            .form-label {
                margin-bottom: .5rem;
                color: #fff;
            }
            a.text-dark {
                color: #0d6efd !important;
            }
  
        </style>
        
    </head>
    <body class="bg-dark text-light">
        <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Maharashtrian Legacy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="loginadmin.php">
                            <button type="button" class="btn btn-secondary">Admin</button>
                        </a>
                    </li>
                    <?php if ($username): ?>
                        <li class="nav-item">
                            <a href="userlogout.php?logout=true" class="nav-link">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if ($username): ?>
            <div class="profile-container">
                <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
                <!-- Add more user profile details here -->
            </div>
        <?php else: ?>
            <div class="profile-container">
            </div>
        <?php endif; ?>
    </div>

        <!-- Hero Section -->
        <section id="home" class="hero text-center text-light d-flex align-items-center justify-content-center">
            <div class="hero-content">
                <h1 class="display-4">Celebrate the Spirit<br>of Maharashtra</h1>
                <p>A Journey through Tradition, Culture, and Festivals. From the grandeur of<br> Ganesh Chaturthi to the folk dances of Lavani, embark on a journey that celebrates <br>the essence of Maharashtra’s history and culture.</p>
                <a href="learn-more.php" class="btn btn-primary btn-lg mt-3">Learn More</a>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="container my-5">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="display-4">About Maharashtrian Legacy</h2>
                    <hr class="mb-4 about-hr">
                    <p>Maharashtrian Legacy is dedicated to celebrating and preserving the vibrant culture and traditions of Maharashtra. Our mission is to share the rich history, festivals, cuisine, art, and music of this beautiful state with the world. Our team is passionate about showcasing the essence of Maharashtrian heritage and its significance. Join us on this journey to explore and cherish the legacy of Maharashtra.</p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <img src="assets/img/culture.jpg" alt="Night Sky" class="img-fluid rounded" style="500">
                        </div>
                        <div class="col-md-6 mb-12=">
                            <img src="assets/img/hs.jpg" alt="Maharashtrian Goddess" class="img-fluid rounded" Style="500">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Durga Section (New Section after About) -->
        <section id="durga" class="durga-section text-center text-light d-flex align-items-center justify-content-center">
            <div class="durga-content">
                <h2 class="display-4">Step into Tradition</h2>
                <p>Join us in a journey through tradition, where each celebration captures <br> the beauty of our shared history and the joy of togetherness."</p>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="container my-5">
            <h2 class="text-center mb-4">SERVICES</h2>
            <hr class="mx-auto mb-5 services-hr">
            <div class="row text-center justify-content-center">
                <div class="col-md-4">
                    <div class="service-box p-4 rounded shadow-lg">
                        <img src="assets/img/gastronomic delights.avif" class="rounded-circle mb-3" alt="Gastronomic Delights" style="width: 150px; height: 150px;">
                        <h4><a href="gastronomic-delights.html" class="text-light text-decoration-none">Gastronomic Delights</a></h4>
                        <p class="text-white-50">Dive into the authentic Maharashtrian cuisine with recipes, cooking tips, and video tutorials.</p>
                        <a href="gastronomic-delights.php" class="btn btn-warning mt-2">Explore Now</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials-section container my-5">
            <h2 class="text-center mb-4">TESTIMONIALS</h2>
            <div class="testimonials-container d-flex overflow-auto">
                <!-- Testimonial Cards -->
                <div class="testimonial-card mx-1">
                    <img src="assets/img/aditi.jpg" alt="Aditi Joshi" class="rounded-circle mb-3">
                    <h3>Aditi Joshi</h3>
                    <p>Traditional Maharashtrian dancer</p>
                    <p>Maharashtrian Legacy has truly opened my eyes to the depth of our state's culture. The information is wonderfully presented.</p>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                </div>
                <div class="testimonial-card mx-3 highlighted">
                    <img src="assets/img/rohit.jpg" alt="Rohit Patil" class="rounded-circle mb-3">
                    <h3>Rohit Patil</h3>
                    <p>Culinary enthusiast</p>
                    <p>I love cooking, and the recipes here are so authentic and easy to follow. My family is enjoying true Maharashtrian flavors!</p>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                </div>
                <div class="testimonial-card mx-3">
                    <img src="assets/img/sanjana.jpg" alt="Sanjana Deshmukh" class="rounded-circle mb-3">
                    <h3>Sanjana Deshmukh</h3>
                    <p>Cultural history student</p>
                    <p>The website's content on festivals has given me a new appreciation for our traditions. It's insightful and beautifully crafted.</p>
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                </div>
                </div>
        
        </section>
                                                                                                              
        <!-- Contact Us Section -->
        <section id="contact" class="container my-5">
            <h2 class="display-4 text-center mb-4">Contact Us</h2>
            <hr class="mx-auto mb-5 contact-hr">
            <div class="row">
                <div class="col-md-6">
                    <p>Feel free to reach out to us for any inquiries or to book our services.<br> We're here to help you experience the best of Maharashtra.</p>
                    <ul class="list-unstyled">
                        <h5>Address:</h5>
                        <li><i class="bi bi-geo-alt-fill text-warning"></i> Sawantwadi Sindhudurg, Maharashtra</li>
                        <h5>Phone:</h5>
                        <a href="tel:+91-1234567890"><li><i class="bi bi-telephone-fill text-warning"></i> +91-8275708534</li></a>
                        <h5>Email:</h5>
                        <a href="www.maharashtrianlegacy.com"><li><i class="bi bi-envelope-fill text-warning"></i>www.maharashtrianlegacy.com</li></a>
                    </ul>
                </div>
                <div class="col-md-6">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
                    </form>
                   <!-- Display response message below the form -->
                <?php if (!empty($responseMessage)): ?>
                    <div id="responseMessage" class="mt-3 alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>">
                        <?php echo $responseMessage; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

     <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <?php if (!empty($errorMessage)): ?>
                                <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
                            <?php endif; ?>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                            <div class="mt-3">
                                <p class="text-center sign-up">Don't have an account? <a href="register.php" class="text-dark">Register Now</a></p>
                                <p class="mt-3 text-white text-center"><a href="reset_password.php" style="cursor: pointer;">Reset Password?</a></p>
                            </div>
                        </form>
                        <p class="mt-3 text-white"><a href="reset_password.php" style="cursor: pointer;">Reset Password?</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
    <footer class="footer">
            <div class="container">
                <p class="mb-0">© 2024 Maharashtrian Legacy. All rights reserved.</p>
            </div>
        </footer>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function validateLoginForm(event) {
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;

                if (!username || !password) {
                    event.preventDefault(); // Prevent form submission
                    alert('Please fill out both fields.');
                }
            }
        </script>
    </body>
    </html>
    