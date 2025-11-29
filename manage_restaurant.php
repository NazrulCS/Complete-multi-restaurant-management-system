<?php
session_start();
include('db_connection.php'); // Include database connection script

if (!isset($_SESSION['owner_id'])) {
    header("Location: restaurant_owner_login.php");
    exit();
}

$owner_id = $_SESSION['owner_id'];
$rs_id = $_GET['rs_id'];

// Fetch restaurant details
$stmt = $conn->prepare("SELECT * FROM restaurant WHERE rs_id = ? AND owner_id = ?");
$stmt->bind_param("ii", $rs_id, $owner_id);
$stmt->execute();
$result = $stmt->get_result();
$restaurant = $result->fetch_assoc();
$stmt->close();

// Fetch dishes
$stmt = $conn->prepare("SELECT * FROM dishes WHERE rs_id = ?");
$stmt->bind_param("i", $rs_id);
$stmt->execute();
$dishes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Restaurant</title>
</head>
<body>
    <h2>Manage Restaurant: <?= htmlspecialchars($restaurant['title']) ?></h2>
    <h3>Dishes</h3>
    <ul>
        <?php foreach ($dishes as $dish) { ?>
            <li>
                <?= htmlspecialchars($dish['title']) ?> - $<?= htmlspecialchars($dish['price']) ?>
            </li>
        <?php } ?>
    </ul>
    <a href="create_dish.php?rs_id=<?= $rs_id ?>">Add New Dish</a>
    <br><br>
    <a href="restaurant_owner_dashboard.php">Back to Dashboard</a>
</body>
</html>
