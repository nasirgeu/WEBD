<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color:red;
        }

        form {
            width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .bill-details {
            width: 400px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .bill-details h2 {
            margin-top: 0;
            color: #333;
        }

        .bill-details p {
            margin: 5px 0;
        }

        .bill-details strong {
            font-weight: bold;
        }
        *{
            box-sizing:border-box;
        }

        form{
            border: 1px solid #ccc;
            padding: 40px;
            margin-top:-10px;
            background-color: #f9f9f9;
            float : left;
        }

        .bill-details{
            margin-left:500px;
            font-weight:600;
        }

        .bill-details {
            width: 400px;
            margin-top: 20px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .bill-details h2 {
            margin-top: 0;
            color: red;
        }

        .bill-details p {
          margin: 5px 0;
        }

        .bill-details strong {
            font-weight: bold;
        }


    </style>
</head>
<body>
    <h1>Electricity Bill Calculator</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="connectionNumber">Connection Number:</label>
        <input type="text" id="connectionNumber" name="connectionNumber" required>
        <br><br>
        <label for="customerName">Customer Name:</label>
        <input type="text" id="customerName" name="customerName" required>
        <br><br>
        <label for="previousReading">Previous Reading:</label>
        <input type="number" id="previousReading" name="previousReading" required>
        <br><br>
        <label for="currentReading">Current Reading:</label>
        <input type="number" id="currentReading" name="currentReading" required>
        <br><br>
        <input type="submit" name="submit" value="Generate Bill">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the input values from the form
        $connectionNumber = $_POST["connectionNumber"] ?? '';
        $customerName = $_POST["customerName"] ?? '';
        $previousReading = $_POST["previousReading"] ?? '';
        $currentReading = $_POST["currentReading"] ?? '';

        // Calculate the units consumed
        $unitsConsumed = $currentReading - $previousReading;
if ($unitsConsumed < 0) {
    echo '<div class="bill-details">';
    echo '<h2>Electricity Bill</h2>';
    echo 'Current Reading must be greater than or equal to Previous Reading.';
    echo '</div>';
    return;
}


        // Calculate the electricity bill based on the units consumed
        $billAmount = calculateBill($unitsConsumed);

        // Display the bill
?>
        <div class="bill-details"> <?php echo "<h2>Electricity Bill</h2>";
        echo "Connection Number: " . $connectionNumber . "<br>";
        echo "Customer Name: " . $customerName . "<br>";
        echo "Previous Reading: " . $previousReading . "<br>";
        echo "Current Reading: " . $currentReading . "<br>";
        echo "Units Consumed: " . $unitsConsumed . "<br>";
        echo "Bill Amount: $" . $billAmount; ?>
        </div>

        <?php

        // Clear the form data after calculation
        unset($_POST["connectionNumber"]);
        unset($_POST["customerName"]);
        unset($_POST["previousReading"]);
        unset($_POST["currentReading"]);
    }

    // Function to calculate the electricity bill
    function calculateBill($unitsConsumed) {
        if ($unitsConsumed <= 100) {
            $billAmount = 3 * $unitsConsumed;
        } elseif ($unitsConsumed > 100 && $unitsConsumed <= 200) {
            $billAmount = 3 * 100 + (4 * ($unitsConsumed - 100));
        } elseif ($unitsConsumed > 200 && $unitsConsumed <= 300) {
            $billAmount = 3 * 100 + (4 * 100) + (5 * ($unitsConsumed - 200));
        } else {
            $billAmount = 3 * 100 + (4 * 100) + (5 * 100) + (6 * ($unitsConsumed - 300));
        }
        return $billAmount;
    }    
    ?>
</body>
</html>
