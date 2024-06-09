<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the part is referenced in sales_items
    $sql = "SELECT COUNT(*) AS count FROM sales_items WHERE part_id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Part is associated with sales items, so don't delete
        echo "Cannot delete this part because it has associated sales records.";
    } else {
        // No associated sales items, proceed with deletion
        $sql = "DELETE FROM parts WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Part deleted successfully";
        } else {
            echo "Error deleting part: " . $conn->error;
        }
    }
} else {
    echo "No part id provided";
}

$conn->close();
?>

<br><br>
<a href="index.php">Back to Inventory</a>
