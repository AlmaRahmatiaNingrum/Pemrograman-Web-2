<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', 'test@example.com')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form action="register.php" method="POST">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
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
    background-color: #e8ebeb;
    background-image: url("OIP.jpg");
}

form {
    background-color: #f5f3f3;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(225, 0 ,0 , 0.8);
}

h2 {
    margin-bottom: 30px;
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
