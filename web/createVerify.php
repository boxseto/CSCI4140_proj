<?php
$code = mt_rand(1000, 9999);

$conn = new mysqli("localhost", "user", "pass", "CSCI4140");
$sql = "UPDATE verify SET code=".$code;
$conn->query($sql);

echo $code;

?>
