<?php
$code = mt_rand(100000, mt_getrandmax());

$conn = new mysqli("localhost", "user", "pass", "CSCI4140");
$sql = "UPDATE verify SET code=".$code;
$conn->query($sql);

echo $code;

?>
