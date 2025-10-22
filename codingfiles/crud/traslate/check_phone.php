<?php
include 'connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    // Check if phone exists in database
    $check_sql = "SELECT * FROM `mooncontent` WHERE phone='$phone'";
    $result = mysqli_query($conn, $check_sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
    echo json_encode(['exists' => false]);
}
?>