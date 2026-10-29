<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "my_db");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $mysqli->real_escape_string($_POST['email']);

    // Check if the email already exists
    $checkEmailSql = "SELECT * FROM users WHERE email = '$email'";
    $result = $mysqli->query($checkEmailSql);

    if ($result->num_rows > 0) {
        $errorMessage = "This email address is already registered. Please use a different email.";
    } else {
        // Insert user into database
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($mysqli->query($sql)) {
            header("Location: login.php");
            exit();
        } else {
            $errorMessage = "Error: " . $mysqli->error;
        }
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .container {
        width: 30%;
        margin-top: 100px;
        background-color: #1b1e21;
        padding: 35px;
        border-radius: 20px;
    }

h2 {
    text-align: center;
    color: #fff;
}

button.btn.btn-primary {
    width: 100%;
    margin: 20px 0px !important;
}
body {
    background: #343a40;
    background: url('assets/img/navratri.jpg') no-repeat center center fixed;
}

label {
    color: #fff;
}
</style>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
