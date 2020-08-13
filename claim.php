<?php
$roomname = $_POST['room'];
$clientname = $_POST['name'];


if(strlen($roomname)>20 or strlen($roomname)<2){
    
    $message = "Invalid room name! Please enter a room name between 2 to 20 character.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';
    echo '</script>';
}
else if(!ctype_alnum($roomname)){
    
    $message = "Invalid room name! Please enter a alphanumeric room name.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';
    echo '</script>';
}
else{
    // connecting to database
    include 'db_connect.php';
}

$sql = "SELECT * FROM `rooms` WHERE Roomname = '$roomname'";
$result = mysqli_query($conn, $sql);

if($result){
    if(mysqli_num_rows($result)>0){
    $message = "Room already exist! Please enter a diffrent room name.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';
    echo '</script>';
    }
    else{
        $sql = "INSERT INTO `rooms`(`Roomname`) VALUES('$roomname');";
        if(mysqli_query($conn,$sql)){
            $message = "Your room is ready. You can start chatting now.";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/Chatroom/rooms.php?Roomname='.$roomname.'&clientname='.$clientname.'";';
            echo '</script>';
        }      
    }
}
else{
    echo "Error: ". mysqli_error($conn);
}
?>