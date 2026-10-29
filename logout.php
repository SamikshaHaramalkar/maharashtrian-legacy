<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Maharashtrian Legacy</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Roboto', sans-serif;
            background: url('assets/img/Ganesh.jpg') no-repeat center center fixed; /* Background image */
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Overlay for better readability */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(34, 49, 63, 0.6); /* Dark overlay */
            z-index: 1;
        }

        /* Logout Container */
        .logout-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 50px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 450px;
            z-index: 2;
            text-align: center;
            transition: transform 0.3s;
            border: 4px solid #27ae60; /* Green border */
        }

        .logout-container::after {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            width: calc(100% - 10px);
            height: calc(100% - 10px);
            border: 2px dashed #2ecc71; /* Dashed green inner border */
            border-radius: 8px;
            pointer-events: none;
        }

        h1 {
            margin-bottom: 35px;
            color: #2c3e50;
            font-size: 28px;
        }

        /* Logout Button */
        .logout-btn {
            padding: 14px 25px;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s, transform 0.2s;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            transform: translateY(-2px);
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 3;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 30px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-btn {
            padding: 10px 20px;
            margin: 20px 10px 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .yes-btn {
            background-color: #27ae60;
            color: white;
        }

        .no-btn {
            background-color: #bdc3c7;
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="logout-container">
        <h1>Logout</h1>
        <button class="logout-btn" id="logoutBtn">Logout</button>
        <div id="message" class="message"></div>
        <a href="index.php" class="login-link" id="loginLink" style="display: none;">Go to Home Page</a>
    </div>

    <!-- The Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Logout</h2>
            <p>Are you sure you want to logout?</p>
            <button class="modal-btn yes-btn" id="confirmLogout">Yes</button>
            <button class="modal-btn no-btn" id="cancelLogout">No</button>
        </div>
    </div>

    <script>
        // Get elements
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const confirmLogout = document.getElementById('confirmLogout');
        const cancelLogout = document.getElementById('cancelLogout');
        const messageDiv = document.getElementById('message');
        const loginLink = document.getElementById('loginLink');

        // When the user clicks the logout button, open the modal 
        logoutBtn.onclick = function() {
            logoutModal.style.display = "block";
        }

        // When the user clicks on "Yes", perform logout
        confirmLogout.onclick = function() {
            // Clear admin status
            localStorage.removeItem('isAdmin');

            // Close the modal
            logoutModal.style.display = "none";

            // Display logout message
            messageDiv.textContent = 'You have been logged out successfully.';

            // Show the login link
            loginLink.style.display = 'block';

            // Redirect to login page after a short delay
            setTimeout(function() {
                window.location.href = 'loginadmin.php';
            }, 2000); // 2 seconds delay
        }

        // When the user clicks on "No", close the modal
        cancelLogout.onclick = function() {
            logoutModal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == logoutModal) {
                logoutModal.style.display = "none";
            }
        }
    </script>

</body>
</html>
