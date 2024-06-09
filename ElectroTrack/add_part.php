<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO parts (name, description, price, quantity) VALUES ('$name', '$description', '$price', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "New part added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<br><br>
<a href="index.php">Back to Inventory</a>
