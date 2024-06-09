<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Sales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label, input, select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Process Sales</h1>

<form action="process_sale.php" method="POST">
    <label for="part_id">Select Part:</label>
    <select id="part_id" name="part_id" required>
        <?php
        include 'config.php';
        $sql = "SELECT * FROM parts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["id"]. "'>" . $row["name"]. " - $" . $row["price"]. " (Available: " . $row["quantity"]. ")</option>";
            }
        } else {
            echo "<option value=''>No parts available</option>";
        }
        $conn->close();
        ?>
    </select>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required>

    <input type="submit" value="Process Sale">
</form>

<br><br>
<a href="index.php">Back to Home</a>

</body>
</html>
