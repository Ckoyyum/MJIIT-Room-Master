<?php
session_start(); // Start the session
include 'config.php'; // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to cancel bookings.";
    exit;
}

// Check if a booking ID is provided
if (isset($_GET['id'])) {
    $booking_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Update the booking status to "Cancelled"
    $sql = "UPDATE bookings SET status = 'Cancelled' WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $booking_id, $user_id);

    if ($stmt->execute()) {
        // Redirect back to my_bookings.php with a success message
        header("Location: my_bookings.php?message=Booking cancelled successfully");
        exit;
    } else {
        echo "Error cancelling booking: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
