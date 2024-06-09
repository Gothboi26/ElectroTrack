<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $part_id = $_POST['part_id'];
    $quantity = $_POST['quantity'];

    // Check if the part exists and has enough quantity
    $sql = "SELECT * FROM parts WHERE id = $part_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row && $row['quantity'] >= $quantity) {
        // Deduct quantity from parts
        $new_quantity = $row['quantity'] - $quantity;
        $update_sql = "UPDATE parts SET quantity = $new_quantity WHERE id = $part_id";
        $conn->query($update_sql);

        // Insert into sales
        $sale_sql = "INSERT INTO sales (sale_date) VALUES (NOW())";
        if ($conn->query($sale_sql) === TRUE) {
            // Get the last inserted sale ID
            $sale_id = $conn->insert_id;

            // Insert into sales_items with price and item name
            $price = $row['price'];
            $item_name = $row['name'];
            $sale_item_sql = "INSERT INTO sales_items (sale_id, part_id, quantity, price, item_name) VALUES ($sale_id, $part_id, $quantity, $price, '$item_name')";
            if ($conn->query($sale_item_sql) === TRUE) {
                echo "Sale processed successfully";
            } else {
                echo "Error inserting into sales_items: " . $conn->error;
            }
        } else {
            echo "Error inserting into sales: " . $conn->error;
        }
    } else {
        echo "Error: Not enough quantity in stock";
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>

<br><br>
<a href="sales.php">Back to Sales</a>
