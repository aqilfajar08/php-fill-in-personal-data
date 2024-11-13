<!-- berfungsi untuk menambahkan data secara otomatis melalui website bkn dr localhost seperti sebelum nya -->
<?php
    include "service/database.php";
    session_start();

    $register_message = "";

    if(isset($_SESSION["is_login"])) {
        header("location: dashboard.php");
    }

    if(isset($_POST["register"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $hash_password = hash("sha256", $password);

        try{
        // bertujuan memasukkan tabel username dan password 
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";

        // pengkondisian yang dimana data bisa terkirim atau gagal
        if($db->query($sql)) {
            $register_message = "Data masuk, silahkan login";
        } else {
            $register_message = "Data tidak masuk";
        }
        } catch (mysqli_sql_exception) {
            $register_message = "User name sudah ada, silahkan ganti yang lain";
        }
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include "layout/header.html" ?>

    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="register">daftar sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>