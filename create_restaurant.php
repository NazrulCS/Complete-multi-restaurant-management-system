<?php
session_start();
include('db_connection.php'); // Include database connection script

if (!isset($_SESSION['owner_id'])) {
    header("Location: restaurant_owner_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
    $o_hr = $_POST['o_hr'];
    $c_hr = $_POST['c_hr'];
    $o_days = $_POST['o_days'];
    $address = $_POST['address'];
    $image = $_POST['image'];
    $c_id = $_POST['c_id']; // category id
    $owner_id = $_SESSION['owner_id'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO restaurant (c_id, title, email, phone, url, o_hr, c_hr, o_days, address, image, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssi", $c_id, $title, $email, $phone, $url, $o_hr, $c_hr, $o_days, $address, $image, $owner_id);

    if ($stmt->execute()) {
        header("Location: restaurant_owner_dashboard.php");
    } else {
        $error = "Error creating restaurant.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Restaurant</title>
</head>
<body>
    <h2>Create New Restaurant</h2>
    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br>
        <label for="url">URL:</label>
        <input type="url" name="url"><br>
        <label for="o_hr">Opening Hour:</label>
        <input type="time" name="o_hr" required><br>
        <label for="c_hr">Closing Hour:</label>
        <input type="time" name="c_hr" required><br>
        <label for="o_days">Opening Days:</label>
        <input type="text" name="o_days" required><br>
        <label for="address">Address:</label>
        <input type="text" name="address" required><br>
        <label for="image">Image URL:</label>
        <input type="text" name="image"><br>
        <label for="c_id">Category ID:</label>
        <input type="number" name="c_id" required><br>
        <button type="submit">Create</button>
    </form>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
