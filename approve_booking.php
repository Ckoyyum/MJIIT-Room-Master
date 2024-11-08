<?php
include 'config.php';

$booking_id = $_GET['id'];
$sql = "UPDATE bookings SET status = 'Approved' WHERE booking_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);

if ($stmt->execute()) {
    header("Location: bookings_admin.php?message=Booking approved successfully");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
