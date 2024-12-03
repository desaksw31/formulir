<?php
    include "service/database.php";
    session_start();

    if(isset($_POST['kirim'])) {
        $nama = $_POST["nama"] ?? '';
        $nik = $_POST["nik"] ?? '';
        $phone = $_POST["phone"] ?? '';
        $email = $_POST["email"] ?? '';
        $pengaduan = $_POST["pengaduan"] ?? '';
        $link = $_POST["link"] ?? '';

        try{
            $sql = $db->prepare("INSERT INTO aduan (nama, nik, phone, email, pengaduan, link) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param("ssssss", $nama, $nik, $phone, $email, $pengaduan, $link);

            if($sql->execute()){
                echo '<script type="text/javascript"> window.onload = function () { 
                    alert("Aduan telah terkirim"); 
                } </script>';
            }else{
                echo '<script type="text/javascript"> window.onload = function () { 
                    alert("Tidak dapat mengirim aduan"); 
                } </script>';
            }
            $sql->close();
        } catch(mysqli_sql_exception $e) {
            error_log("database error : " . $e->getMessage());
            echo '<script alert("Terjadi kesalahan, coba lagi);</script>';
        } finally{
            $db->close();
        }
       
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Formulir Pengaduan Dugaan Pelanggaran HAM di Masyarakat</title>
</head>


<body>
    <div class="form-container">
        <center><img src="asset/logo.png"><h1>Formulir Pengaduan Dugaan Pelanggaran HAM di Masyarakat</h1></center>

        <form action="index.php" method="POST">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required>

            <label for="nik">NIK</label>
            <input type="text" id="nik" name="nik" placeholder="NIK" required>
            
            <label for="phone">No Telepon</label>
            <input type="text" id="phone" name="phone" placeholder="No Telepon" required>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Email" required>

            <label for="pengaduan">Hal yang diadukan</label>
            <textarea name="pengaduan" id="pengaduan" required></textarea>

            <label for="link">Link Bukti Aduan</label>
            <input type="text" id="link" name="link" placeholder="Tempelkan link" required>

            <center><button type="submit" name="kirim">Submit</button></center>

        </form>
    </div>
    
</body>
</html>