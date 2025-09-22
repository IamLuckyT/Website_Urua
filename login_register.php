<?php

session_start();                        //Starts php session to store data
require_once 'config.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $idnumber = $_POST['idnumber'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Basic validation example (you can expand this)
    if (empty($name) || empty($idnumber) || empty($email) || empty($password_raw) || empty($role)) {
        $_SESSION['register_error'] = 'Please fill in all fields.';
        $_SESSION['active_form'] = 'register';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_error'] = 'Invalid email format.';
        $_SESSION['active_form'] = 'register';
        header("Location: index.php");
        exit();
    }

    // Check if ID number already exists
    $stmt = $conn->prepare("SELECT idnumber FROM users WHERE idnumber = ?");
    $stmt->bind_param("s", $idnumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['register_error'] = 'ID Number is already registered!';
        $_SESSION['active_form'] = 'register';
        header("Location: index.php");
        exit();
    }      header("Location: index.php");
        exit();
  
    /*
    //Code I modified
    $checkIDnumber = $conn->query("SELECT idnumber FROM users WHERE idnumber = '$idnumber'");
    if ($checkIDnumber->num_rows > 0){
        $_SESSION['register_error'] = 'IDNUMBER is already registered!';
        $_SESSION['active_form'] = 'register';
    }else {
        $conn->query("INSERT INTO users (name, idnumber, email, password, role) VALUES ('$name','$idnumber', '$email', '$password', '$role')");
    }
    */
    /* Actual code from the tutorial
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0){
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    }else {
        $conn->query("INSERT INTO users (name, idnumber, email, password, role) VALUES ('$name','$idnumber', '$email', '$password', '$role')");
    }
    */
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $idnumber = $_POST['idnumber'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE idnumber = '$idnumber'");
    if ($result->num_rows > 0){
        $user = $result->Fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['idnumber'] = $user['idnumber'];
            
            if ($user['role'] === 'admin') {
                header("Location: admin_page.php");
            }else {
                header("Location: user_page.php");
            }
            exit();
        }
    }
    $_SESSION['login_error'] = 'incorrect idnumber or password';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}


?>
