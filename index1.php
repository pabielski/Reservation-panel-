<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerwacja</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <h1>Rezerwacja</h1>
    <i class="fa-solid fa-plus plusicon"></i>
</header>
<main>
    <section id="dodajimie">
        <form action="process-signup.php" method="post">
            <div class="formularz">
                <label for="name"></label>
                <input type="text" id="name" name="name" placeholder="Jan Przykładowy" />
            </div>
            <div class="formularz">
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="jprzykladowy@przyklad.com" />
            </div>
            <div class="formularz">
                <label for="date"></label>
                <input type="date" name="date" id="date" placeholder="MM/DD/YYYY"/>
            </div>
            <div class="formularz">
                <label for="personCount"></label>
                <input type="number" name="personCount" id="personCount" placeholder="1" />
            </div>
            <div class="formularz">
                <label for="room">Wybierz pokój:</label>
                <select name="room" id="room">
                    <?php
                    $mysqli = require __DIR__ . "/database.php";
                    $sql = "SELECT id, type FROM rooms";
                    $result = $mysqli->query($sql);
            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["type"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit">Rezerwuję</button> 
        </form>
    </section>
</main>
<footer>Footer</footer>
</body>