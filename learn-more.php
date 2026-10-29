<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maharashtrian Legacy</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (For Scroll Indicator Icon) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Hero Section */
        .hero-section {
            background-image: url('assets/img/explore.jpg'); 
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 2s ease-out;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            animation: slideIn 2s ease-in-out;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 30px;
            animation: fadeIn 2.5s ease-out;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 20px;
            z-index: 2;
            font-size: 2rem;
            color: #fff;
            animation: bounce 2s infinite;
            cursor: pointer;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body class="bg-dark text-light">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Maharashtrian Legacy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#index.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Testimonials</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Contact</a></li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                            data-bs-target="login.php">Login</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="hero-content text-center">
            <h1 class="hero-title">Experience the Richness of Maharashtra</h1>
            <p class="hero-subtitle">Dive into the culture, traditions, and heritage that make Maharashtra unique.</p>
        </div>
        <div class="scroll-indicator text-center" onclick="window.scrollTo(0, document.getElementById('learnMore').offsetTop)">
            <i class="fas fa-chevron-down"></i>
        </div>
    </header>

<!-- Learn More Section -->
<section id="learnMore" class="container my-5 text-white">
    <div class="row text-center">
        <!-- Art and Craft Heritage -->
        <div class="col-md-4 mb-4">
            <a href="art-craft.php" class="text-decoration-none">
                <div class="learn-more-card">
                    <img src="assets/img/Globalisation-and-art-1000x600.webp" class="img-fluid rounded" alt="Art and Craft Heritage">
                    <div class="card-body">
                        <h4 class="learn-more-title">Art and Craft Heritage</h4>
                        <p class="learn-more-description">Maharashtra boasts a vibrant heritage of traditional art forms, crafts, and designs. The intricate woodwork, weaving techniques, pottery, and Warli art reflect the cultural richness of the region. Discover the timeless artistry passed down through generations.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Festivals and Celebrations -->
        <div class="col-md-4 mb-4">
            <a href="festivals.php" class="text-decoration-none">
                <div class="learn-more-card">
                    <img src="assets/img/maxresdefault.jpg" class="img-fluid rounded" alt="Festivals and Celebrations">
                    <div class="card-body">
                        <h4 class="learn-more-title">Festivals and Celebrations</h4>
                        <p class="learn-more-description">Maharashtra is home to vibrant festivals like Ganesh Chaturthi, Diwali, Makar Sankranti, and Gudi Padwa. The celebrations are filled with fervor, music, dance, and traditional rituals that bring people together to honor their cultural heritage.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Music and Dance -->
        <div class="col-md-4 mb-4">
            <a href="music-dance.html" class="text-decoration-none">
                <div class="learn-more-card">
                    <img src="assets/img/Lavani.jpg" class="img-fluid rounded" alt="Music and Dance">
                    <div class="card-body">
                        <h4 class="learn-more-title">Music and Dance</h4>
                        <p class="learn-more-description">Maharashtra has a deep musical and dance tradition, with performances like Lavani, Tamasha, and Bharatnatyam showcasing the state's rich folk and classical heritage. Learn about the various styles of dance and music that define Maharashtra's cultural identity.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Historical and Cultural Sites -->
        <div class="col-md-4 mb-4">
            <a href="historical-sites.html" class="text-decoration-none">
                <div class="learn-more-card">
                    <img src="assets/img/heritage-sites-in-maharashtra.jpg" class="img-fluid rounded" alt="Historical and Cultural Sites">
                    <div class="card-body">
                        <h4 class="learn-more-title">Historical and Cultural Sites</h4>
                        <p class="learn-more-description">From ancient forts like Raigad and Sinhagad to magnificent temples and historical monuments, Maharashtra is rich in cultural landmarks. Explore the diverse architectural marvels and historical sites that tell the story of the state's glorious past.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Literature and Language -->
        <div class="col-md-4 mb-4">
            <a href="literature-language.html" class="text-decoration-none">
                <div class="learn-more-card">
                    <img src="assets/img/images.jpeg" class="img-fluid rounded" alt="Literature and Language">
                    <div class="card-body">
                        <h4 class="learn-more-title">Literature and Language</h4>
                        <p class="learn-more-description">Marathi literature has a rich history, with notable works in poetry, drama, and storytelling. Learn about the evolution of the Marathi language, from its classical roots to contemporary writers and poets who have shaped the literary world.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Maharashtrian Attires -->
        <div class="col-md-4 mb-4">
            <a href="attires.html" class="text-decoration-none">
                <div class="learn-more-card">
                    <img src="assets/img/IMG-20160309-WA0008.jpg" class="img-fluid rounded" alt="Maharashtrian Attires">
                    <div class="card-body">
                        <h4 class="learn-more-title">Maharashtrian Attires</h4>
                        <p class="learn-more-description">Maharashtra's traditional attire is a reflection of its cultural diversity. From the Nauvari saree to the Kolhapuri chappals, the clothes worn in Maharashtra showcase a blend of history, regional pride, and style that is both elegant and practical.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Custom Styles for Dark Theme "Learn More" Section -->
<style>
    /* Dark Theme Card Styling */
    #learnMore {
        background-color: #121212; /* Dark background for entire section */
    }

    .learn-more-card {
        background-color: #1E1E1E; /* Darker background for the cards */
        border: 1px solid #0000;  /* Darker border for contrast */
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.8);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Image Styling */
    .learn-more-card img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    /* Card Body Styling */
    .card-body {
        background-color: #0000;  /* Dark background for the text area */
        padding: 20px;
        text-align: center;
        color: #0000;  /* Light text color for readability */
    }

    /* Title Styling */
    .learn-more-title {
        font-size: 1.4em;
        color: #FF5722; /* Bright color for titles to stand out */
        margin-bottom: 15px;
    }

    /* Description Styling */
    .learn-more-description {
        font-size: 1em;
        color: #bbbb;  /* Lighter color for descriptions */
    }

    /* Hover Effect for Cards */
    .learn-more-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.7);
    }

    /* Hover Effect on Image */
    .learn-more-card img:hover {
        transform: scale(1.1);
    }
</style>




    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-3">
        <p>&copy; 2024 Maharashtrian Legacy. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
