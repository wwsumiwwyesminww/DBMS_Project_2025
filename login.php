<?php
include 'connect.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["username"];
  $password = $_POST["password"];

  // Use prepared statement to avoid SQL injection
  $stmt = $conn->prepare("SELECT * FROM user_login_t WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $name, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    session_start();
    $_SESSION['name'] = $name;
    header('Location: homepage.html');
    exit();
  } else {
    echo "Wrong username or password";
  }

  $stmt->close();
}

$conn->close();
?>