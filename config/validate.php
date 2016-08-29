<?php
$id = $_POST["id"];

include "database.php";

if (isset($id)) {
    $sql = "SELECT id FROM users WHERE id = '$id'";
    $id = $conn->query($sql)->fetch_object()->id;

    if (isset($id)) {
        echo 0; // 중복된 아이디
    } else {
        echo 1; // 사용가능한 아이디
    }
}

$conn->close();
