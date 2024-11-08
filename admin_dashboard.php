<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MJIIT RoomMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
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

        /* Navbar Styling */
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

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1100px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Dashboard Heading */
        .dashboard-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard-header h2 {
            color: #8B0000;
            font-weight: bold;
        }

        /* Stats Overview */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #8B0000;
        }

        .stat-card p {
            font-size: 1.2em;
            color: #333;
        }

        /* Booking Table */
        .table-container {
            margin-top: 30px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .table-container th {
            background-color: #8B0000;
            color: white;
        }

        .table-container tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Button Styling */
        .btn {
            background-color: #8B0000;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #5f2a1e;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-title">
            <img src="UTM-LOGO-FULL.png" alt="UTM Logo">
            <img src="Mjiit RoomMaster logo.png" alt="MJIIT Logo">
            <p>Admin Dashboard</p>
        </div>
        <div class="navbar-links">
            <a href="roommaster.html">Home</a>
            <a href="admin_booking.php">Bookings</a>
            <a href="rooms_admin.php">Rooms</a>
            <a href="#">Analytics</a>
            <a href="#">Settings</a>
        </div>
        <div class="navbar-profile">
            <i class="fa-regular fa-user"></i>
        </div>
    </div>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Welcome, Admin</h2>
            <p>Overview of room bookings and management</p>
        </div>

        <!-- Stats Overview -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>150</h3>
                <p>Total Bookings</p>
            </div>
            <div class="stat-card">
                <h3>120</h3>
                <p>Confirmed</p>
            </div>
            <div class="stat-card">
                <h3>30</h3>
                <p>Pending</p>
            </div>
        </div>

        <!-- Booking Table -->
        <div class="table-container">
            <h3>Recent Bookings</h3>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User</th>
                        <th>Room</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>101</td>
                        <td>John Doe</td>
                        <td>Room A</td>
                        <td>2024-11-15</td>
                        <td>10:00 AM - 12:00 PM</td>
                        <td>Pending</td>
                        <td><button class="btn">Approve</button> <button class="btn">Reject</button></td>
                    </tr>
                    <!-- Repeat <tr> for more rows -->
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
