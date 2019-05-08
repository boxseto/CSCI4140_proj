<?php
  $conn = new mysqli("localhost", "user", "pass", "CSCI4140");
  $sql = "SELECT DATA_FORMAT(time,'%l:%i') FROM seats order by seatid";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo $row["time"]."~";
    }
  }
?>
