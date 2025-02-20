<link rel="stylesheet" href="style.css">

<?php include 'navbar.php'; ?>

<?php
for ($i = 0; $i < 10; $i++){}
$fruits = ["Apple", "Banana", "Cherry", "Date"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fruits List</title>
</head>
<body>
    <h1>PHP Sandbox</h1>
    <p>Iteration count: <?php echo $i ?> </p>

    <h1>Fruits</h1>
    <p>Simple PHP loop:</p>
    <?php foreach ($fruits as $fruit){
            echo $fruit . "<br>";
        } ?>

    <p>Foreach loop with embedded HTML:</p>
    <ul>
        <?php foreach ($fruits as $fruit): ?>
            <li><?php echo $fruit; ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Implosion with ", " as seperator</p>
    <?php $fruitString = implode(", ", $fruits);
    echo $fruitString;
    ?>

    <p>Implosion with "&lt;br&gt;" as seperator</p>
    <?php $fruitString = implode("<br>", $fruits);
    echo $fruitString;
    ?>

    
</body>
</html>