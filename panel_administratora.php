<?php 
$mysqli = require __DIR__ . "/database.php";

// Zapytanie SQL do pobrania wszystkich danych z tabeli
$sql = "SELECT * FROM clients";

// Wykonanie zapytania
$result = $mysqli->query($sql);


// Sprawdzenie, czy istnieją dane w wyniku zapytania
if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>Client</th>
    <th>Email</th>
    <th>Date</th>
    <th>Person Count</th>
    <th>Edycja</th>
    </tr>";

    // Wyświetlanie danych w tabeli
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"]; // Pobranie id z bazy danych
        echo "<tr>";
        echo "<td>" . $row["client"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["personCount"] . "</td>";
        echo "<td>
                <button><a href='update.php?updateid=$id'>Edytuj</a></button>
                <button><a href='delete.php?deleteid=$id'>Usuń</a></button>
              </td>";
        echo "</tr>";

    }
    echo "</table>";
} else {
    echo "Brak danych w tabeli.";
}

// Zwolnienie zasobów wyniku zapytania
$result->free();

// Zamknięcie połączenia z bazą danych
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
</head>
<body>
    <form action="POST">

    </form>
</body>
</html>