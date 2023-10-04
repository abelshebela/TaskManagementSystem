<?php
// Start a session
session_start();

// Include the database connection file
include('db.php');

// Initialize variables for error messages
$username_error = $password_error =  $email_error = $phoneno_error = "";
$registration_successful = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize user input
    $username = $_POST['user_username'];
    $email =$_POST['user_email'];
    $password = $_POST['user_password'];
    $phoneno = $_POST['user_phoneno'];

    // Validate username (adjust validation criteria as needed)
    if (empty($username)) {
        $username_error = 'Please enter a username';
    }

    if (empty($email)) {
        $email_error = 'Please enter your email address';
    }

    // Validate password (adjust validation criteria as needed)
    if (empty($password)) {
        $password_error = 'Please enter a password';
    }

    if (empty($phoneno)) {
        $password_error = 'Please enter a phone number';
    }

    // If there are no validation errors, proceed with registration
    if (empty($username_error) && empty($password_error)) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (user_username, user_email, user_phoneno, user_password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $phoneno, $hashed_password);

        if ($stmt->execute()) {
            // Registration successful
            // Set session variables
            $_SESSION['user_id'] = $stmt->insert_id; // Store the new user's ID in the session
            $registration_successful = true;
        } else {
            // Registration failed
            // Handle errors or display an error message
            echo "Registration failed. Please try again.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
                        <h2 class="card-title text-center">Registration</h2>
                        <form method="POST" action="register.php">
                            <div class="form-group">
                                <label for="user_username">Username</label>
                                <input type="text" class="form-control" id="user_username" name="user_username" required>
                                <small class="error"><?php echo $username_error; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email address</label>
                                <input type="text" class="form-control" id="user_email" name="user_email" required>
                                <small class="error"><?php echo $username_error; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="user_password" class="form-control" id="user_password" name="user_password" required>
                                <small class="error"><?php echo $password_error; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="user_phoneno">Phone number</label>
                                <input type="user_phoneno" class="form-control" id="user_phoneno" name="user_phoneno" required>
                                <small class="error"><?php echo $phoneno_error; ?></small>
                            </div>
                        
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                        <?php
                        // Display a success message if registration was successful
                        if ($registration_successful) {
                            echo '<p class="text-success text-center mt-3">Registration successful! You can now <a href="login.php">login</a>.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
