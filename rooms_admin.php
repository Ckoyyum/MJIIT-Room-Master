<?php
// Include database configuration file
include 'config.php';

// Fetch all rooms from the database
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Booking Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
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
        .navbar-links a {
            color: rgb(119, 4, 4);
            text-decoration: none;
            margin-right: 20px;
            font-size: 14px;
        }
        .navbar-links a:hover {
            color: #ddd;
        }
        .container {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #d3d3d3; /* Light grey */
            color: #000; /* Black text */
        }
        .btn-success {
            border: none;
            border-radius: 4px;
        }

        .btn-primary, .btn-danger, .btn-secondary {
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            width: 80px; /* Ensuring uniform width */
            display: inline-block;
            text-align: center;
        }
        .btn-primary {
            background-color: #FFC107; /* Yellowish color */
            color: #000;
        }
        .btn-primary:hover {
            background-color: #FFA000; /* Darker yellow */
        }
        .btn-danger {
            background-color: #DC3545; /* Red color */
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #C82333; /* Darker red */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #8B0000;
        }
        .no-requests {
            text-align: center;
            color: #333;
            font-size: 1.2em;
            margin: 20px 0;
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
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="header">
            <h2>Rooms</h2>
            <a href="add_room.php" class="btn btn-success">Add New Room</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Room Name</th>
                    <th>Capacity</th>
                    <th>Equipment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['room_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['capacity']); ?></td>
                        <td><?php echo htmlspecialchars($row['equipment']); ?></td>
                        <td>
                            <a href="update_room.php?id=<?php echo $row['room_id']; ?>" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-room-id="<?php echo $row['room_id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this room?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Attach room ID to the delete button in the modal
        document.querySelectorAll('[data-bs-target="#confirmDeleteModal"]').forEach(button => {
            button.addEventListener('click', function() {
                const roomId = this.getAttribute('data-room-id');
                document.getElementById('confirmDeleteBtn').setAttribute('href', `delete_room.php?id=${roomId}`);
            });
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>
