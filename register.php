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
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $state_of_origin = $_POST["state_of_origin"];
    $password = $_POST["password"];


    $check_email_sql = "SELECT * FROM register WHERE email = '$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        echo "<script>
                    alert('Email already exists. Please choose a different email address.');
                    window.location.href = 'index.html';
                  </script>";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  
        $sql = "INSERT INTO register VALUES ('','$fullname', '$email', '$dob', '$state_of_origin', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Registration successful! Redirecting...');
                    window.location.href = 'index.html';
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>
