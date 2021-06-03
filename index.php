<?php
//Login user


function login_user($username, $password){
    $host = "127.0.0.1"; // Server Hostname
    $user = "root"; // Server User
    $pass = "mysql"; // User Password
    $datb = "tserver"; //Database Name

    $conn= mysqli_connect($host, $user, $pass, $datb);
    if (isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        if(empty($username)){
            array_push($errors,"Username require");
        }
        if(empty($password)){
            array_push($errors, "Password Required");
        }
        if(count($errors)==0){
            $password = md5($password);
            $query = "SELECT * FROM user WHERE username='$username' AND password = '$password'";
            $results = mysqli_query($conn,$query);

            if (mysqli_num_rows($results)==1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                

            }
        }
    }
}