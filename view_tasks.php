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

// Fetch tasks from the database (modify this query based on your task data structure)
$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

$sql = "SELECT * FROM tasks WHERE user_id = ?"; // Assuming you have a 'tasks' table
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Store the tasks in an array
$tasks = array();

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tasks</title>
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">View Tasks</h2>
            </div>
        </div>

        <!-- Task List Section -->
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tasks as $task) {
                            echo "<tr>";
                            echo "<td>{$task['task_title']}</td>";
                            echo "<td>{$task['task_description']}</td>";
                            echo "<td>{$task['task_duedate']}</td>";
                            echo "<td>{$task['task_status']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts here -->
</body>
</html>
