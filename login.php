<?php
    include "service/database.php";
    session_start();

    $login_message = "";

    if(isset($_SESSION["is_login"])) {
        header("location: dashboard.php");
    }

    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // untuk membuat password menjadi privacy di mata admin agar mendapat kepercayaan antara user dan admin
        $hash_password = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'
        ";

        // sebelum memvalidasi sebuah variable, harus membuat proses pengeksekusian nya terlebih dahulu seperti kode ini 
        $result = $db->query($sql);

        // memvalidasi kode dari pengeksekusian variable di atas, dengan mengecek apakah akun user telah terdaftar sebelum nya atau tidak 
        // apakah hasil dari query mengandung data. Jika mengandung data, maka data ditemukan
        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;
            
            header("location: dashboard.php");
            
        } else {
           $login_message = "Akun tidak ditemukan";
        }
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include "layout/header.html" ?>

    <h3>MASUK AKUN</h3>
    <i><?= $login_message ?></i>
    <form action="login.php" method="POST">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="login">masuk sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>