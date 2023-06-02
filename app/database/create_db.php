<?php
require 'app/core/config.php';

$string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";

try {
    $conn = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE " . DB_NAME;
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully";
} catch(PDOException $e) {
    echo $e->getMessage();
}

try {
    $conn = new PDO($string, DB_USER, DB_PASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
}

try {
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL UNIQUE, 
        email VARCHAR(50),
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        password VARCHAR(100)
    )";

    $conn->exec($sql);
    echo "\nTable users created successfully";

    $sql = "CREATE TABLE posts (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        description VARCHAR(255),
        title VARCHAR(50) NOT NULL, 
        image VARCHAR(125) NULL,
        votes INT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        username VARCHAR(30),
        FOREIGN KEY (username) REFERENCES users(username)
    )";

    $conn->exec($sql);
    echo "\nTable posts created successfully";

    $sql = "CREATE TABLE votes (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED,
        post_id INT(6) UNSIGNED,
        vote INT(6),
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (post_id) REFERENCES posts(id)
    )";

    $conn->exec($sql);
    echo "\nTable votes created successfully";
} catch(PDOException $e) {
    echo "\n" . $e->getMessage();
}

$conn = NULL;
