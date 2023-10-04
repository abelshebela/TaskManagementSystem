<?php
// Start a session
session_start();

// Include the database connection file (e.g., db.php)
include('db.php');

// Check if the user is authenticated (you may have your own authentication logic)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php"); // Redirect to your login page
    exit();
}

// Fetch all task titles associated with the user
$user_id = $_SESSION['user_id'];
$sql = "SELECT task_id, task_title, task_status FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize variables for task title and current status
$task_title = "";
$current_status = "N/A";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get selected task_id and new status from the form
    $task_id = $_POST['task_title'];
    $new_status = $_POST['new_status'];

    // Update the task status in the database
    $update_sql = "UPDATE tasks SET task_status = ? WHERE task_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_status, $task_id);

    if ($update_stmt->execute()) {
        // Status updated successfully
        // Redirect to the dashboard or display a success message
        header("Location: dashboard.php");
        exit();
    } else {
        // Handle the case when the update fails
        // You can redirect or display an error message
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


<!-- Main Content -->
<div class="container mt-5">
    <h1>Update Task Status</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="task_title">Select Task:</label>
            <select class="form-control" id="task_title" name="task_title">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $task_id = htmlspecialchars($row['task_id']);
                    $title = htmlspecialchars($row['task_title']);
                    $status = htmlspecialchars($row['task_status']);
                    echo '<option value="' . $task_id . '">' . $title . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="current_status">Current Status:</label>
            <input type="text" class="form-control" id="current_status" name="current_status" value="<?php echo $current_status; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="new_status">Select New Status:</label>
            <select class="form-control" id="new_status" name="new_status">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>

<!-- JavaScript to update current status when task is selected -->
<script>
document.getElementById('task_title').addEventListener('change', function () {
    var selectedTask = this.options[this.selectedIndex];
    var currentStatusInput = document.getElementById('current_status');
    currentStatusInput.value = selectedTask.getAttribute('data-status');
});
</script>

</body>
</html>
