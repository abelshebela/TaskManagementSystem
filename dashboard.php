<?php
// Start a session
session_start();

// Check if the user is authenticated (you may have your own authentication logic)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php"); // Redirect to your login page
    exit();
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
        .custom-small-logo {
            width: 6%;
            height: 6%;
        }
        .nav-item {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <nav class="navbar nav-item navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img class="logo custom-small-logo" src="assets/task-logo.png" alt="Task Management System Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto box m-3 ">
                <li class="nav-item d-inline">
                    <a class="nav-link" href="view_tasks.php">View Tasks</a>
                </li>
                <li class="nav-item d-inline">
                    <a class="nav-link" href="create_task.php">Create Task</a>
                </li>
                <li class="nav-item d-inline">
                    <a class="nav-link" href="update_status.php">Update Status</a>
                </li>
                <li class="nav-item d-inline">
                    <a class="nav-link" href="user_profile.php">User Profile</a>
                </li>
                <li class="nav-item d-inline">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Welcome to Your Dashboard</h2>
            </div>
        </div>
    </div>

    <!-- Your dashboard content goes here -->

    <!-- Add Bootstrap JS and jQuery scripts here -->
</body>
</html>
