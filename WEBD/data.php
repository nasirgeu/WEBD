<?php
    $connection = mysqli_connect("localhost", "root", "");
    $dbname = mysqli_select_db($connection, "formd");

    $name1 = $_POST['name'];
    $email1 = $_POST['email'];
    $city1 = $_POST['city'];
    $campus1 = $_POST['campus'];

    $query = "INSERT INTO `mydata` (`name`, `email`, `city`, `campus`) VALUES ('$name1', '$email1', '$city1', '$campus1')";

    $result = mysqli_query($connection, $query); 
?>  

<script type="text/javascript">
    alert("yes");
    window.location.href = "form1.php";
</script>