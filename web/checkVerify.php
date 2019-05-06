<?php
$cred = isset($_REQUEST["code"]) ? $_REQUEST["code"] : -1;

if(is_numeric($cred)){
  $conn = new mysqli("localhost", "user", "pass", "CSCI4140");
  $sql = "SELECT code FROM verify";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if($row["code"] == $cred)
      echo "YES";
    else
      echo "NO";
  }
}else{
  echo "NO";
}
?>
