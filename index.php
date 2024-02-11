<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <h1>Moja rezerwacja</h1>
    <?php if (isset($_SESSION["user_id"])) {
        $mysqli = require __DIR__ . "/database.php";
        
        $user_id = $_SESSION["user_id"];
        $sql = "SELECT * FROM clients WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

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