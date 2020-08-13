<?php

include 'db_connect.php';
$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];

$sql = "INSERT INTO `msgs` (`msg`, `roomname`, `ip`, `stime`) VALUES ('$msg', '$room', '$ip', current_timestamp());";

mysqli_query($conn, $sql);
mysqli_close($conn);

?>
<script>
    console.log("Data inserted");
</script>