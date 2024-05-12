<?php
include "koneksi.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_siswa = $_POST['id_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $gender = $_POST['gender'];
    $username=$_POST['username'];

    $query_update_siswa = mysqli_query($conn, "UPDATE siswa SET nama_siswa='$nama_siswa', tanggal_lahir='$tanggal_lahir', alamat='$alamat', gender='$gender', username='$username' WHERE id_siswa = $id_siswa");

    
    if ($query_update_siswa) {
        
        header("Location: tampil_siswa.php");
        exit(); 
    } else {
        
        echo "Error: " . mysqli_error($conn);
    }
} else {
    
    echo "Metode yang digunakan tidak valid.";
}
?>