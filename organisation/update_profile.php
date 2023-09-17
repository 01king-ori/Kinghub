<?php
require 'config.php';


if (!isset($_SESSION["id"])) {
    header("Location: Login.php");
    exit();
}

if (isset($_POST["update"])) {
    $id = $_SESSION["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    

    $query = "UPDATE organization SET name=?, username=?, email=?,  WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $username, $email,$address, $id);
    mysqli_stmt_execute($stmt);

    header("Location: profile.php");
}
