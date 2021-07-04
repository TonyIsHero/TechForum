<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $username=$_POST['username'];
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

    $existSql="SELECT * FROM `users` WHERE user_email='$user_email'";
    $result=mysqli_query($conn,$existSql);
    $numRows=mysqli_num_rows($result);
    if($numRows>0){
        $showError="Email already in use";
    }
    else{
        if($pass==$cpass)
        {
            echo 1;
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`, `username`) 
            VALUES ('$user_email', '$hash', current_timestamp(), '$username')";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError="Passwords do not match";
            
        }
    }
    //header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}
?>