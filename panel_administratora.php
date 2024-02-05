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
                <button><a href='update.php?id=$id'>Edytuj</a></button>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
</head>
<body>
    <form action="POST">

    </form>
</body>
</html>