<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: order.php");
        } else {
            echo "Invalid Password";
        }
    } else {
        echo "No User Found";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <form action="login.php" method="POST">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url("WhatsApp Image 2024-10-28 at 11.01.04_57ff4ac8.jpg");
}

form {
    background-color: #f5f3f3;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(255,0,0,0.8)
}

h2 {
    margin-bottom: 40px;
    color: #2b2929;
}

input[type="text"], input[type="password"], input[type="number"] {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    background-color: #0c5850;
    color: #fff;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #8ccb52;
}

</style>

