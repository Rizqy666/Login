<?php
//koneksi

$cons = mysqli_connect('localhost', 'root', '', 'login');
//daftar
if (isset($_POST['register'])) {
    //jika tombil register di klik

    $username = $_POST['username'];
    $password = $_POST['password'];  //ori

    //enkripsi
    $epassword = password_hash($password, PASSWORD_DEFAULT);

    //insert to db
    $insert = mysqli_query($cons, "INSERT INTO user (username,password) values ('$username','$epassword')");

    if ($insert) {
        //jika berhasil
        header('location:index.php');
    } else {
        //jika gagal
        echo '
        <script>
            alert("Registrasi Gagal!!!");
            window.location.href="register.php";
        </script>
        ';
    }
}

//login
if (isset($_POST['login'])) {
    //jika tombil login di klik

    $username = $_POST['username'];
    $password = $_POST['password'];


    //insert to db
    $cekdb = mysqli_query($cons, "SELECT * FROM user where username='$username'");
    $hitung = mysqli_num_rows($cekdb);
    $pw = mysqli_fetch_array($cekdb);
    $passwordsekarang = $pw['password'];

    if ($hitung > 0) {
        //jika ada
        //verifikasi password
        if (password_verify($password, $passwordsekarang)) {
            //jika sama
            header('location:home.php'); //halaman home
        } else {
            echo '
            <script>
                alert("Login Gagal!!!");
                window.location.href="register.php";
            </script>
            ';
        }
    } else {
        //jika gagal
        echo '
        <script>
            alert("login Gagal!!!");
            window.location.href="register.php";
        </script>
        ';
    }
}
