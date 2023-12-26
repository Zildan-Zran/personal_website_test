<?php
include "user.php";
$classFunction = new Users;

if (!isset($_SESSION['data'])) {
return header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Manusia</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="div-index"><b>
            <?php
            if (isset($_SESSION['pesan'])) {
                echo '<div class="success-index" role="alert"> ' . $_SESSION['pesan'] . '
                </div>';
                unset($_SESSION['pesan']);
            }
?>
        </div></b>

<table class="table" border="1" cellpadding="10" cellspacing="0">

<tr class="th">
    <th class="desain-th-td th">No.</th>
    <th class="desain-th-td th">Name</th>
    <th class="desain-th-td th">Email</th>
    <th class="desain-th-td th">Phone</th>
    <th class="desain-th-td th">Photo</th>
    <th class="desain-th-td th"></th>
</tr>

<?php
$i = 1;
$users = $classFunction->getData();
?>
<?php foreach ($users as $row) : ?>
<tr>
    <td class="desain-th-td">
        <?= $i; ?>
    </td>
    <td class="desain-th-td"><?= $row["name"]; ?></td>
    <td class="desain-th-td"><?= $row["email"]; ?></td>
    <td class="desain-th-td"><?= $row["phone"]; ?></td>
    <td class="desain-th-td"><img src="<?= '' . $row["photo"] . ''?>" alt="Uploaded Image" width="100" height="100"></td>
    <td>
        <a class="edit-btn" href="<?=' edit.php?id=' . $row['id'] . ''?>">Edit</a>
        <a class="delete-btn" href="<?='process.php?param=delete&id=' . $row['id'] . ''?>">Delete</a>
    </td>
</tr>
<?php $i++ ?>
<?php endforeach; ?>

</table>

<a class="a-table" href="create.php">Tambah Data</a>
<a class="a-table-2" href="logout.php">Logout</a>

</body>
</html>