<?php
// Start a session
session_start();

// Include the database connection file
include('db.php');

// Initialize variables for error messages
$username_error = $password_error = '';
$login_successful = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username (adjust validation criteria as needed)
    if (empty($username)) {
        $username_error = 'Please enter a username';
    }

    // Validate password (adjust validation criteria as needed)
    if (empty($password)) {
        $password_error = 'Please enter a password';
    }

    // If there are no validation errors, proceed with login
    if (empty($username_error) && empty($password_error)) {
        // Query the database to retrieve user data
        $sql = "SELECT user_id, user_password FROM users WHERE user_username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // User found; verify password
            $row = $result->fetch_assoc();
            $stored_password = $row['user_password'];

            if (password_verify($password, $stored_password)) {
                // Password is correct; log in the user
                $_SESSION['user_id'] = $row['user_id']; // Set the user's ID in the session
                $login_successful = true;
            }
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
    <title>Login</title>
    <!-- Add Bootstrap CSS link here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Add custom styles here, if needed */
        .error {
            color: red;
        }
        .logo {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="text-center">
                    <img class="logo" src="your-logo.png" alt="Task Management System Logo">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login</h2>
                        <form method="POST" action="login.php">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <small class="error"><?php echo $username_error; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <small class="error"><?php echo $password_error; ?></small>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <?php
                        // Redirects to the dashboard page if login was successful
                        if ($login_successful) {
                            header("Location: dashboard.php");
                            exit();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
