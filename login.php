<?php
// Include config and header files
include('config.php');
include('header.php');

// Initialize error message
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Capture user input
    $username_or_email = htmlspecialchars(trim($_POST['username_or_email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate inputs
    if (!empty($username_or_email) && !empty($password)) {
        try {
            // Prepare SQL query to check if the user exists (username or email)
            $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $username_or_email, $username_or_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch the user data
                $user = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Start session and set user data
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    // Redirect to dashboard or home page
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $error = "Invalid password. Please try again.";
                }
            } else {
                $error = "No user found with that username or email.";
            }
        } catch (Exception $e) {
            $error = "An error occurred: " . $e->getMessage();
        }
    } else {
        $error = "Please enter both username/email and password.";
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
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
    }

    .error, .success {
        color: red;
        margin-bottom: 15px;
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
        background-color: #007bff;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    p {
        margin-top: 15px;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .center {
        text-align: center;
    }
</style>

<div class="container">
    <h2>Login</h2>

    <form method="POST">
        <div class="error"><?= $error ?></div>

        <table>
            <tr>
                <td>Username or Email</td>
                <td><input type="text" name="username_or_email" required /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required /></td>
            </tr>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="login" value="Login" />
                </td>
            </tr>
        </table>
    </form>

    <p>Don't have an account? <a href="signup.php">Create a new account</a></p>
</div>

<?php
// Include the footer
include('footer.php');
?>
