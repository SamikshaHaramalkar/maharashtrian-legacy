<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "my_db");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Initialize error message and success message
$errorMessage = '';
$successMessage = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Update the user's password
        $sql = "UPDATE users SET password='$newPassword' WHERE email='$email'";
        if ($mysqli->query($sql)) {
            $successMessage = "Your password reset successfully.";
        } else {
            $errorMessage = "Error updating password!";
        }
    } else {
        $errorMessage = "Email not found!";
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background-color: #343a40;
            }
            .reset-password-container {
                max-width: 400px;
                margin: 100px auto;
                padding: 30px;
                background-color: #1b1e21;
                border-radius: 10px;
                box-shadow: 0 0 10px rgb(0 0 0 / 86%);
            }
            label, p {
                color: #fff;
            }
            h2.text-center {
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="reset-password-container">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
            </form>
            
            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success mt-3">
                    <?php echo $successMessage; ?>
                    <br>
                    <a href="login.php" class="btn btn-primary mt-2">Login Now</a>
                </div>
            <?php endif; ?>

            <!-- <p class="mt-3">Remembered your password? <a href="login.php">Login here</a></p> -->
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>