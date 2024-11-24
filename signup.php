<?php
// Include config and header files
include('config.php');
include('header.php');

// Initialize error and success messages
$error = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    // Capture and sanitize inputs
    $new_username = htmlspecialchars(trim($_POST['new_username_or_email']));
    $new_password = htmlspecialchars(trim($_POST['new_password']));

    // Validate inputs
    if ((!empty($new_username)) && !empty($new_password)) {
        try {
            // Hash the password before storing it
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Prepare SQL query to insert new user (either by username or email)
            if (!empty($new_username)) {
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $new_username, $new_username, $hashed_password); // Use $new_username for both username and email
            }

            if ($stmt->execute()) {
                $error = ''; // Clear any previous error messages
                $success_message = "Account created successfully. You can now log in.";
            } else {
                // Log the error to see what went wrong
                $error = "Failed to create new account. " . $stmt->error; // Display SQL error
            }
        } catch (Exception $e) {
            $error = "An error occurred: " . $e->getMessage();
        }
    } else {
        $error = "Please provide a username or email and a password.";
    }
}
?>

<style>
    /* Centering the content */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .error, .success {
        color: red;
        text-align: center;
    }

    .success {
        color: green;
    }

    table {
        width: 100%;
        border-spacing: 10px;
    }

    td {
        padding: 10px;
        text-align: left;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #28a745;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    .center {
        text-align: center;
    }

    p {
        text-align: center;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h2>Create an Account</h2>

    <form method="POST">
        <div class="error"><?= $error ?></div>
        <div class="success"><?= $success_message ?></div>

        <table>
            <tr>
                <td>Username/Email</td>
                <td><input type="text" name="new_username_or_email" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="new_password" required /></td>
            </tr>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="signup" value="Create Account" />
                </td>
            </tr>
        </table>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php
// Include the footer
include('footer.php');
?>
