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
        <?php 
            // Tutaj dodaj kod PHP, który generuje tabelę i umieść go tutaj
            $mysqli = require __DIR__ . "/database.php";
            $sql = "SELECT * FROM clients";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                <tr>
                <th scope='col'>Client</th>
                <th scope='col'>Email</th>
                <th scope='col'>Date</th>
                <th scope='col'>Person Count</th>
                <th scope='col'>Edycja</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    echo "<tr>";
                    echo "<td>" . $row["client"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["personCount"] . "</td>";
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
        <!-- Tutaj możesz dodać elementy formularza, jeśli są potrzebne -->
    </form>
</body>
</html>