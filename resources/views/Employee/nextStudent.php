<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch the next student by ordering in ascending order of the timestamp or ID
$nextSql = "SELECT * FROM students ORDER BY created_at ASC LIMIT 1";

$result = $mysqli->query($nextSql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nextStudentId = $row['student_id'];
    echo $nextStudentId;
} else {
    echo '---';
}

$mysqli->close();
?>
