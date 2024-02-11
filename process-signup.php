<?php

// Połączenie z bazą danych
$mysqli = require __DIR__ . "/database.php";

if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["date"]) || empty($_POST["personCount"])) {
    die("Wszystkie pola formularza są wymagane");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Wymagany jest prawidłowy adres email");
}

// Sprawdzenie, czy data jest wolna
$date = $_POST["date"];
$check_date_query = "SELECT COUNT(*) FROM clients WHERE date = ?";
$stmt_check_date = $mysqli->prepare($check_date_query);
$stmt_check_date->bind_param("s", $date);
$stmt_check_date->execute();
$stmt_check_date->bind_result($count);
$stmt_check_date->fetch();
$stmt_check_date->close();

if ($count > 0) {
    die("Wybrana data jest już zarezerwowana");
}

$sql = "INSERT INTO clients (client, email, date, personCount, id_rooms) VALUES (?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssis", 
    $_POST["name"],
    $_POST["email"],
    $_POST["date"],
    $_POST["personCount"],
    $_POST["room"]
);

try {
    if ($stmt->execute()) {
        echo "Twoja rezerwacja została utworzona";
        header("Location: res-created.html");
        exit;
    } else {
        echo "Nie udało się utworzyć rezerwacji";
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() === 1062) {
        die("Adres email już istnieje. Proszę podać inny adres email.");
    } else {
        die("Wystąpił błąd podczas wykonywania zapytania: " . $e->getMessage());
    }
}
?>