
<?php

$bdd = new PDO('mysql:host=localhost;dbname=donation', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    $checkStmt = $bdd->prepare("SELECT * FROM `login` WHERE `email` = ?");
    $checkStmt->execute(array($email));
    $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $token = bin2hex(random_bytes(32));

        $updateStmt = $bdd->prepare("UPDATE `login` SET `reset_token` = ? WHERE `email` = ?");
        $updateResult = $updateStmt->execute(array($token, $email));

        if ($updateResult) {
            echo "Click the following link to reset your password: ";
            echo"<br>";
        
            echo "<a href='reset_password.php?reset_token=$token'><button >Reset Password</button></a>";
        } else {
            echo " <div class='container'>Error updating reset token. Please try again.</div>";
        }
    } else {
        echo "Error: Email not found. Please enter a valid email address.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: grey;
}




.container {
    width: 400px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container h1 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.container p {
    font-size: 16px;
    margin-bottom: 20px;
    text-align: center;
}

.container a {
    display: block;
    width: 100%;
    text-align: center;
    text-decoration: none;
}

.container button {
    display: block;
    margin: 0 auto;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: green;
    color: black;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.container button:hover {
    background-color: #2980b9;
}
</style>
<link rel="stylesheet" href="css/index.css">

    <title>recover</title>
</head>
<body>
<div class="nevbar" id="nevbar" >
        <div class="logo">
            <a href="index.php" id="logo"><h1> Good<span>Ness</span></h1></a>
        </div>
</body>
</html>