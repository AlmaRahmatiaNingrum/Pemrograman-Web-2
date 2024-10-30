<?php
include('config.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$menu_result = $conn->query("SELECT * FROM menu");
$success_message = ""; // Variabel untuk pesan sukses

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST['quantity'];
    $username = $_SESSION['username'];

    $user_id_result = $conn->query("SELECT id FROM users WHERE username='$username'");
    $user_id_row = $user_id_result->fetch_assoc();
    $user_id = $user_id_row['id'];

    $sql = "INSERT INTO orders (user_id, quantity) VALUES ('$user_id', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Order placed successfully!";
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
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("OIP.jpg");
            margin: 0;
        }

        form {
            background-color: #f5f3f3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255,0,0,0.6);
            text-align: center;
        }

        h2 {
            margin-bottom: 30px;
            color: #2b2929;
        }

        input[type="text"], input[type="password"], input[type="number"], select {
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
            padding: 10px;
            margin: 10px 0;
            border: 1px solid;
            border-radius: 4px;
        }

        .logout-button {
            margin-top: 10px; 
            background-color: #0c5850; 
        }

        .logout-button:hover {
            background-color: #8ccb52; 
        }

        .success-message {
            margin-top: 20px;
            color: white;
            font-size: 18px;
            text-align: center;
        }
        .success-message{
            background-color: #0c5850;
        }
    </style>

    <form action="order.php" method="POST">
        <h2>Order</h2>
        <label for="menu_id">Pilih Menu:</label>
        <select name="menu_id" required>
            <?php
            if ($menu_result->num_rows > 0) {
                while($menu_row = $menu_result->fetch_assoc()) {
                    echo "<option value='".$menu_row['menu_id']."'>".$menu_row['name']." - Rp. ".$menu_row['price']."</option>";
                }
            } else {
                echo "<option value=''>Menu tidak tersedia</option>";
            }
            ?>
        </select><br>

        <label for="quantity">Jumlah:</label>
        <input type="number" name="quantity" placeholder="Jumlah" required><br>

        <button type="submit">Pesan Sekarang</button>
        <button type="button" onclick="window.location.href='logout.php'" class="logout-button">Logout</button>

        <!-- Pesan sukses jika ada -->
        <?php if ($success_message): ?>
            <div class="success-message"><?= $success_message; ?></div>
        <?php endif; ?>
    </form>
</body>
</html>
