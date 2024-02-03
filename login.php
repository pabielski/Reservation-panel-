<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM clients
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if ($user && $user['client'] === $_POST['name']) {
        // Imię zgadza się, wykonaj odpowiednie działania
        // Na przykład, dodaj kod tutaj...
        echo "Imię zgadza się z danymi w bazie danych.";
    } else {
        // Imię nie zgadza się lub użytkownik nie istnieje
        echo "Imię nie zgadza się z danymi w bazie danych lub użytkownik o podanym adresie email nie istnieje.";
    }
    
    exit; // Zakończenie skryptu
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <form method="POST"">
        <div>
            <label for="email"></label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="name"></label>
            <input type="name" name="name" id="name">
        </div>

        <button>Baton</button>

    </form>


</body>

</html>