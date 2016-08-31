<?php
$no = $_POST["no"];

include "database.php";

$sql = "DELETE FROM contents WHERE no = $no";

$conn->query($sql);
