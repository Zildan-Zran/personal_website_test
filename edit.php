<?php
include "user.php";
$classFunction = new Users();

$id = $_GET["id"];
$data = $classFunction->getDetail($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="jarak-tambah"></div>

<h1 class="h1-tambah">Tambah Data</h1>
    
<form class="form-tambah" action="process.php?param=update" method="post" enctype="multipart/form-data">
    <div>

</div>
    <ul class="ul-tambah">
        <li class="li-tambah">
        <label class="label-tambah" for="nama">Name : </label>
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <input class="input-tambah" type="text" name="nama" value="<?= $data['name']; ?>" id="nama">
        </li>
        <li class="li-tambah">
        <label class="label-tambah" for="email">Email : </label>
        <input class="input-tambah" type="email" name="email" value="<?= $data['email']; ?>" id="email">
        </li>
        <li class="li-tambah">
        <label class="label-tambah" for="phone">Phone : </label>
        <input class="input-tambah" type="number" name="phone" value="<?= $data['phone']; ?>" id="phone">
        </li>
        <li class="li-tambah">
        <label class="label-tambah" for="password">Password : </label>
        <input class="input-tambah" type="text" name="password" value="<?= $data['password']; ?>" id="password">
        </li>
        <li>
        <label class="label-tambah" for="photo">Pilih Gambar : </label>
        <input class="input-upload" type="file" name="photo" id="photo">
        </li>
        <li class="li-tambah">
            <button class="btn-kembali" type="button" onclick="window.location.href='index.php'">Kembali</button>
            <button class="btn-tambah" type="submit" name="submit">Submit</button>
        </li>
    </ul>
</form>

</body>
</html>