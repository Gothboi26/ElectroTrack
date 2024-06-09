<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Parts Inventory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        h1, h2 {
            color: #343a40;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        a.delete-button {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }
        a.delete-button:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function confirmDeletion(id) {
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = 'delete_part.php?id=' + id;
            }
        }
    </script>
</head>
<body>

<h1>Auto Parts Inventory</h1>

<h2>Add New Part</h2>
<form action="add_part.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" required>
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required>
    <br><br>
    <input type="submit" value="Add Part">
</form>

<h2>Parts Inventory</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <?php
    include 'config.php';
    $sql = "SELECT * FROM parts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"]. "</td>
                    <td>" . $row["name"]. "</td>
                    <td>" . $row["description"]. "</td>
                    <td>" . $row["price"]. "</td>
                    <td>" . $row["quantity"]. "</td>
                    <td><a href='javascript:void(0);' class='delete-button' onclick='confirmDeletion(" . $row["id"]. ")'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No parts found</td></tr>";
    }
    $conn->close();
    ?>
</table>

<br><br>
<a href="index.php">Back to Main Menu</a>

</body>
</html>
