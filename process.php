<?php
include "user.php";
$classFunction = new Users();


if($_GET['param']== 'create') {
    return $classFunction->createData($_POST['nama'], $_POST['email'], $_POST['phone'], $_POST['password'], $_FILES['photo']);
}

if($_GET['param']== 'update') {
    return $classFunction->updateData($_POST['id'], $_POST['nama'], $_POST['email'], $_POST['phone'], $_POST['password'], $_FILES['photo']);
}

if($_GET['param']== 'delete') {
    return $classFunction->deleteData($_GET['id']);
}

if($_GET['param']== 'login') {
    return $classFunction->loginProcess($_POST['email'], $_POST['password']);
}