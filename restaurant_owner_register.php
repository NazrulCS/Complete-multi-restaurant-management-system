<?php
session_start();
include('db_connection.php'); // Include database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT owner_id FROM restaurant_owners WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new owner into the database
            $stmt = $conn->prepare("INSERT INTO restaurant_owners (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['owner_id'] = $stmt->insert_id;
                header("Location: restaurant_owner_dashboard.php");
                exit();
            } else {
                $error = "Error creating account.";
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Owner Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>
        <button type="submit">Register</button>
    </form>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <a href="restaurant_owner_login.php">Already have an account? Login here</a>
</body>
</html>
