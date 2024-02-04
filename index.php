<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Moja rezerwacja</h1>
    <?php if (isset($_SESSION["user_id"])) {
        // Jeśli użytkownik jest zalogowany, pobierz jego dane z bazy danych i wyświetl
        $mysqli = require __DIR__ . "/database.php";
        
        // Pobierz dane użytkownika z bazy danych na podstawie jego ID sesji
        $user_id = $_SESSION["user_id"];
        $sql = "SELECT * FROM clients WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Wyświetl dane użytkownika
        echo "Twoje dane to:" . "<br>";
        echo "Imię: " . $user['client'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Data rezerwacji: " . $user['date'] . "<br>";
        echo "Ilość osób " . $user['personCount'] . "<br>";

    } else { ?>
        <p><a href="login.php">Log in</a> or <a href="singup.html">Sing up</a></p>
    <?php } ?>

</body>
</html>