<?php
session_start();
include('db_connection.php'); // Include database connection script

if (!isset($_SESSION['owner_id'])) {
    header("Location: restaurant_owner_login.php");
    exit();
}

$owner_id = $_SESSION['owner_id'];
$rs_id = $_GET['rs_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $slogan = $_POST['slogan'];
    $price = $_POST['price'];
    $img = $_POST['img'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO dishes (rs_id, title, slogan, price, img) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issds", $rs_id, $title, $slogan, $price, $img);

    if ($stmt->execute()) {
        header("Location: manage_restaurant.php?rs_id=$rs_id");
    } else {
        $error = "Error creating dish.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Dish</title>
</head>
<body>
    <h2>Create New Dish</h2>
    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>
        <label for="slogan">Slogan:</label>
        <input type="text" name="slogan"><br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required><br>
        <label for="img">Image URL:</label>
        <input type="text" name="img"><br>
        <button type="submit">Create</button>
    </form>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
