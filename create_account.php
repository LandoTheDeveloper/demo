<?php
$server = 'localhost';
$db_username = 'root';
$db_password = '';
$database = 'user_information';
$connection = new mysqli($server, $db_username, $db_password, $database, 3306) or die("not connected");
echo "connected";

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get form input values
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$company = $_POST['company'];

// Prepare and execute the SQL statement to insert the new user
$stmt = $connection->prepare("INSERT INTO users (username, password, email, gender, phone, name, company) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $username, $password, $email, $gender, $phone, $name, $company);

if ($stmt->execute()) {
    // Redirect to welcome.php with the username as a POST parameter
    header('Location: http://localhost/demo/SGSLogin.php');
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>
