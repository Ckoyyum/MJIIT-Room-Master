<?php
include 'config.php';

// Get the room ID from the URL
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Fetch current room data
    $sql = "SELECT * FROM rooms WHERE room_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "Room not found.";
        exit;
    }
} else {
    header("Location: rooms_admin.php");
    exit;
}

// Handle form submission for updating the room
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_name = $_POST['room_name'];
    $capacity = $_POST['capacity'];
    $equipment = $_POST['equipment'];

    // Image upload logic
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $sql = "UPDATE rooms SET room_name = ?, capacity = ?, equipment = ?, image = ? WHERE room_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sissi", $room_name, $capacity, $equipment, $image, $room_id);
        } else {
            echo "Failed to upload image.";
            exit;
        }
    } else {
        $sql = "UPDATE rooms SET room_name = ?, capacity = ?, equipment = ? WHERE room_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $room_name, $capacity, $equipment, $room_id);
    }

    if ($stmt->execute()) {
        header("Location: rooms_admin.php?message=Room updated successfully");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Body styling */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('bg website.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

        .navbar {
            display: flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.9);
            color: rgb(114, 4, 4);
            padding: 8px 20px;
            justify-content: space-between;
            width: 100%;
            border-bottom: 2px solid #8B0000;
            z-index: 10;
        }

        .navbar-title {
            display: flex;
            align-items: center;
        }

        .navbar-title img {
            max-height: 30px;
            margin-right: 10px;
        }

        .navbar-title p {
            font-weight: bold;
            font-size: 20px;
            margin: 0;
        }

        .navbar-links {
            display: flex;
            align-items: center;
        }

        .navbar-links a {
            color: rgb(119, 4, 4);
            text-decoration: none;
            margin-right: 20px;
            font-size: 14px;
        }

        .navbar-links a:hover {
            color: #ddd;
        }

        .navbar-profile i {
            font-size: 24px;
        }

        .container {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h3 {
            color: black;
        }

        hr {
            border-top: 2px solid black;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-back {
            background-color: #8B0000;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .btn-back:hover {
            background-color: #B22222;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-title">
            <img src="UTM-LOGO-FULL.png" alt="UTM Logo">
            <img src="Mjiit RoomMaster logo.png" alt="MJIIT Logo">
            <p>BookingSpace - Admin</p>
        </div>
        <div class="navbar-links">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="rooms_admin.php">Rooms</a>
            <a href="bookings_admin.php">Bookings</a>
            <a href="analytics.php">Analytics</a>
            <a href="reports.php">Reports</a>
        </div>
        <div class="navbar-profile">
            <i class="fa-regular fa-user"></i>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <h3>Update Room</h3>
        <hr>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="room_name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo htmlspecialchars($room['room_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo htmlspecialchars($room['capacity']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="equipment" class="form-label">Equipment</label>
                <input type="text" class="form-control" id="equipment" name="equipment" value="<?php echo htmlspecialchars($room['equipment']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Room Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <p class="mt-2">Current image: <?php echo htmlspecialchars($room['image']); ?></p>
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-success">Update Room</button>
                <a href="rooms_admin.php" class="btn btn-back">Back to Rooms</a>
            </div>
        </form>
    </div>
</body>
</html>
