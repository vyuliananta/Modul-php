<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Ubah Siswa</title>
</head>
<body>
<?php
include "koneksi.php"; 

if(isset($_GET['id_siswa']) && is_numeric($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];
    
    $query_get_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa = $id_siswa");
    
    $qry_kelas = mysqli_query($conn, "SELECT * FROM kelas");
    
    if(mysqli_num_rows($query_get_siswa) > 0) {
        $data_siswa = mysqli_fetch_assoc($query_get_siswa);
    } else {
        echo "Data siswa tidak ditemukan.";
    }
} else {
    echo "ID siswa tidak valid.";
}
?>
    <h3>Ubah Siswa</h3>
    <form action="proses_ubah_siswa.php" method="post">
        <input type="hidden" name="id_siswa" value="<?= $data_siswa['id_siswa'] ?>">
        <input type="hidden" name="username_sebelumnya" value="<?= $data_siswa['username'] ?>">
        Nama Siswa :
        <input type="text" name="nama_siswa" value="<?= $data_siswa['nama_siswa'] ?>" class="form-control">
        Tanggal Lahir : 
        <input type="date" name="tanggal_lahir" value="<?= $data_siswa['tanggal_lahir'] ?>" class="form-control">
        Gender : 
        <?php 
        $arr_gender = array('L' => 'Laki-laki', 'P' => 'Perempuan');
        ?>
        <select name="gender" class="form-control">
            <option></option>
            <?php foreach ($arr_gender as $key_gender => $val_gender): ?>
                <option value="<?= $key_gender ?>" <?= ($key_gender == $data_siswa['gender']) ? 'selected' : '' ?>>
                    <?= $val_gender ?>
                </option>
            <?php endforeach ?>
        </select>
        Alamat : 
        <textarea name="alamat" class="form-control" rows="4"><?= $data_siswa['alamat'] ?></textarea>
        Kelas :
        <select name="id_kelas" class="form-control">
            <option></option>
            <?php while ($data_kelas = mysqli_fetch_array($qry_kelas)): ?>
                <option value="<?= $data_kelas['id_kelas'] ?>" <?= ($data_kelas['id_kelas'] == $data_siswa['id_kelas']) ? 'selected' : '' ?>>
                    <?= $data_kelas['nama_kelas'] ?>
                </option>
            <?php endwhile ?>
        </select>
        Username : 
        <input type="text" name="username" value="<?= $data_siswa['username'] ?>" class="form-control">
        Password : 
        <input type="password" name="password" value="" class="form-control">
        <input type="submit" name="simpan" value="Ubah Siswa" class="btn btn-primary">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
