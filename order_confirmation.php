<?php
// Start the session to get order-related information
session_start();

// Optional: Unset session variables if they are not needed anymore
// This prevents displaying old order details on refresh
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    unset($_SESSION['total_price']);
    unset($_SESSION['order_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: #f7f7f7;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745;
        }
        p {
            font-size: 18px;
        }
        .order-details {
            margin-top: 20px;
            text-align: left;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Order Confirmed!</h1>
    <p>Thank you for your order.</p>
    
    <div class="order-details">
        <h3>Your Order Details:</h3>
        <p><strong>Order ID:</strong> #<?php echo isset($_SESSION['order_id']) ? $_SESSION['order_id'] : rand(1000,9999); ?></p>
        <p><strong>Total Price:</strong> $<?php echo isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 'N/A'; ?></p>
        <p><strong>Order Date:</strong> <?php echo date('Y-m-d'); ?></p>
    </div>
    
    <a href="index.php" class="button">Return to Home</a>
</div>

</body>
</html>
