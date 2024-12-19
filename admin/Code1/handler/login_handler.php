<?php

session_start();

require "../database/db.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password)){
        $sql = "SELECT password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $rows = $result->fetch_assoc();
                if(password_verify($password, $rows['password'])){
                    $_SESSION['user_id'] = $user_id;
                    header("Location: ../admin/admin.php");
                    exit();
                }else{
                    echo "Invalid Password";
                }
        }else{
            echo "invalid account";
        }
    }else{
        echo "fill all the fields";
    }

    $stmt->close();
    $conn->close();
}