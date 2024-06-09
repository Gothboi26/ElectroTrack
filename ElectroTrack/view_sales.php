<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Sales Records</h1>

<table>
    <tr>
        <th>Sale ID</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Sale Date</th>
    </tr>
    <?php
    include 'config.php';
    $sql = "SELECT sales.id AS sale_id, sales_items.item_name, sales_items.quantity, sales_items.price, sales.sale_date 
            FROM sales 
            JOIN sales_items ON sales.id = sales_items.sale_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["sale_id"]. "</td>
                    <td>" . $row["item_name"]. "</td>
                    <td>" . $row["quantity"]. "</td>
                    <td>" . $row["price"]. "</td>
                    <td>" . $row["sale_date"]. "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No sales records found</td></tr>";
    }
    $conn->close();
    ?>
</table>

<br><br>
<a href="index.php">Back to Home</a>

</body>
</html>
