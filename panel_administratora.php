<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="table.css">
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
<section>
        <!-- Lista rozwijana jako filtr -->
        <label for="filter">Filtruj pokój:</label>
        <select id="filter">
            <option value="">Wszystkie</option>
            <?php
            // Połączenie z bazą danych
            $mysqli = require __DIR__ . "/database.php";
            
            // Zapytanie SQL dla listy rozwijanej
            $sql = "SELECT DISTINCT type FROM rooms";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . $row["type"] . "\">" . $row["type"] . "</option>";
                }
            }

            $result->free();
            $mysqli->close();
            ?>
        </select>
        <?php 
            // Połączenie z bazą danych
            $mysqli = require __DIR__ . "/database.php";
            
            // Zapytanie SQL z dołączeniem tabeli rooms
            $sql = "SELECT clients.*, rooms.type AS room_type FROM clients JOIN rooms ON clients.id_rooms = rooms.id";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                <tr>
                <th scope='col'>Client</th>
                <th scope='col'>Email</th>
                <th scope='col'>Date</th>
                <th scope='col'>Person Count</th>
                <th scope='col'>Room Type</th>
                <th scope='col'>Edycja</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    echo "<tr>";
                    echo "<td>" . $row["client"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["personCount"] . "</td>";
                    echo "<td>" . $row["room_type"] . "</td>";
                    echo "<td>
                            <button class='update'><a href='update.php?updateid=$id'>Edytuj</a></button>
                            <button class='del'><a href='delete.php?deleteid=$id'>Usuń</a></button>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Brak danych w tabeli.";
            }

            $result->free();
            $mysqli->close();
        ?>
    </section>
    <form action="POST">
        
    </form>

    <script>
        document.getElementById('filter').addEventListener('change', function() {
            const filter = this.value;
            const rows = document.querySelectorAll('table tr');

            rows.forEach(function(row) {
                const cell = row.querySelector('td:nth-child(5)'); // Pobierz piątą komórkę (Room Name)
                
                if (cell) {
                    const text = cell.textContent;
                    if (filter === '' || text === filter) {
                        row.style.display = ''; // Wyświetl wiersz
                    } else {
                        row.style.display = 'none'; // Ukryj wiersz
                    }
                }
            });
        });
    </script>
</body>
</html>