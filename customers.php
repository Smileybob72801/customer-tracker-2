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
    <ul>
        <?php
        // Call the Python script
        $output = shell_exec("python get_customers.py 2>&1");

        // Log the output for debugging
        error_log("Python Output: " . $output);

        // Check if output is valid
        if ($output === null || trim($output) === '') {
            echo "<p>Error: Unable to fetch customer data.</p>";
        } else {
            // Decode JSON output
            $customers = json_decode($output, true);

            // Check for valid JSON
            if (json_last_error() === JSON_ERROR_NONE) {
                foreach ($customers as $customer) {
                    echo "<li>ID: {$customer['id']}, Name: {$customer['name']}</li>";
                }
            } else {
                echo "<p>Error: Invalid JSON response. " . json_last_error_msg() . "</p>";
            }
        }
        ?>
    </ul>
</body>
</html>
