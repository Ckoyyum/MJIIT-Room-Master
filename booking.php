<?php
session_start();
include 'config.php'; // Include your database configuration file

// Check if user is logged in (assuming user_id is stored in the session upon login)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Get the logged-in user ID
    $room_id = $_POST['room_id']; // This should be passed from the form
    $booking_date = $_POST['booking_date'];
    $start_time = $_POST['checkin_time'];
    $end_time = $_POST['checkout_time'];

    // Insert the booking request into the database
    $sql = "INSERT INTO bookings (user_id, room_id, booking_date, start_time, end_time, status) VALUES (?, ?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $user_id, $room_id, $booking_date, $start_time, $end_time);

    if ($stmt->execute()) {
        // Redirect to confirmation page or show success message
        header("Location: booking_confirmation.php?status=success");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
