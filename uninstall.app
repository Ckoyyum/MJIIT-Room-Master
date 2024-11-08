<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MJIIT RoomMaster</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>MJIIT RoomMaster Admin</h1>
        </div>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="add_room.php">Add Room</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Admin Dashboard</h2>
        <div class="room-list">
            <?php
            include 'db.php';  // Ensure db.php has the correct database connection setup

            $sql = "SELECT * FROM rooms";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='room-card'>";
                    echo "<h3>" . $row["room_name"] . "</h3>";
                    echo "<p>Capacity: " . $row["capacity"] . "</p>";
                    echo "<p>Equipment: " . $row["equipment"] . "</p>";
                    echo "<p>Status: " . $row["status"] . "</p>";
                    echo "<button onclick=\"updateRoomStatus('" . $row["room_id"] . "')\">Update Status</button>";
                    echo "</div>";
                }
            } else {
                echo "No rooms found.";
            }
            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 MJIIT RoomMaster</p>
    </footer>

    <script src="script.js"></script>
    <script>
        function updateRoomStatus(roomId) {
            const url = 'update_room_status.php?room_id=' + roomId;
            window.location.href = url;
        }
    </script>
</body>
</html>
