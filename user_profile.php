<?php
// Start a session
session_start();

// Check if the user is authenticated (you may have your own authentication logic)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php"); // Redirect to your login page
    exit();
}

// Include the database connection file (e.g., db.php)
include('db.php');

// Retrieve user profile information based on the user ID
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $username = htmlspecialchars($row['user_username']);
    $email = htmlspecialchars($row['user_email']);
    $phoneno = htmlspecialchars($row['user_phoneno']);
    // Add other user profile information as needed
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here, if needed */
        .nav-link {
            cursor: pointer;
        }
        .logo {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img class="logo" src="your-logo.png" alt="Task Management System Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="view_tasks.php">View Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_task.php">Create Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="update_status.php">Update Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_profile.php">User Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>


<!-- Main Content -->
<div class="container mt-5">
    <h1>User Profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Username: <?php echo $username; ?></h5>
            <p class="card-text">Email: <?php echo $email; ?></p>
            <p class="card-text">Phone number: <?php echo $phoneno; ?></p>
            <!-- Display other user profile information here -->
        </div>
    </div>
</div>

</body>
</html>
