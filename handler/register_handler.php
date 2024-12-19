<?php

require "../database/db.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = htmlspecialchars($_POST['username']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));

    if(empty($username) || empty($fullname) || empty($password)){
        echo "Fill all the fields!";
    }else{
        // Insertion to database
        $sql = "INSERT INTO users (username, fullname, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $fullname, $password);


        if($stmt->execute()){
            echo "User Register Successfully";
            header("Location: ../pages/login.html");
            exit();
        }else{
            echo "Error: ".$stmt->error; 
        }
    }

$stmt->close();
$conn->close();
}