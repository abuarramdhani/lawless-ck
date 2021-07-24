<?php
require_once "../vendor/autoload.php";
require_once '../include/connection.php';

include '../models/user.php';

$userObj = new User($koneksi);

if(isset($_POST['submit'])){
    $create = $userObj->create($_POST);
    echo $create;
}

if(isset($_POST['update'])){
    $update = $userObj->update($_POST);
    echo $update;
}

if(isset($_POST['delete'])){
    $delete = $userObj->delete($_POST['id']);
    echo $delete;
}
?>