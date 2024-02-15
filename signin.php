<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "db_sacred"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

 
    $sql = "SELECT * FROM register WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["pass"])) {
            echo "Login successful!";
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }
}


$conn->close();
?>
