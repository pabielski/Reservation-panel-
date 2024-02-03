<?php
// Połączenie z bazą danych
$mysqli = require __DIR__ . "/database.php";

if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["date"]) || empty($_POST["personCount"])) {
    die("Wszystkie pola formularza są wymagane");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Wymagany jest prawidłowy adres email");
}
$sql = "INSERT INTO clients ( client, email, date, personCount) VALUES (?,?,?,?)";

$stmt = $mysqli->stmt_init();
if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt   ->bind_param("sssi", 
$_POST["name"],
$_POST["email"],
$_POST["date"],
$_POST["personCount"]);



if ($stmt->execute()) {

    echo"NIce";
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}