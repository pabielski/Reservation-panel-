<?php
$is_invalid=false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM clients
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if ($_POST['name'] === 'Administrator' && $_POST['email'] === 'admin@hotel.pl') {
        echo'';
        header("Location: panel_administratora.php");
        exit; } else {
    if (!$user) {
        $is_invalid = true; // Jeśli użytkownik nie istnieje, ustaw flagę is_invalid na true
    }  else {
            if ($user['client'] === $_POST['name']) {
                // Imię zgadza się, wykonaj odpowiednie działania
                // Na przykład, dodaj kod tutaj...
                session_start();
                $_SESSION["user_id"] = $user["id"];
                header("Location: index.php");
                exit;
            } else {
                $is_invalid = true; // Jeśli imię nie zgadza się, ustaw flagę is_invalid na true
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
        <form method="POST">
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email"
                value ="<?= htmlspecialchars($_POST["email"] ?? "" )?>">
            </div>
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
            </div>

            <button type="submit">Submit</button>

        </form>
</body>

</html>