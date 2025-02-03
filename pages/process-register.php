<?php
require_once '../db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required!'); window.location.href = 'register.php';</script>";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href = 'register.php';</script>";
        exit();
    }

    try {
        //check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email is already registered!'); window.location.href = 'register.php';</script>";
            exit();
        }

        //hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        //insert the user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, created_at) VALUES (:name, :email, :password, NOW())");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            //set session variables
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['username'] = $name;

            //redirect to index.php
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location.href = 'register.php';</script>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: register.php");
    exit();
}
?>
