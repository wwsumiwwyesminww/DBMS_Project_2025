<?php
include 'connect.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["username"];
  $password = $_POST["password"];
  $usertype = $_POST["usertype"];

  // Adjust columns according to your DB structure
  $sql1 = "INSERT INTO user_t(username, phone) VALUES('$name', '$usertype')";
  $sql2 = "INSERT INTO user_login_t(username, password) VALUES('$name', '$password')";

  if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
    header('Location: homepage.html');
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}

$conn->close();
?>