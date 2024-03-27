<?php

$bdd = new PDO('mysql:host=localhost;dbname=donation', 'root', '');

if (isset($_GET['reset_token'])) {
    $token = $_GET['reset_token'];

    $checkStmt = $bdd->prepare("SELECT * FROM `login` WHERE `reset_token` = ?");
    $checkStmt->execute(array($token));
    $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : null;

            $updateStmt = $bdd->prepare("UPDATE `login` SET `psw` = ?, `reset_token` = null WHERE `reset_token` = ?");
            $updateResult = $updateStmt->execute(array($newPassword, $token));

            if ($updateResult) {
                // Redirection vers login.php après la réinitialisation du mot de passe réussie
                header("Location: login.php");
                exit;
            } else {
                $errorInfo = $updateStmt->errorInfo();
                echo "Database Error: " . $errorInfo[2];
                exit;
            }
        }
    } else {
        echo "Invalid token. Please try again or initiate the password recovery process.";
    }
} else {
    echo "Token not provided. Please try again or initiate the password recovery process.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <title>Reset Password</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container recovery">
            <form method="post">
                <h1>Reset Password</h1>
                <span>Enter your new password</span>
                <input type="password" placeholder="New Password" name="new_password" required>
                <button type="submit" class="recover">Reset Password</button>
            </form>
        </div>
    </div>
</body>

</html>
