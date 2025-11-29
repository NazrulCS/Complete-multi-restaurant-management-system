<?php
session_start();
include('db_connection.php'); // Include database connection script

if (!isset($_SESSION['owner_id'])) {
    header("Location: restaurant_owner_login.php");
    exit();
}

$owner_id = $_SESSION['owner_id'];

// Fetch owner's restaurants
$stmt = $conn->prepare("SELECT rs_id, title FROM restaurant WHERE owner_id = ?");
$stmt->bind_param("i", $owner_id);
$stmt->execute();
$result = $stmt->get_result();
$restaurants = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Owner Dashboard</title>
</head>
<body>
    <h2>Welcome to your Dashboard</h2>
    <h3>Your Restaurants</h3>
    <ul>
        <?php foreach ($restaurants as $restaurant) { ?>
            <li>
                <a href="manage_restaurant.php?rs_id=<?= $restaurant['rs_id'] ?>">
                    <?= htmlspecialchars($restaurant['title']) ?>
                </a>
            </li>
        <?php } ?>
    </ul>
    <a href="create_restaurant.php">Add New Restaurant</a>
    <br><br>
    <a href="logout.php">Logout</a>
</body>
</html>
