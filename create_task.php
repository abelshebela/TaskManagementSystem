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

// Initialize variables for task creation
$title = $description = $due_date = $status = '';
$creation_successful = false;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = $_POST['task_title'];
    $description = $_POST['task_description'];
    $due_date = $_POST['task_duedate'];
    $status = $_POST['task_status'];

    // Validate form inputs (add validation rules as needed)
    if (empty($title) || empty($description) || empty($due_date) || empty($status)) {
        // Handle validation errors or display an error message
    } else {
        // Insert the task into the database
        $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

        $sql = "INSERT INTO tasks (user_id, task_title, task_description, task_duedate, task_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $title, $description, $due_date, $status);
        
        if ($stmt->execute()) {
            $creation_successful = true;
        }

        // Close the prepared statement
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
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
                <h2 class="text-center">Create Task</h2>
            </div>
        </div>

        <!-- Task Creation Form -->
        <div class="row mt-3">
            <div class="col-md-6 mx-auto">
                <form method="POST" action="create_task.php">
                    <div class="form-group">
                        <label for="task_title">Title</label>
                        <input type="text" class="form-control" id="task_title" name="task_title" required>
                    </div>
                    <div class="form-group">
                        <label for="task_description">Description</label>
                        <textarea class="form-control" id="task_description" name="task_description" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="task_duedate">Due Date</label>
                        <input type="date" class="form-control" id="task_duedate" name="task_duedate" required>
                    </div>
                    <div class="form-group">
                <label for="task_status">Status</label>
                <select class="form-control" id="task_status" name="task_status" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </form>
                <?php
                // Display a success message if task creation was successful
                if ($creation_successful) {
                    echo '<p class="text-success text-center mt-3">Task created successfully!</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts here -->
</body>
</html>
