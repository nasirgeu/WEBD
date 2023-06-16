<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlinecourse";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = "";
$password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM login WHERE email = '$username' AND pass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // $row = $result->fetch_assoc();
        // if (password_verify($password, $row["pass"])) {
        //     header("Location: secure_page.php");
        //     exit();
        // } else {
        //     $error = "Invalid password";
        // }
        $error = "found";
    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 8px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
    </form>
    <p><?php echo $error; ?></p>
</body>
</html>

<?php
$conn->close();
?>
