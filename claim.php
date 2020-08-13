<?php
$roomname = $_POST['room'];
$roompassword = $_POST['password'];
if(strlen($roomname)==0 or strlen($roompassword)==0){
    $message = "All fields are required!";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';
    echo '</script>';
}
else if(strlen($roompassword)<6){
    $message = "Password should be of atleast 6 characters!";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';
    echo '</script>';
}

else if(strlen($roomname)>20 or strlen($roomname)<2){
    
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
        $sql = "INSERT INTO `rooms`(`Roomname`,`rpassword`) VALUES('$roomname','$roompassword');";
        if(mysqli_query($conn,$sql)){
            $message = "Room created successfully.";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/Chatroom";';
            echo '</script>';
        }      
    }
}
else{
    echo "Error: ". mysqli_error($conn);
}
?>