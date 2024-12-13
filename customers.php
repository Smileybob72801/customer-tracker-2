<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add customer
    if (isset($_POST['add_customer'])) {
        $name = $_POST['name'];
        $birthdate = $_POST['birthdate'];
        shell_exec("python -c \"import customers; customers.add_customer('$name', '$birthdate')\"");
        header("Location: customers.php");
        exit();
    }

    // Update customer
    if (isset($_POST['update_customer'])) {
        $id = intval($_POST['id']); // Ensure ID is an integer
        $new_name = $_POST['new_name'];
        $new_birthdate = $_POST['new_birthdate'];
        shell_exec("python -c \"import customers; customers.update_customer($id, '$new_name', '$new_birthdate')\"");
        header("Location: customers.php");
        exit();
    }

    // Delete customer
    if (isset($_POST['delete_customer'])){
        $id = intval($_POST['id']);
        shell_exec("python -c \"import customers; customers.delete_customer($id)\"");
        header("Location: customers.php");
        exit();
    }
}
?>

<link rel="stylesheet" href="style.css">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Customer List</h1>

    <!-- Add form -->
    <form method="POST" action="customers.php">
        <input type="text" name="name" placeholder="Enter customer name" required>
        <input type="date" name="birthdate">
        <button type="submit" name="add_customer">Add Customer</button>
    </form>

    <!-- Update form -->
    <form method="POST" action="customers.php">
        <input type="number" name="id" id="customer-id" placeholder="Enter customer ID" required>
        <input type="text" name="new_name" placeholder="Enter new customer name">
        <input type="date" name="new_birthdate">
        <button type="submit" name="update_customer">Update Customer</button>
    </form>

    <!-- Delete form -->
    <form method="POST" action="customers.php">
        <input type="number" name="id" placeholder="Enter customer ID to delete" required>
        <button type="submit" name="delete_customer">Delete Customer</button>
    </form>
    
    <ul>
        <?php
        $output = shell_exec("python get_customers.py 2>&1");

        // TODO: Remove this log output when finished debugging
        // OR make a proper logger
        error_log("Python Output: " . $output); 

        $customers = json_decode($output, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            foreach ($customers as $customer) {
                echo "<li>ID: {$customer['id']}, Name: {$customer['name']}, Birthdate: {$customer['birthdate']}</li>";
            }
        } else {
            echo "<p>Error: Invalid JSON response. " . json_last_error_msg() . "</p>";
        }
        ?>
    </ul>
</body>
</html>
