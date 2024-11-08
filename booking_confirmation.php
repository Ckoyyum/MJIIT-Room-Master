<?php
// Check if the status query parameter is set
$status = isset($_GET['status']) ? $_GET['status'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .confirmation-message {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h4 {
            color: #8B0000;
        }

        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .modal-buttons a {
            padding: 10px 20px;
            background-color: #8B0000;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
        }

        .modal-buttons a:hover {
            background-color: #5f2a1e;
        }
    </style>
</head>
<body>
    <div class="confirmation-message">
        <?php if ($status === 'success'): ?>
            <h4>Booking Request Submitted!</h4>
            <p>Your booking request has been sent successfully. Please wait for approval.</p>
            <div class="modal-buttons">
                <a href="my_bookings.php">Go to My Bookings</a>
                <a href="home.html">Home</a>
            </div>
        <?php else: ?>
            <h4>Booking Failed</h4>
            <p>There was an issue with your booking request. Please try again.</p>
            <a href="booking.html">Try Again</a>
        <?php endif; ?>
    </div>
</body>
</html>
