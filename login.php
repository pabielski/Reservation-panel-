<?php
$is_invalid=false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM clients
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();


    if (!$user) {
        $is_invalid = true; // Jeśli użytkownik nie istnieje, ustaw flagę is_invalid na true
    } else {
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