<?php
// Start with any PHP logic before HTML output
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_customer'])) {
    $name = $_POST['name'];
    // Call your Python script to add the customer
    shell_exec("python -c \"import customers; customers.add_customer('$name')\"");
    
    // Redirect to the same page to refresh the customer list
    header("Location: customers.php");
    exit(); // Make sure to exit after a redirect
}
?>

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
    
    <form method="POST" action="customers.php">
        <input type="text" name="name" placeholder="Enter customer name" required>
        <button type="submit" name="add_customer">Add Customer</button>
    </form>
    
    <ul>
        <?php
        // Call the Python script to get all customers
        $output = shell_exec("python get_customers.py 2>&1");

        // Log the output for debugging
        error_log("Python Output: " . $output);

        // Decode JSON output
        $customers = json_decode($output, true);

        // Display customers
        if (json_last_error() === JSON_ERROR_NONE) {
            foreach ($customers as $customer) {
                echo "<li>ID: {$customer['id']}, Name: {$customer['name']}</li>";
            }
        } else {
            echo "<p>Error: Invalid JSON response. " . json_last_error_msg() . "</p>";
        }
        ?>
    </ul>
</body>
</html>
