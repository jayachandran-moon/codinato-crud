<?php
include 'connect.php';


$sql = "SELECT id, firstname, lastname, email FROM crudsystem";
$result = $conn->query($sql);

// var_dump($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " - email:" .$row["email"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>